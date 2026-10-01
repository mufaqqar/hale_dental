jQuery(function ($) {

    /**
     * ==========================================
     * BRAND SLIDER
     * ==========================================
     *
     * Logo = Tab
     * Active logo = Active content
     * Slick autoplay/swipe = Updates content
     */

    function initBrandSlider() {

        const $slider = $('.brand-slider');

        if (!$slider.length || !$.fn.slick) {
            return;
        }

        const $slides = $slider.children('.brand-slide');
        const slideCount = $slides.length;

        if (!slideCount) {
            return;
        }

        /*
         * Slick only builds infinite loop clones when there are MORE
         * slides than the number of visible slides. If they are equal
         * (or fewer) it creates no clones, so the carousel never moves.
         *
         * Cap every slidesToShow value to slideCount - 1 so the
         * autoplay + infinite loop always has room to scroll.
         */
        const maxVisible = Math.max(slideCount - 1, 1);

        const visible = (value) =>
            Math.max(Math.min(value, maxVisible), 1);

        /*
         * Initialize Slick
         */
        $slider.slick({
            slidesToShow: visible(6),
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            dots: false,
            infinite: true,
            centerMode: false,
            pauseOnHover: false,
            pauseOnFocus: false,
            swipeToSlide: true,

            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: visible(4)
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: visible(3)
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: visible(2)
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });


        /*
         * Get the real/original brand slides.
         *
         * Slick creates cloned slides when infinite = true,
         * so we always work with the original slides.
         */
        const getOriginalLogos = () => {

            const $logos = $slider.find(
                '.slick-slide:not(.slick-cloned) .brand-logo'
            );

            return $logos.length
                ? $logos
                : $slider.find('.brand-logo');

        };


        /*
         * Get brand content.
         */
        const $contents = $('.brand-content');


        /*
         * Update active logo + content
         */
        function setActiveBrand(index) {

            const $logos = getOriginalLogos();

            if (!$logos.length) {
                return;
            }

            const count = $logos.length;

            /*
             * Make sure index stays inside the valid range.
             */
            index = ((index % count) + count) % count;


            /*
             * Update logos
             */
            $slider
                .find('.brand-logo')
                .removeClass('is-active')
                .attr('aria-pressed', 'false')
                .attr('aria-selected', 'false');

            /*
             * Activate the logo plus any Slick clone that shares the
             * same brand index, so the active logo stays visible
             * while the carousel loops.
             */
            const $indexed = $slider.find(
                '.brand-slide[data-brand-index="' + index + '"] .brand-logo'
            );

            const $active = $indexed.length
                ? $indexed
                : $logos.eq(index);

            $active
                .addClass('is-active')
                .attr('aria-pressed', 'true')
                .attr('aria-selected', 'true');


            /*
             * Update content
             */
            $contents.each(function (contentIndex) {

                const isActive = contentIndex === index;
                const $content = $(this);

                $content.toggleClass('is-active', isActive);

                if (isActive) {
                    $content.removeAttr('hidden');
                } else {
                    $content.attr('hidden', '');
                }

            });

        }


        /*
         * Initial active brand
         */
        setActiveBrand(
            $slider.slick('slickCurrentSlide') || 0
        );


        /*
         * Logo click
         */
        $slider.on('click', '.brand-logo', function (event) {

            event.preventDefault();

            const $logo = $(this);
            const $slide = $logo.closest('.slick-slide');

            let index = $slide.data('slick-index');

            /*
             * Slick clone index can be negative or outside
             * the original slide range.
             */
            const $logos = getOriginalLogos();
            const count = $logos.length;

            if (typeof index !== 'number') {
                index = $logos.index(
                    $slider
                        .find('.brand-logo')
                        .filter(function () {
                            return $(this).attr('title') === $logo.attr('title');
                        })
                        .first()
                );
            }

            if (index < 0) {
                index = ((index % count) + count) % count;
            }

            index = index % count;


            /*
             * Move Slick to selected brand.
             */
            $slider.slick('slickGoTo', index);


            /*
             * Immediately update the content.
             */
            setActiveBrand(index);

        });


        /*
         * Keyboard navigation
         */
        $slider.on('keydown', '.brand-logo', function (event) {

            if (
                event.key !== 'ArrowRight' &&
                event.key !== 'ArrowLeft'
            ) {
                return;
            }

            event.preventDefault();

            const $logos = getOriginalLogos();
            const count = $logos.length;

            if (!count) {
                return;
            }

            const $currentSlide = $(this).closest('.slick-slide');

            let currentIndex = $currentSlide.data('slick-index');

            if (typeof currentIndex !== 'number') {
                currentIndex = 0;
            }

            currentIndex =
                ((currentIndex % count) + count) % count;


            const direction =
                event.key === 'ArrowRight' ? 1 : -1;

            const nextIndex =
                (currentIndex + direction + count) % count;


            const $nextLogo = $logos.eq(nextIndex);

            $nextLogo.trigger('focus');

            $slider.slick('slickGoTo', nextIndex);

            setActiveBrand(nextIndex);

        });


        /*
         * Slick autoplay / swipe / arrows
         *
         * Every time Slick changes slide,
         * update the corresponding content.
         */
        $slider.on(
            'afterChange',
            function (event, slick, currentSlide) {

                setActiveBrand(currentSlide);

            }
        );

    }


    /**
     * ==========================================
     * OTHER SLIDERS
     * ==========================================
     */

    function initCategorySlider() {

        const $slider = $('.cate-slider');

        if (!$slider.length || !$.fn.slick) {
            return;
        }

        $slider.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 600,
            arrows: false,
            dots: false,
            infinite: true,

            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

    }


    function initProductSliders() {

        const $sliders = $('.noissue, .popular, .readytoship');

        if (!$sliders.length || !$.fn.slick) {
            return;
        }

        $sliders.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            speed: 600,
            arrows: true,
            dots: false,

            prevArrow:
                '<button type="button" class="slick-prev">' +
                '<i class="fa-solid fa-chevron-left"></i>' +
                '</button>',

            nextArrow:
                '<button type="button" class="slick-next">' +
                '<i class="fa-solid fa-chevron-right"></i>' +
                '</button>',

            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

    }


    function initSmileSlider() {

        const $slider = $('#smileSlider');

        if (!$slider.length || !$.fn.slick) {
            return;
        }

        $slider.slick({
            slidesToShow: 3.35,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
            dots: false,
            speed: 600,
            cssEase: 'ease',
            swipeToSlide: false,
            touchThreshold: 10,

            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2.7
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2.2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1.15,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1.05
                    }
                }
            ]
        });


        /*
         * Custom smile slider buttons
         */
        $('#smilePrev').on('click', function () {
            $slider.slick('slickPrev');
        });

        $('#smileNext').on('click', function () {
            $slider.slick('slickNext');
        });

    }


    /**
     * ==========================================
     * INITIALIZE ALL SLIDERS
     * ==========================================
     */

    initBrandSlider();
    initCategorySlider();
    initProductSliders();
    initSmileSlider();

});


