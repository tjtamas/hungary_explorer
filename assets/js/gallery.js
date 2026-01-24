/**
 * Gallery JavaScript - Magyarország Felfedezői Szövetség
 * 
 * Lightbox and gallery functionality
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

'use strict';

// ============================================
// GALLERY LIGHTBOX CLASS
// ============================================

class GalleryLightbox {
    constructor(images = []) {
        this.images = images;
        this.currentIndex = 0;
        
        // DOM elements
        this.lightbox = document.getElementById('lightbox');
        this.lightboxImage = document.getElementById('lightbox-image');
        this.lightboxCaption = document.getElementById('lightbox-caption');
        this.lightboxCounter = document.getElementById('lightbox-counter');
        this.closeBtn = document.querySelector('.lightbox-close');
        this.prevBtn = document.querySelector('.lightbox-prev');
        this.nextBtn = document.querySelector('.lightbox-next');
        
        this.isOpen = false;
    }

    /**
     * Initialize lightbox
     */
    init() {
        if (!this.lightbox || !this.images.length) {
            console.warn('GalleryLightbox: No lightbox element or images found');
            return;
        }

        this.bindEvents();
        console.log('✅ GalleryLightbox initialized with', this.images.length, 'images');
    }

    /**
     * Bind all event listeners
     */
    bindEvents() {
        // Photo click events
        document.querySelectorAll('.photo-zoom').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index, 10);
                this.open(index);
            });
        });

        // Also allow clicking on photo itself
        document.querySelectorAll('.photo-thumb').forEach((img, index) => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', () => this.open(index));
        });

        // Close button
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.close());
        }

        // Navigation buttons
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prev());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.next());
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));

        // Click outside to close
        if (this.lightbox) {
            this.lightbox.addEventListener('click', (e) => {
                if (e.target === this.lightbox) {
                    this.close();
                }
            });
        }

        // Swipe support for mobile
        this.initSwipe();
    }

    /**
     * Open lightbox at specific index
     */
    open(index) {
        this.currentIndex = index;
        this.update();
        this.lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
        this.isOpen = true;
    }

    /**
     * Close lightbox
     */
    close() {
        this.lightbox.classList.remove('active');
        document.body.style.overflow = '';
        this.isOpen = false;
    }

    /**
     * Go to previous image
     */
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.update();
    }

    /**
     * Go to next image
     */
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.update();
    }

    /**
     * Update lightbox content
     */
    update() {
        const image = this.images[this.currentIndex];
        
        if (!image) return;

        // Add loading state
        this.lightboxImage.style.opacity = '0.5';
        
        // Preload image
        const img = new Image();
        img.onload = () => {
            this.lightboxImage.src = image.full;
            this.lightboxImage.alt = image.alt;
            this.lightboxImage.style.opacity = '1';
        };
        img.src = image.full;

        // Update caption and counter
        if (this.lightboxCaption) {
            this.lightboxCaption.textContent = image.alt || '';
        }
        
        if (this.lightboxCounter) {
            this.lightboxCounter.textContent = `${this.currentIndex + 1} / ${this.images.length}`;
        }
    }

    /**
     * Handle keyboard events
     */
    handleKeyboard(e) {
        if (!this.isOpen) return;

        switch (e.key) {
            case 'Escape':
                this.close();
                break;
            case 'ArrowLeft':
                this.prev();
                break;
            case 'ArrowRight':
                this.next();
                break;
        }
    }

    /**
     * Initialize swipe support for mobile
     */
    initSwipe() {
        let touchStartX = 0;
        let touchEndX = 0;

        if (!this.lightbox) return;

        this.lightbox.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        this.lightbox.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        }, { passive: true });
    }

    /**
     * Handle swipe gesture
     */
    handleSwipe(startX, endX) {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) < swipeThreshold) return;

        if (diff > 0) {
            // Swipe left - next image
            this.next();
        } else {
            // Swipe right - previous image
            this.prev();
        }
    }

    /**
     * Set images array
     */
    setImages(images) {
        this.images = images;
    }
}

// ============================================
// PHOTO GRID ANIMATIONS
// ============================================

class PhotoGridAnimator {
    constructor(selector = '.photo-item') {
        this.items = document.querySelectorAll(selector);
        this.observer = null;
    }

    /**
     * Initialize animations
     */
    init() {
        if (!this.items.length) return;

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });

        this.items.forEach(item => this.observer.observe(item));
        console.log('✅ PhotoGridAnimator initialized');
    }

    /**
     * Destroy observer
     */
    destroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
    }
}

// ============================================
// AUTO INITIALIZATION
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    // Check if we're on a gallery page
    const lightboxEl = document.getElementById('lightbox');
    
    if (lightboxEl && typeof galleryImages !== 'undefined') {
        // Initialize lightbox with images from PHP
        const lightbox = new GalleryLightbox(galleryImages);
        lightbox.init();
        
        // Make available globally for debugging
        window.galleryLightbox = lightbox;
    }

    // Initialize photo grid animations
    const animator = new PhotoGridAnimator('.photo-item');
    animator.init();
});

// ============================================
// EXPORT (if using modules later)
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = { GalleryLightbox, PhotoGridAnimator };
}