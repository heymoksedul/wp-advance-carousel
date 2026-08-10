class AdvanceHighlightCarouselHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                swiperContainer: '.advance-highlight-swiper',
                nextEl: '.advance-swiper-button-next',
                prevEl: '.advance-swiper-button-prev',
                descEl: '.js-dynamic-desc',
                actionEl: '.js-dynamic-action',
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $swiperContainer: this.$element.find( selectors.swiperContainer ),
            $nextEl: this.$element.find( selectors.nextEl ),
            $prevEl: this.$element.find( selectors.prevEl ),
            $descEl: this.$element.find( selectors.descEl ),
            $actionEl: this.$element.find( selectors.actionEl ),
        };
    }

    onInit() {
        super.onInit();
        this.initSwiper();
    }

    updateBottomContent(activeSlide) {
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
            const targetAttr = isExternal ? 'target="_blank"' : '';
            const href = (link && link !== '#') ? link : 'javascript:void(0)';
            this.elements.$actionEl.html(`<a href="${href}" class="advance-slide-link" ${targetAttr}>${linkText} <i class="eicon-chevron-right" aria-hidden="true"></i></a>`);
        } else {
            this.elements.$actionEl.html('');
        }
    }

    async initSwiper() {
        const { $swiperContainer, $nextEl, $prevEl } = this.elements;
        
        if ( ! $swiperContainer.length ) {
            return;
        }

        const settingsWrapper = this.$element.find('.advance-carousel-wrapper');
        let customSettings = {};
        if (settingsWrapper.length) {
            try {
                customSettings = JSON.parse(settingsWrapper.attr('data-swiper-settings'));
            } catch (e) {}
        }

        const Swiper = elementorFrontend.utils.swiper;
        
        const self = this;
        const swiperOptions = {
            slidesPerView: 'auto',
            centeredSlides: false,
            spaceBetween: customSettings.spaceBetween || 20,
            loop: true,
            allowTouchMove: false,
            watchSlidesProgress: true,
            speed: 600,
            navigation: {
                nextEl: $nextEl[0],
                prevEl: $prevEl[0],
            },
            autoplay: customSettings.autoplay || false,
            slideToClickedSlide: true,
            on: {
                init: function () {
                    self.updateBottomContent(this.slides[this.activeIndex]);
                },
                slideChange: function () {
                    self.updateBottomContent(this.slides[this.activeIndex]);
                },
                slideChangeTransitionStart: function (swiper) {
                    // Force Swiper to continuously recalculate wrapper translation 
                    // while CSS width transition is happening (600ms)
                    let start = null;
                    const duration = 600;
                    function step(timestamp) {
                        if (!start) start = timestamp;
                        const progress = timestamp - start;
                        swiper.updateSize();
                        swiper.updateSlides();
                        if (progress < duration) {
                            window.requestAnimationFrame(step);
                        }
                    }
                    window.requestAnimationFrame(step);
                }
            }
        };

        this.swiper = new Swiper( $swiperContainer, swiperOptions );
        
        if ( this.swiper instanceof Promise ) {
            this.swiper = await this.swiper;
        }
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( AdvanceHighlightCarouselHandler, {
            $element,
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/advance_highlight_carousel.default', addHandler );
} );
