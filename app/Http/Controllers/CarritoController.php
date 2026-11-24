<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    private function cartArray(): array
    {
        return array_values(session('cart', []));
    }

    private function cartCount(): int
    {
        return array_sum(array_column(session('cart', []), 'quantity'));
    }

    public function agregar(Request $request, Product $product): JsonResponse
    {
        $cart = session('cart', []);
        $size = $request->input('size');
        $key  = $product->id . '_' . ($size ?? 'default');

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $images = $product->images ?? [];
            $cart[$key] = [
                'key'      => $key,
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => (float) $product->price,
                'image'    => $images[0] ?? null,
                'quantity' => 1,
                'size'     => $size,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'count'   => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    public function actualizar(Request $request): JsonResponse
    {
        $cart     = session('cart', []);
        $key      = $request->input('key');
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $quantity;
            session(['cart' => $cart]);
        }

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'count'   => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    public function quitar(Request $request): JsonResponse
    {
        $cart = session('cart', []);
        $key  = $request->input('key');

        unset($cart[$key]);
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
            'count'   => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'pickup_branch'  => 'required|string|max:255',
            'notes'          => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        // Cargar productos y verificar stock por talla antes de hacer nada
        $products = [];
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product) {
                return back()->with('error', "El producto «{$item['name']}» ya no existe.");
            }
            $sizes = $product->size_options ?? [];
            $qty   = $item['quantity'];
            $size  = $item['size'];

            if (!empty($sizes) && $size && array_key_exists($size, $sizes)) {
                if ((int) $sizes[$size] < $qty) {
                    return back()->with('error', "Sin stock de talla {$size} para «{$item['name']}».");
                }
            } elseif ($product->stock < $qty) {
                return back()->with('error', "Sin stock suficiente para «{$item['name']}».");
            }
            $products[$item['id']] = $product;
        }

        $order = Order::create([
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'pickup_branch'  => $request->pickup_branch,
            'notes'          => $request->notes,
            'status'         => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'size'       => $item['size'],
            ]);

            $product = $products[$item['id']];
            $sizes   = $product->size_options ?? [];
            $size    = $item['size'];

            if (!empty($sizes) && $size && array_key_exists($size, $sizes)) {
                $sizes[$size] = max(0, (int) $sizes[$size] - $item['quantity']);
                $product->size_options = $sizes;
                $product->stock        = array_sum(array_map('intval', array_values($sizes)));
                $product->save();
            } else {
                $product->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', '¡Pedido realizado! Te contactaremos pronto para confirmar el pedido.');
    }
}
