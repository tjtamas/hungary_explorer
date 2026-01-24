/**
 * Main Application - Magyarország Felfedezői Szövetség
 * 
 * SOLID JavaScript Architecture
 * - Single Responsibility: Each class has one job
 * - Open/Closed: Extendable without modification
 * - Liskov Substitution: Components are interchangeable
 * - Interface Segregation: Minimal public APIs
 * - Dependency Inversion: Depend on abstractions
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

'use strict';

// ============================================
// UTILITY FUNCTIONS
// ============================================

const Utils = {
    /**
     * Debounce function calls
     */
    debounce(func, wait = 300) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    /**
     * Throttle function calls
     */
    throttle(func, limit = 300) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },

    /**
     * Check if element is in viewport
     */
    isInViewport(element, offset = 0) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= -offset &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + offset &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    },

    /**
     * Smooth scroll to element
     */
    scrollTo(target, offset = 0) {
        const element = typeof target === 'string' ? document.querySelector(target) : target;
        if (!element) return;

        const targetPosition = element.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
};

// ============================================
// SINGLE RESPONSIBILITY: Scroll Animation Observer
// ============================================

class ScrollAnimator {
    constructor(selector = '.fade-in', options = {}) {
        this.elements = document.querySelectorAll(selector);
        this.options = {
            threshold: 0.1,
            rootMargin: '50px',
            ...options
        };
        this.observer = null;
    }

    init() {
        if (!this.elements.length) return;

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Optional: unobserve after animation
                    // this.observer.unobserve(entry.target);
                }
            });
        }, this.options);

        this.elements.forEach(el => this.observer.observe(el));
    }

    destroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
    }
}

// ============================================
// SINGLE RESPONSIBILITY: Mobile Menu Controller
// ============================================

class MobileMenu {
    constructor() {
        this.hamburger = document.getElementById('hamburger');
        this.sidebar = document.getElementById('sidebar');
        this.overlay = null;
        this.isOpen = false;
    }