/**
 * ==========================================
 * BEFORE / AFTER IMAGE COMPARISON
 * ==========================================
 */

function initBeforeAfterSliders() {

    const cards = document.querySelectorAll('[data-before-after]');

    if (!cards.length) {
        return;
    }

    cards.forEach((card) => {

        const afterWrapper = card.querySelector('[data-after-wrapper]');
        const divider = card.querySelector('[data-divider]');
        const handle = card.querySelector('[data-handle]');

        if (!afterWrapper || !divider || !handle) {
            return;
        }

        let isDragging = false;


        /**
         * ==========================================
         * UPDATE POSITION
         * ==========================================
         */

        function updatePosition(clientX) {

            const rect = card.getBoundingClientRect();

            let position =
                ((clientX - rect.left) / rect.width) * 100;

            /*
             * Keep divider inside the card.
             */
            position = Math.max(
                0,
                Math.min(100, position)
            );


            /*
             * Move divider
             */
            divider.style.left = `${position}%`;


            /*
             * Move handle
             */
            handle.style.left = `${position}%`;


            /*
             * Reveal After image
             */
            afterWrapper.style.width = `${position}%`;

        }


        /**
         * ==========================================
         * START DRAG
         * ==========================================
         */

        function startDrag(event) {

            /*
             * IMPORTANT:
             * Stop Slick from receiving this interaction.
             */
            event.preventDefault();
            event.stopPropagation();

            isDragging = true;

            card.classList.add('is-comparing');


            /*
             * Capture pointer so dragging continues
             * even if pointer moves outside the handle.
             */
            if (event.pointerId !== undefined) {

                try {
                    event.target.setPointerCapture(
                        event.pointerId
                    );
                } catch (error) {
                    // Ignore unsupported pointer capture.
                }

            }


            updatePosition(event.clientX);

        }


        /**
         * ==========================================
         * MOVE DRAG
         * ==========================================
         */

        function moveDrag(event) {

            if (!isDragging) {
                return;
            }

            /*
             * Prevent page scrolling and Slick movement.
             */
            event.preventDefault();
            event.stopPropagation();

            updatePosition(event.clientX);

        }


        /**
         * ==========================================
         * END DRAG
         * ==========================================
         */

        function stopDrag(event) {

            if (!isDragging) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            isDragging = false;

            card.classList.remove('is-comparing');

        }


        /**
         * ==========================================
         * HANDLE
         * ==========================================
         */

        handle.addEventListener(
            'pointerdown',
            startDrag
        );

        handle.addEventListener(
            'pointermove',
            moveDrag
        );

        handle.addEventListener(
            'pointerup',
            stopDrag
        );

        handle.addEventListener(
            'pointercancel',
            stopDrag
        );


        /**
         * ==========================================
         * DIVIDER
         * ==========================================
         */

        divider.addEventListener(
            'pointerdown',
            startDrag
        );

        divider.addEventListener(
            'pointermove',
            moveDrag
        );

        divider.addEventListener(
            'pointerup',
            stopDrag
        );

        divider.addEventListener(
            'pointercancel',
            stopDrag
        );


        /**
         * ==========================================
         * CLICK ANYWHERE ON COMPARISON
         * ==========================================
         *
         * Clicking the image moves the divider.
         */

        card.addEventListener(
            'click',
            function (event) {

                /*
                 * Don't handle clicks coming from
                 * the drag handle.
                 */
                if (
                    event.target === handle ||
                    handle.contains(event.target)
                ) {
                    return;
                }

                /*
                 * Don't interfere with Slick's
                 * normal click behavior.
                 */
                if (
                    event.target.closest('.slick-arrow')
                ) {
                    return;
                }

                updatePosition(event.clientX);

            }
        );

    });

}