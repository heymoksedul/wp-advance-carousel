class AdvanceHighlightCarouselHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                track: '.advance-highlight-carousel',
                nextEl: '.advance-carousel-nav-next',
                prevEl: '.advance-carousel-nav-prev',
                descEl: '.advance-carousel-desc',
                actionEl: '.advance-carousel-action',
                slide: '.advance-carousel-slide'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $track: this.$element.find(selectors.track),
            $nextEl: this.$element.find(selectors.nextEl),
            $prevEl: this.$element.find(selectors.prevEl),
            $descEl: this.$element.find(selectors.descEl),
            $actionEl: this.$element.find(selectors.actionEl)
        };
    }

    bindEvents() {
        this.elements.$nextEl.on('click', () => this.moveNext());
        this.elements.$prevEl.on('click', () => this.movePrev());
        
        this.elements.$track.on('click', '.advance-carousel-slide', (e) => {
            const index = jQuery(e.currentTarget).index();
            if (index !== this.currentIndex) {
                this.currentIndex = index;
                this.updateClasses();
            }
        });
    }

    onInit() {
        super.onInit();
        this.currentIndex = 0;
        
        // Ensure classes are perfectly synced with JS state on init
        this.updateClasses();
        
        const settings = this.$element.find('.advance-carousel-wrapper').data('settings');
        if (settings && settings.autoplay) {
            this.startAutoplay(settings.speed);
            
            this.$element.on('mouseenter', () => this.stopAutoplay());
            this.$element.on('mouseleave', () => this.startAutoplay(settings.speed));
        }
    }
    
    startAutoplay(speed) {
        if (this.autoplayInterval) clearInterval(this.autoplayInterval);
        this.autoplayInterval = setInterval(() => this.moveNext(), speed || 3000);
    }
    
    stopAutoplay() {
        if (this.autoplayInterval) clearInterval(this.autoplayInterval);
    }

    moveNext() {
        const total = this.elements.$track[0].children.length;
        this.currentIndex = (this.currentIndex + 1) % total;
        this.updateClasses();
    }

    movePrev() {
        const total = this.elements.$track[0].children.length;
        this.currentIndex = (this.currentIndex - 1 + total) % total;
        this.updateClasses();
    }

    updateClasses() {
        const slides = Array.from(this.elements.$track[0].children);
        const total = slides.length;
        
        slides.forEach((slide, index) => {
            // Remove old states (ac-state-active, ac-state-1, ac-state-hidden-left, etc)
            slide.className = slide.className.replace(/ac-state-[^\s]+/g, '').trim();
            
            // Calculate relative offset from currentIndex
            let offset = index - this.currentIndex;
            if (offset < 0) {
                offset += total; // wrap around
            }
            
            // Apply new state class based on offset
            if (offset === 0) {
                slide.classList.add('ac-state-active');
            } else if (offset >= 1 && offset <= 6) {
                slide.classList.add(`ac-state-${offset}`);
            } else if (offset === total - 1) {
                slide.classList.add('ac-state-hidden-left');
            } else {
                slide.classList.add('ac-state-hidden-right');
            }
        });
        
        this.updateBottomContent();
    }

    updateBottomContent() {
        const activeSlide = this.elements.$track[0].children[this.currentIndex];
        if (!activeSlide) return;
        
        const $slide = jQuery(activeSlide);
        const desc = $slide.attr('data-desc');
        const link = $slide.attr('data-link');
        const linkText = $slide.attr('data-link-text');
        const isExternal = $slide.attr('data-external');

        if (desc) {
            this.elements.$descEl.html(desc);
        } else {
            this.elements.$descEl.html('');
        }

        if (linkText) {
            const targetAttr = isExternal === 'true' ? 'target="_blank"' : '';
            const href = (link && link !== '#') ? link : 'javascript:void(0)';
            this.elements.$actionEl.html(`<a href="${href}" class="advance-slide-link" ${targetAttr}>${linkText} <i class="eicon-chevron-right" aria-hidden="true"></i></a>`);
        } else {
            this.elements.$actionEl.html('');
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/advance-highlight-carousel.default', function($element) {
        elementorFrontend.elementsHandler.addHandler(AdvanceHighlightCarouselHandler, {
            $element: $element
        });
    });
});
