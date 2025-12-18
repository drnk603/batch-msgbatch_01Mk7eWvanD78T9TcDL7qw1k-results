(function() {
    'use strict';

    window.__app = window.__app || {};

    if (window.__app.initialized) return;

    const CONFIG = {
        HEADER_HEIGHT: 'var(--nav-h)',
        ANIMATION_DURATION: 300,
        DEBOUNCE_DELAY: 250,
        THROTTLE_LIMIT: 100,
        SCROLL_OFFSET: 120,
        MOBILE_BREAKPOINT: 768
    };

    const VALIDATORS = {
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        phone: /^[+\-\d()\s]{10,20}$/,
        name: /^[a-zA-ZÀ-ÿ\s\-']{2,50}$/,
        message: /^.{10,}$/
    };

    const MESSAGES = {
        required: 'This field is required',
        email: 'Please enter a valid email address',
        phone: 'Please enter a valid phone number',
        name: 'Please enter a valid name (2-50 characters)',
        message: 'Message must be at least 10 characters',
        success: 'Form submitted successfully!',
        error: 'An error occurred. Please try again.',
        sending: 'Sending...'
    };

    function debounce(func, wait) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    class BurgerMenu {
        constructor() {
            this.nav = document.querySelector('.navbar-expand-md');
            this.toggler = document.querySelector('.navbar-toggler');
            this.collapse = document.querySelector('.navbar-collapse');
            this.body = document.body;
            this.isOpen = false;

            if (!this.nav || !this.toggler || !this.collapse) return;

            this.init();
        }

        init() {
            this.createMobileMenu();
            this.bindEvents();
        }

        createMobileMenu() {
            if (!this.collapse.id) {
                this.collapse.id = 'navbarCollapse';
            }
            this.toggler.setAttribute('aria-controls', this.collapse.id);
            this.toggler.setAttribute('aria-expanded', 'false');
        }

        bindEvents() {
            this.toggler.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggle();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });

            const links = this.collapse.querySelectorAll('.nav-link');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < CONFIG.MOBILE_BREAKPOINT) {
                        this.close();
                    }
                });
            });

            window.addEventListener('resize', debounce(() => {
                if (window.innerWidth >= CONFIG.MOBILE_BREAKPOINT && this.isOpen) {
                    this.close();
                }
            }, CONFIG.DEBOUNCE_DELAY));
        }

        toggle() {
            this.isOpen ? this.close() : this.open();
        }

        open() {
            this.isOpen = true;
            this.collapse.classList.add('show');
            this.toggler.classList.add('active');
            this.toggler.setAttribute('aria-expanded', 'true');
            this.body.style.overflow = 'hidden';
            this.collapse.style.height = `calc(100vh - ${getComputedStyle(document.documentElement).getPropertyValue('--nav-h')})`;
        }

        close() {
            this.isOpen = false;
            this.collapse.classList.remove('show');
            this.toggler.classList.remove('active');
            this.toggler.setAttribute('aria-expanded', 'false');
            this.body.style.overflow = '';
            this.collapse.style.height = '';
        }
    }

    class ScrollSpy {
        constructor() {
            this.sections = document.querySelectorAll('section[id]');
            this.navLinks = document.querySelectorAll('.nav-link[href^="#"]');
            if (this.sections.length === 0) return;
            this.init();
        }

        init() {
            const options = {
                root: null,
                rootMargin: '-20% 0px -70% 0px',
                threshold: 0
            };

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.setActiveLink(entry.target.id);
                    }
                });
            }, options);

            this.sections.forEach(section => this.observer.observe(section));
        }

        setActiveLink(id) {
            this.navLinks.forEach(link => {
                link.classList.remove('active');
                link.removeAttribute('aria-current');
                if (link.getAttribute('href') === `#${id}`) {
                    link.classList.add('active');
                    link.setAttribute('aria-current', 'page');
                }
            });
        }
    }

    class SmoothScroll {
        constructor() {
            this.init();
        }

        init() {
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a[href^="#"]');
                if (!link) return;

                const href = link.getAttribute('href');
                if (href === '#' || href === '#!') return;

                const targetId = href.substring(1);
                const target = document.getElementById(targetId);

                if (target) {
                    e.preventDefault();
                    this.scrollTo(target);
                }
            });
        }

        scrollTo(target) {
            const headerHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-h')) || 70;
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    class ScrollAnimations {
        constructor() {
            this.animatedElements = document.querySelectorAll('.c-card, .c-button, img, .hero-section, .form-group');
            if (this.animatedElements.length === 0) return;
            this.init();
        }

        init() {
            const options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '0';
                        entry.target.style.transform = 'translateY(30px)';
                        requestAnimationFrame(() => {
                            entry.target.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        });
                        this.observer.unobserve(entry.target);
                    }
                });
            }, options);

            this.animatedElements.forEach(el => {
                if (!el.hasAttribute('data-no-animation')) {
                    this.observer.observe(el);
                }
            });
        }
    }

    class MicroInteractions {
        constructor() {
            this.init();
        }

        init() {
            this.initButtonRipple();
            this.initCardHover();
            this.initLinkHover();
        }

        initButtonRipple() {
            const buttons = document.querySelectorAll('.c-button, .btn');
            buttons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const ripple = document.createElement('span');
                    const rect = button.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = `${size}px`;
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    ripple.className = 'ripple-effect';

                    const existingRipple = button.querySelector('.ripple-effect');
                    if (existingRipple) {
                        existingRipple.remove();
                    }

                    button.style.position = 'relative';
                    button.style.overflow = 'hidden';
                    button.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 600);
                });
            });

            this.addRippleStyles();
        }

        addRippleStyles() {
            if (document.getElementById('ripple-styles')) return;

            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                .ripple-effect {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.6);
                    transform: scale(0);
                    animation: ripple-animation 0.6s ease-out;
                    pointer-events: none;
                }
                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        initCardHover() {
            const cards = document.querySelectorAll('.c-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transition = 'transform 0.3s ease-out, box-shadow 0.3s ease-out';
                    card.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) scale(1)';
                });
            });
        }

        initLinkHover() {
            const links = document.querySelectorAll('a:not(.c-button):not(.btn)');
            links.forEach(link => {
                if (!link.closest('.navbar-nav')) {
                    link.style.transition = 'color 0.3s ease-out';
                }
            });
        }
    }

    class CountUp {
        constructor() {
            this.counters = document.querySelectorAll('[data-count]');
            if (this.counters.length === 0) return;
            this.init();
        }

        init() {
            const options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.5
            };

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                        this.animateCount(entry.target);
                        entry.target.classList.add('counted');
                    }
                });
            }, options);

            this.counters.forEach(counter => this.observer.observe(counter));
        }

        animateCount(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }
    }

    class FormValidator {
        constructor() {
            this.forms = document.querySelectorAll('form');
            if (this.forms.length === 0) return;
            this.init();
        }

        init() {
            this.forms.forEach(form => {
                form.setAttribute('novalidate', 'true');
                form.addEventListener('submit', (e) => this.handleSubmit(e));
                const inputs = form.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.addEventListener('blur', () => this.validateField(input));
                    input.addEventListener('input', () => this.clearError(input));
                });
            });
        }

        handleSubmit(e) {
            e.preventDefault();
            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"]');
            let isValid = true;

            const fields = form.querySelectorAll('input, textarea, select');
            fields.forEach(field => {
                if (!this.validateField(field)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                return;
            }

            if (submitButton) {
                submitButton.disabled = true;
                const originalText = submitButton.textContent;
                submitButton.innerHTML = `<span style="display: inline-block; width: 14px; height: 14px; border: 2px solid #fff; border-top-color: transparent; border-radius: 50%; animation: spin 0.6s linear infinite; margin-right: 8px;"></span>${MESSAGES.sending}`;
                this.addSpinnerStyles();

                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                    this.showNotification(MESSAGES.success, 'success');
                    form.reset();
                    this.clearAllErrors(form);
                    window.location.href = 'thank_you.html';
                }, 2000);
            }
        }

        validateField(field) {
            const value = field.value.trim();
            const type = field.type;
            const name = field.name || field.id || 'field';
            const required = field.hasAttribute('required');

            this.clearError(field);

            if (required && !value) {
                this.showError(field, MESSAGES.required);
                return false;
            }

            if (!value) return true;

            if (type === 'email' || name.toLowerCase().includes('email')) {
                if (!VALIDATORS.email.test(value)) {
                    this.showError(field, MESSAGES.email);
                    return false;
                }
            }

            if (type === 'tel' || name.toLowerCase().includes('phone') || name.toLowerCase().includes('tel')) {
                if (!VALIDATORS.phone.test(value)) {
                    this.showError(field, MESSAGES.phone);
                    return false;
                }
            }

            if (name.toLowerCase().includes('name')) {
                if (!VALIDATORS.name.test(value)) {
                    this.showError(field, MESSAGES.name);
                    return false;
                }
            }

            if (field.tagName === 'TEXTAREA' || name.toLowerCase().includes('message')) {
                if (!VALIDATORS.message.test(value)) {
                    this.showError(field, MESSAGES.message);
                    return false;
                }
            }

            return true;
        }

        showError(field, message) {
            field.classList.add('is-invalid');
            field.setAttribute('aria-invalid', 'true');
            let errorDiv = field.parentElement.querySelector('.form-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.setAttribute('role', 'alert');
                field.parentElement.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }

        clearError(field) {
            field.classList.remove('is-invalid');
            field.removeAttribute('aria-invalid');
            const errorDiv = field.parentElement.querySelector('.form-error');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        clearAllErrors(form) {
            const errorDivs = form.querySelectorAll('.form-error');
            errorDivs.forEach(div => div.remove());
            const invalidFields = form.querySelectorAll('.is-invalid');
            invalidFields.forEach(field => {
                field.classList.remove('is-invalid');
                field.removeAttribute('aria-invalid');
            });
        }

        showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            notification.setAttribute('role', 'alert');
            document.body.appendChild(notification);
            this.addNotificationStyles();

            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
                notification.style.opacity = '1';
            });

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        addNotificationStyles() {
            if (document.getElementById('notification-styles')) return;

            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                .notification {
                    position: fixed;
                    top: 90px;
                    right: 20px;
                    padding: 16px 24px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 9999;
                    transform: translateX(400px);
                    opacity: 0;
                    transition: all 0.3s ease-out;
                    max-width: 400px;
                    font-weight: 500;
                }
                .notification-success {
                    background: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }
                .notification-error {
                    background: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                }
            `;
            document.head.appendChild(style);
        }

        addSpinnerStyles() {
            if (document.getElementById('spinner-styles')) return;

            const style = document.createElement('style');
            style.id = 'spinner-styles';
            style.textContent = `
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        }
    }

    class ScrollToTop {
        constructor() {
            this.createButton();
            this.init();
        }

        createButton() {
            this.button = document.createElement('button');
            this.button.className = 'scroll-to-top';
            this.button.innerHTML = '↑';
            this.button.setAttribute('aria-label', 'Scroll to top');
            this.button.style.display = 'none';
            document.body.appendChild(this.button);
            this.addStyles();
        }

        init() {
            window.addEventListener('scroll', throttle(() => {
                if (window.pageYOffset > 300) {
                    this.button.style.display = 'flex';
                } else {
                    this.button.style.display = 'none';
                }
            }, CONFIG.THROTTLE_LIMIT));

            this.button.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        addStyles() {
            if (document.getElementById('scroll-top-styles')) return;

            const style = document.createElement('style');
            style.id = 'scroll-top-styles';
            style.textContent = `
                .scroll-to-top {
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    width: 50px;
                    height: 50px;
                    background: var(--color-accent, #d84315);
                    color: white;
                    border: none;
                    border-radius: 50%;
                    font-size: 24px;
                    cursor: pointer;
                    z-index: 1000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                    transition: all 0.3s ease-out;
                }
                .scroll-to-top:hover {
                    background: var(--color-accent-hover, #bf360c);
                    transform: translateY(-4px);
                    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
                }
                .scroll-to-top:active {
                    transform: translateY(-2px);
                }
            `;
            document.head.appendChild(style);
        }
    }

    class ImageOptimizer {
        constructor() {
            this.images = document.querySelectorAll('img:not([loading])');
            this.init();
        }

        init() {
            this.images.forEach(img => {
                if (!img.hasAttribute('data-critical')) {
                    img.setAttribute('loading', 'lazy');
                }

                img.addEventListener('error', () => {
                    img.src = this.createPlaceholder();
                    img.style.objectFit = 'contain';
                });
            });
        }

        createPlaceholder() {
            return `data:image/svg+xml;base64,${btoa(`
                <svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300">
                    <rect width="400" height="300" fill="#e9ecef"/>
                    <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="#6c757d" font-family="sans-serif" font-size="18">Image not found</text>
                </svg>
            `)}`;
        }
    }

    class PrivacyModal {
        constructor() {
            this.init();
        }

        init() {
            const privacyLinks = document.querySelectorAll('a[href*="privacy"], a[href*="policy"]');
            privacyLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    if (link.getAttribute('href') === '#privacy' || link.getAttribute('href') === '#policy') {
                        e.preventDefault();
                        this.showModal();
                    }
                });
            });
        }

        showModal() {
            const modal = document.createElement('div');
            modal.className = 'privacy-modal';
            modal.innerHTML = `
                <div class="privacy-modal-content">
                    <button class="privacy-modal-close" aria-label="Close">&times;</button>
                    <h2>Privacy Policy</h2>
                    <div class="privacy-modal-body">
                        <p>This is a placeholder for the privacy policy content.</p>
                        <p>Your privacy is important to us. This policy explains how we collect, use, and protect your personal information.</p>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
            this.addModalStyles();

            requestAnimationFrame(() => {
                modal.style.opacity = '1';
                modal.querySelector('.privacy-modal-content').style.transform = 'scale(1)';
            });

            const closeBtn = modal.querySelector('.privacy-modal-close');
            closeBtn.addEventListener('click', () => this.closeModal(modal));

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    this.closeModal(modal);
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.closeModal(modal);
                }
            });
        }

        closeModal(modal) {
            modal.style.opacity = '0';
            modal.querySelector('.privacy-modal-content').style.transform = 'scale(0.9)';
            document.body.style.overflow = '';
            setTimeout(() => modal.remove(), 300);
        }

        addModalStyles() {
            if (document.getElementById('privacy-modal-styles')) return;

            const style = document.createElement('style');
            style.id = 'privacy-modal-styles';
            style.textContent = `
                .privacy-modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.7);
                    backdrop-filter: blur(4px);
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                    opacity: 0;
                    transition: opacity 0.3s ease-out;
                }
                .privacy-modal-content {
                    background: white;
                    border-radius: 12px;
                    max-width: 600px;
                    width: 100%;
                    max-height: 80vh;
                    overflow-y: auto;
                    padding: 32px;
                    position: relative;
                    transform: scale(0.9);
                    transition: transform 0.3s ease-out;
                }
                .privacy-modal-close {
                    position: absolute;
                    top: 16px;
                    right: 16px;
                    width: 40px;
                    height: 40px;
                    border: none;
                    background: transparent;
                    font-size: 32px;
                    cursor: pointer;
                    color: #757575;
                    transition: color 0.3s ease-out;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .privacy-modal-close:hover {
                    color: #d84315;
                }
                .privacy-modal-body {
                    margin-top: 16px;
                }
            `;
            document.head.appendChild(style);
        }
    }

    function init() {
        if (window.__app.initialized) return;

        new BurgerMenu();
        new ScrollSpy();
        new SmoothScroll();
        new ScrollAnimations();
        new MicroInteractions();
        new CountUp();
        new FormValidator();
        new ScrollToTop();
        new ImageOptimizer();
        new PrivacyModal();

        window.__app.initialized = true;
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();