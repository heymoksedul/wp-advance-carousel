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

class SmoothMarqueeHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.smooth-marquee-wrapper',
                playPauseBtn: '.smooth-marquee-play-pause',
                playPauseIcon: '#sm-play-pause-icon'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $wrapper: this.$element.find(selectors.wrapper),
            $playPauseBtn: this.$element.find(selectors.playPauseBtn),
            $playPauseIcon: this.$element.find(selectors.playPauseIcon)
        };
    }

    bindEvents() {
        if (this.elements.$playPauseBtn.length) {
            this.elements.$playPauseBtn.on('click', () => {
                this.togglePlayPause();
            });
        }
    }

    onInit() {
        super.onInit();
        this.isPaused = false;
    }

    togglePlayPause() {
        this.isPaused = !this.isPaused;
        if (this.isPaused) {
            this.elements.$wrapper.addClass('sm-paused');
        } else {
            this.elements.$wrapper.removeClass('sm-paused');
        }
    }
}

class InteractiveSliderHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.is-slider-wrapper',
                track: '.swiper-wrapper',
                cursor: '.is-custom-cursor'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $wrapper: this.$element.find(selectors.wrapper),
            $track: this.$element.find(selectors.track),
            $cursor: this.$element.find(selectors.cursor)
        };
    }

    bindEvents() {
        const wrapper = this.elements.$wrapper[0];
        
        wrapper.addEventListener('mousemove', (e) => {
            // Fix: Move cursor relative to the viewport since position is fixed!
            this.elements.$cursor[0].style.left = `${e.clientX}px`;
            this.elements.$cursor[0].style.top = `${e.clientY}px`;
            
            const rect = wrapper.getBoundingClientRect();
            const x = e.clientX - rect.left;
            
            // Determine direction based on mouse position relative to wrapper width
            if (x < rect.width / 2) {
                this.elements.$cursor.removeClass('dir-right').addClass('dir-left');
                this.currentDirection = -1;
            } else {
                this.elements.$cursor.removeClass('dir-left').addClass('dir-right');
                this.currentDirection = 1;
            }
        });
        
        wrapper.addEventListener('click', () => {
            if (this.swiper) {
                if (this.currentDirection === -1) {
                    this.swiper.slidePrev();
                } else {
                    this.swiper.slideNext();
                }
            }
        });
    }

    onInit() {
        super.onInit();
        this.currentDirection = 1;
        
        // Retrieve gap setting from Elementor
        const settings = this.getElementSettings();
        let spaceBetween = 40;
        if (settings.item_gap !== undefined) {
            if (typeof settings.item_gap === 'object' && settings.item_gap.size !== undefined) {
                spaceBetween = settings.item_gap.size === '' ? 40 : Number(settings.item_gap.size);
            } else if (typeof settings.item_gap === 'number' || typeof settings.item_gap === 'string') {
                spaceBetween = settings.item_gap === '' ? 40 : Number(settings.item_gap);
            }
        }
        const transitionDuration = settings.transition_duration ? settings.transition_duration : 600;
        
        const inactiveScale = settings.inactive_scale ? settings.inactive_scale.size : 0.7;
        
        // Initialize Swiper
        const swiperOptions = {
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: spaceBetween,
            speed: transitionDuration,
            grabCursor: false, // We use custom cursor
        };
        
        // Depending on Elementor version, Swiper is available natively
        const Swiper = elementorFrontend.utils.swiper;
        if ('function' === typeof Swiper) {
            new Swiper(this.elements.$wrapper[0] || this.elements.$wrapper, swiperOptions).then((swiperInstance) => {
                this.swiper = swiperInstance;
            }).catch(() => {
                if (window.Swiper) {
                    this.swiper = new window.Swiper(this.elements.$wrapper[0] || this.elements.$wrapper, swiperOptions);
                }
            });
        } else if (window.Swiper) {
            this.swiper = new window.Swiper(this.elements.$wrapper[0] || this.elements.$wrapper, swiperOptions);
        }
    }
}

class InteractiveCardSliderHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.aic-card-slider-wrapper',
                container: '.aic-swiper-container',
                prevBtn: '.aic-btn-prev',
                nextBtn: '.aic-btn-next',
                pagination: '.aic-pagination'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $wrapper: this.$element.find(selectors.wrapper),
            $container: this.$element.find(selectors.container),
            $prevBtn: this.$element.find(selectors.prevBtn),
            $nextBtn: this.$element.find(selectors.nextBtn),
            $pagination: this.$element.find(selectors.pagination)
        };
    }

    bindEvents() {
        // Animex Remote Navigation Integration
        this.$element.on('animex/carousel/prev', () => {
            if (this.swiper) this.swiper.slidePrev();
        });
        
        this.$element.on('animex/carousel/next', () => {
            if (this.swiper) this.swiper.slideNext();
        });
    }

    onInit() {
        super.onInit();
        this.initSwiper();
    }

    initSwiper() {
        const $container = this.elements.$container;
        if (!$container.length) return;

        const config = this.elements.$wrapper.data('slider-config') || {};

        const swiperOptions = {
            slidesPerView: config.slidesPerView || 3.5,
            spaceBetween: config.spaceBetween !== undefined ? config.spaceBetween : 24,
            loop: config.loop !== false,
            speed: config.speed || 600,
            grabCursor: true,
            breakpoints: config.breakpoints || {
                320: { slidesPerView: 1.2, spaceBetween: 16 },
                768: { slidesPerView: 2.2, spaceBetween: 20 },
                1025: { slidesPerView: 3.5, spaceBetween: 24 }
            }
        };

        if (config.autoplay) {
            swiperOptions.autoplay = config.autoplay;
        }

        // Navigation Arrows
        if (this.elements.$nextBtn.length || this.elements.$prevBtn.length) {
            swiperOptions.navigation = {
                nextEl: this.elements.$nextBtn[0],
                prevEl: this.elements.$prevBtn[0]
            };
        }

        // Pagination
        if (this.elements.$pagination.length) {
            swiperOptions.pagination = {
                el: this.elements.$pagination[0],
                type: config.paginationType || 'bullets',
                clickable: true
            };
        }

        const Swiper = elementorFrontend.utils.swiper;
        if ('function' === typeof Swiper) {
            new Swiper($container[0], swiperOptions).then((swiperInstance) => {
                this.swiper = swiperInstance;
            }).catch(() => {
                if (window.Swiper) {
                    this.swiper = new window.Swiper($container[0], swiperOptions);
                }
            });
        } else if (window.Swiper) {
            this.swiper = new window.Swiper($container[0], swiperOptions);
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/advance-highlight-carousel.default', function($element) {
        elementorFrontend.elementsHandler.addHandler(AdvanceHighlightCarouselHandler, {
            $element: $element
        });
    });
    
    elementorFrontend.hooks.addAction('frontend/element_ready/smooth-marquee-carousel.default', function($element) {
        elementorFrontend.elementsHandler.addHandler(SmoothMarqueeHandler, {
            $element: $element
        });
    });
    
    elementorFrontend.hooks.addAction('frontend/element_ready/interactive-slider-carousel.default', function($element) {
        elementorFrontend.elementsHandler.addHandler(InteractiveSliderHandler, {
            $element: $element
        });
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/interactive-card-slider.default', function($element) {
        elementorFrontend.elementsHandler.addHandler(InteractiveCardSliderHandler, {
            $element: $element
        });
    });
});
