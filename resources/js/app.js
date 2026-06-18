import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    if (!('IntersectionObserver' in window)) return;

    // ── Scroll reveal ─────────────────────────────────────────
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            el.classList.add('in-view');
            // stagger direct children marked with data-stagger
            el.querySelectorAll(':scope > [data-stagger]').forEach((child, i) => {
                child.style.transitionDelay = `${i * 75}ms`;
                child.classList.add('in-view');
            });
            revealObserver.unobserve(el);
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -48px 0px' });

    document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));

    // ── Accent line expand ────────────────────────────────────
    const lineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('in-view');
            lineObserver.unobserve(entry.target);
        });
    }, { threshold: 0.6 });

    document.querySelectorAll('[data-line]').forEach(el => lineObserver.observe(el));

    // ── Stat counter animation ────────────────────────────────
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const raw = el.dataset.counter;
            const num = parseInt(raw.replace(/\D/g, ''), 10);
            if (isNaN(num) || num === 0) return;
            const prefix = raw.match(/^[^\d]*/)?.[0] ?? '';
            const duration = 900;
            const steps = 40;
            const interval = duration / steps;
            let current = 0;
            const increment = num / steps;
            const timer = setInterval(() => {
                current = Math.min(current + increment, num);
                el.textContent = prefix + Math.round(current);
                if (current >= num) clearInterval(timer);
            }, interval);
            counterObserver.unobserve(el);
        });
    }, { threshold: 0.7 });

    document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));

    // ── Swipe táctil en carruseles ────────────────────────
    document.querySelectorAll('[data-swipe-carousel]').forEach(el => {
        let startX = 0;
        let isDragging = false;

        el.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
            isDragging = true;
        }, { passive: true });

        el.addEventListener('touchend', e => {
            if (!isDragging) return;
            const delta = startX - e.changedTouches[0].clientX;
            if (Math.abs(delta) > 40) {
                el.scrollBy({ left: delta > 0 ? 240 : -240, behavior: 'smooth' });
            }
            isDragging = false;
        }, { passive: true });
    });
});
