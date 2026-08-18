/* ═══════════════════════════════════════════════════
   MAIN.JS — Kontraktor Surabaya
   Handles: Navbar scroll, Back to Top, GA4 Events
═══════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', function () {

    // ─── Navbar Scroll Effect ──────────────────────────
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Run on load
    }

    // ─── Back to Top Button ────────────────────────────
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('visible', window.scrollY > 400);
        }, { passive: true });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ─── GA4 Event: WhatsApp Button Click ─────────────
    const waButtons = document.querySelectorAll('#wa-float-btn, #footer-wa-btn, .btn-whatsapp, [data-wa]');
    waButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'whatsapp_click', {
                    event_category: 'CTA',
                    event_label: btn.id || 'whatsapp_button'
                });
            }
        });
    });

    // ─── GA4 Event: Contact Form Submit ───────────────
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', () => {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'form_submit', {
                    event_category: 'Lead',
                    event_label: 'Contact Form'
                });
            }
        });
    }

    // ─── Portfolio Filter (via URL param) ─────────────
    const filterBtns = document.querySelectorAll('[data-filter]');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.filter;
            const url = new URL(window.location);
            if (category && category !== 'all') {
                url.searchParams.set('category', category);
            } else {
                url.searchParams.delete('category');
            }
            window.location.href = url.toString();
        });
    });

    // ─── Lazy Load Images (Intersection Observer) ─────
    const lazyImages = document.querySelectorAll('img[data-src]');
    if ('IntersectionObserver' in window && lazyImages.length) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        }, { rootMargin: '200px' });

        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // ─── Animate on Scroll (simple) ───────────────────
    const animatedEls = document.querySelectorAll('.fade-in-up');
    if ('IntersectionObserver' in window && animatedEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        animatedEls.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    }
});
