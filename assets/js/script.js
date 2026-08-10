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
        
        // Allow clicking on any slide to make it active
        this.elements.$track.on('click', '.advance-carousel-slide', (e) => {
            const index = jQuery(e.currentTarget).index();
            if (index > 0) {
                // If clicked slide is not first, move next until it is first
                for(let i=0; i<index; i++){
                    this.moveNext();
                }
            }
        });
    }

    onInit() {
        super.onInit();
        this.updateBottomContent();
        
        // Autoplay
        const settings = this.$element.find('.advance-carousel-wrapper').data('settings');
        if (settings && settings.autoplay) {
            this.autoplayInterval = setInterval(() => this.moveNext(), settings.speed || 3000);
            
            // Pause on hover
            this.$element.on('mouseenter', () => clearInterval(this.autoplayInterval));
            this.$element.on('mouseleave', () => {
                this.autoplayInterval = setInterval(() => this.moveNext(), settings.speed || 3000);
            });
        }
    }

    moveNext() {
        const track = this.elements.$track[0];
        const first = track.firstElementChild;
        track.appendChild(first);
        this.updateBottomContent();
    }

    movePrev() {
        const track = this.elements.$track[0];
        const last = track.lastElementChild;
        track.prepend(last);
        this.updateBottomContent();
    }

    updateBottomContent() {
        const activeSlide = this.elements.$track[0].firstElementChild;
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
