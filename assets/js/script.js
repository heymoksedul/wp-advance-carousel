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
                // Jump directly to the clicked slide
                this.jumpTo(index);
            }
        });
        
        // Animex Remote Arrows Integration
        this.$element.on('animex/carousel/prev', () => {
            this.movePrev();
        });
        
        this.$element.on('animex/carousel/next', () => {
            this.moveNext();
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
        this.jumpTo(this.currentIndex + 1);
    }

    movePrev() {
        this.jumpTo(this.currentIndex - 1);
    }

    jumpTo(newIndex) {
        const total = this.elements.$track[0].children.length;
        if (total === 0) return;
        
        let newOffset = newIndex - this.currentIndex;
        if (newOffset < 0) newOffset += total * Math.ceil(Math.abs(newOffset) / total);
        newOffset = newOffset % total;
        
        if (newOffset === 0) return;
        
        const numHiddenLeft = 3;
        const isLeft = (offset) => offset >= total - numHiddenLeft && offset < total;
        
        let jump = 0;
        if (isLeft(newOffset)) {
            jump = newOffset - total; // Jump backwards to reach left items
        } else {
            jump = newOffset; // Jump forwards to reach right items
        }
        
        this.currentIndex = newIndex;
        this.updateClasses(jump);
    }

    updateClasses(jump = 0) {
        const slides = Array.from(this.elements.$track[0].children);
        const total = slides.length;
        
        const numHiddenLeft = 3; 
        
        const isLeft = (offset) => offset >= total - numHiddenLeft && offset < total;
        const isRight = (offset) => offset >= 1 && offset < total - numHiddenLeft;
        
        slides.forEach((slide, index) => {
            // Calculate old offset
            let oldOffset = index - (this.currentIndex - jump);
            if (oldOffset < 0) oldOffset += total * Math.ceil(Math.abs(oldOffset) / total);
            oldOffset = oldOffset % total;
            
            // Calculate new offset
            let newOffset = index - this.currentIndex;
            if (newOffset < 0) newOffset += total * Math.ceil(Math.abs(newOffset) / total);
            newOffset = newOffset % total;
            
            slide.className = slide.className.replace(/ac-state-[^\s]+/g, '').trim();
            
            let newClass = '';
            if (newOffset === 0) {
                newClass = 'ac-state-active';
            } else if (newOffset >= 1 && newOffset <= 6) {
                newClass = `ac-state-${newOffset}`;
            } else if (isLeft(newOffset)) {
                newClass = 'ac-state-hidden-left';
            } else {
                newClass = 'ac-state-hidden-right';
            }
            
            const B = total - numHiddenLeft;
            let crossedBack = false;
            
            if (jump > 0) {
                if ((oldOffset >= B && oldOffset - jump < B) || (oldOffset < B && oldOffset - jump < B - total)) {
                    crossedBack = true;
                }
            } else if (jump < 0) {
                const absJump = Math.abs(jump);
                if ((oldOffset < B && oldOffset + absJump >= B) || (oldOffset >= B && oldOffset + absJump >= B + total)) {
                    crossedBack = true;
                }
            }
            
            if (crossedBack) {
                slide.style.transition = 'none';
                slide.classList.add(newClass);
                void slide.offsetWidth; 
                slide.style.transition = '';
            } else {
                slide.classList.add(newClass);
            }
        });
        
        this.updateBottomContent();
    }

    updateBottomContent() {
        const activeSlide = this.elements.$track[0].children[this.currentIndex];
        if (!activeSlide) return;
        
        const $slide = jQuery(activeSlide);
        const title = $slide.attr('data-title');
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