    init() {
        if (!this.hamburger || !this.sidebar) return;

        // Create overlay
        this.createOverlay();

        // Toggle on hamburger click
        this.hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggle();
        });

        // Close on overlay click
        this.overlay.addEventListener('click', () => {
            this.close();
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });

        // Close on window resize (if going to desktop)
        window.addEventListener('resize', Utils.debounce(() => {
            if (window.innerWidth > 1280 && this.isOpen) {
                this.close();
            }
        }, 250));
    }

    createOverlay() {
        this.overlay = document.createElement('div');
        this.overlay.className = 'sidebar-overlay';
        this.overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        `;
        document.body.appendChild(this.overlay);
    }

    toggle() {
        this.isOpen ? this.close() : this.open();
    }

    open() {
        this.sidebar.classList.remove('inactive');
        this.overlay.style.opacity = '1';
        this.overlay.style.visibility = 'visible';
        document.body.style.overflow = 'hidden';
        this.isOpen = true;
    }

    close() {
        this.sidebar.classList.add('inactive');
        this.overlay.style.opacity = '0';
        this.overlay.style.visibility = 'hidden';
        document.body.style.overflow = '';
        this.isOpen = false;
    }
}

// ============================================
// SINGLE RESPONSIBILITY: Smooth Scroll Handler
// ============================================

class SmoothScroll {
    constructor(offset = 80) {
        this.offset = offset;
        this.links = document.querySelectorAll('a[href^="#"]');
    }

    init() {
        if (!this.links.length) return;

        this.links.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                
                // Skip empty or just # links
                if (!href || href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    Utils.scrollTo(target, this.offset);
                    
                    // Update URL without page reload
                    history.pushState(null, '', href);
                }
            });
        });
    }
}

// ============================================
// SINGLE RESPONSIBILITY: Image Lightbox
// ============================================

class Lightbox {
    constructor(selector = '.lightbox-trigger') {
        this.triggers = document.querySelectorAll(selector);
        this.modal = null;
        this.modalImg = null;
        this.modalCaption = null;
        this.isOpen = false;
    }

    init() {
        if (!this.triggers.length) return;

        this.createModal();
        this.bindEvents();
    }

    createModal() {
        // Create modal structure
        this.modal = document.createElement('div');
        this.modal.className = 'lightbox-modal';
        this.modal.innerHTML = `
            <span class="lightbox-close">&times;</span>
            <img class="lightbox-content" alt="">
            <div class="lightbox-caption"></div>
        `;
        
        this.modal.style.cssText = `
            display: none;
            position: fixed;
            z-index: 10000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        `;

        document.body.appendChild(this.modal);

        this.modalImg = this.modal.querySelector('.lightbox-content');
        this.modalCaption = this.modal.querySelector('.lightbox-caption');
        const closeBtn = this.modal.querySelector('.lightbox-close');

        // Style elements
        this.modalImg.style.cssText = `
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80vh;
            animation: zoom 0.3s;
        `;

        this.modalCaption.style.cssText = `
            margin: auto;
            display: block;
            max-width: 80%;
            text-align: center;
            color: #ccc;
            padding: 20px;
        `;

        closeBtn.style.cssText = `
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        `;

        // Close button click
        closeBtn.addEventListener('click', () => this.close());

        // Close on background click
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.close();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });
    }

    bindEvents() {
        this.triggers.forEach(trigger => {
            trigger.style.cursor = 'pointer';
            trigger.addEventListener('click', () => {
                const imgSrc = trigger.src || trigger.dataset.src;
                const caption = trigger.alt || trigger.dataset.caption || '';
                this.open(imgSrc, caption);
            });
        });
    }

    open(src, caption = '') {
        this.modal.style.display = 'block';
        this.modalImg.src = src;
        this.modalCaption.textContent = caption;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    }

    close() {
        this.modal.style.display = 'none';
        this.isOpen = false;
        document.body.style.overflow = '';
    }
}

// ============================================
// SINGLE RESPONSIBILITY: Accordion Menu
// ============================================

class AccordionMenu {
    constructor(selector = '#menu') {
        this.menu = document.querySelector(selector);
        this.openers = [];
    }

    init() {
        if (!this.menu) return;

        this.openers = this.menu.querySelectorAll('.opener');
        
        this.openers.forEach(opener => {
            opener.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggle(opener);
            });
        });
    }

    toggle(opener) {
        const submenu = opener.nextElementSibling;
        const isActive = opener.classList.contains('active');

        if (isActive) {
            opener.classList.remove('active');
            submenu.style.display = 'none';
        } else {
            opener.classList.add('active');
            submenu.style.display = 'block';
        }
    }
}

// ============================================
// SINGLE RESPONSIBILITY: Form Validator
// ============================================

class FormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        this.errors = {};
    }

    init() {
        if (!this.form) return;

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.errors = {};
            
            if (this.validate()) {
                this.submit();
            } else {
                this.displayErrors();
            }
        });
    }

    validate() {
        const inputs = this.form.querySelectorAll('[required]');
        let isValid = true;

        inputs.forEach(input => {
            const value = input.value.trim();
            const name = input.name;

            if (!value) {
                this.errors[name] = 'Ez a mező kötelező';
                isValid = false;
            }

            // Email validation
            if (input.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    this.errors[name] = 'Érvénytelen email cím';
                    isValid = false;
                }
            }

            // Phone validation (Hungarian format)
            if (input.type === 'tel' && value) {
                const phoneRegex = /^(\+36|06)?[0-9]{9}$/;
                if (!phoneRegex.test(value.replace(/[\s-]/g, ''))) {
                    this.errors[name] = 'Érvénytelen telefonszám';
                    isValid = false;
                }
            }
        });

        return isValid;
    }

    displayErrors() {
        // Clear previous errors
        this.form.querySelectorAll('.error-message').forEach(el => el.remove());

        // Display new errors
        Object.keys(this.errors).forEach(name => {
            const input = this.form.querySelector(`[name="${name}"]`);
            if (input) {
                const errorEl = document.createElement('span');
                errorEl.className = 'error-message';
                errorEl.textContent = this.errors[name];
                errorEl.style.color = 'var(--color-red, #c41e3a)';
                errorEl.style.fontSize = '0.875rem';
                errorEl.style.marginTop = '0.25rem';
                errorEl.style.display = 'block';
                input.parentElement.appendChild(errorEl);
            }
        });
    }

    submit() {
        // Handle form submission (AJAX or regular)
        console.log('Form is valid, submitting...');
        // this.form.submit(); // Regular submit
        // Or use AJAX submission
    }
}

// ============================================
// DEPENDENCY INVERSION: Application Container
// ============================================

class Application {
    constructor() {
        this.components = new Map();
        this.initialized = false;
    }

    /**
     * Register a component
     */
    register(name, component) {
        this.components.set(name, component);
        return this;
    }

    /**
     * Get a component
     */
    get(name) {
        return this.components.get(name);
    }

    /**
     * Initialize all components
     */
    init() {
        if (this.initialized) {
            console.warn('Application already initialized');
            return;
        }

        console.log('🚀 Magyarország Felfedezői - Initializing...');

        this.components.forEach((component, name) => {
            try {
                if (typeof component.init === 'function') {
                    component.init();
                    console.log(`✅ ${name} initialized`);
                }
            } catch (error) {
                console.error(`❌ Error initializing ${name}:`, error);
            }
        });

        this.initialized = true;
        console.log('🎉 Application ready!');
    }

    /**
     * Destroy all components
     */
    destroy() {
        this.components.forEach((component, name) => {
            if (typeof component.destroy === 'function') {
                component.destroy();
            }
        });
        this.components.clear();
        this.initialized = false;
    }
}

// ============================================
// APPLICATION BOOTSTRAP
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    // Create application instance
    const app = new Application();

    // Register components
    app.register('scrollAnimator', new ScrollAnimator('.fade-in'))
       .register('mobileMenu', new MobileMenu())
       .register('smoothScroll', new SmoothScroll(80))
       .register('lightbox', new Lightbox('.lightbox-trigger'))
       .register('accordionMenu', new AccordionMenu('#menu'));

    // Initialize application
    app.init();

    // Make app available globally (for debugging)
    window.MFApp = app;
});

// ============================================
// EXPORT (if using modules later)
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = { Application, Utils };
}