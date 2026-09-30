/**
 * Hale Coffee - Slick sliders
 */

/**
 * Brands slider: swaps the description under the slider for the brand
 * that is clicked (or moved to by autoplay / swipe).
 */
function initBrandSlider() {
  const $slider = $('.brand-slider');
  const textEl = document.getElementById('brand-slider-text');

  if (!$slider.length || !textEl) {
    return;
  }

  const normalize = (value) => (value || '').replace(/\s+/g, ' ').trim();
  let current = normalize(textEl.innerHTML);
  let fadeTimer = null;

  const render = (value) => {
    const next = value || '';

    if (normalize(next) === current) {
      return;
    }

    current = normalize(next);
    textEl.classList.add('is-fading');
    window.clearTimeout(fadeTimer);
    fadeTimer = window.setTimeout(() => {
      textEl.innerHTML = next;
      textEl.classList.remove('is-fading');
    }, 200);
  };

  const activate = (logo) => {
    if (!logo) {
      return;
    }

    // Slick duplicates slides when infinite is on; data-slick-index maps a
    // clone back to its original slide so the highlight always lands on the
    // logo the visitor can actually see.
    const $slide = $(logo).closest('.slick-slide');
    const slideIndex = $slide.data('slick-index');
    const index = typeof slideIndex === 'number' ? slideIndex : $slider.find('.brand-logo').index(logo);
    const $target = $slider.find('.brand-logo').eq(Math.max(index, 0));

    $slider.find('.brand-logo').removeClass('is-active').attr('aria-pressed', 'false');
    $target.addClass('is-active').attr('aria-pressed', 'true');
    render(logo.getAttribute('data-brand-text'));
  };

  $slider.on('click', '.brand-logo', function (event) {
    event.preventDefault();
    activate(this);
  });

  $slider.on('keydown', '.brand-logo', function (event) {
    if (event.key !== 'ArrowRight' && event.key !== 'ArrowLeft') {
      return;
    }

    event.preventDefault();

    const $cloned = $slider.find('.slick-slide:not(.slick-cloned) .brand-logo');
    const $logos = $cloned.length ? $cloned : $slider.find('.brand-logo');
    const count = $logos.length;
    const startIndex = $(this).closest('.slick-slide').data('slick-index');
    const index = typeof startIndex === 'number' ? startIndex : $logos.index(this);
    const next = (index + (event.key === 'ArrowRight' ? 1 : -1) + count) % count;

    $logos.eq(next).trigger('focus');
    activate($logos.eq(next).get(0));
  });

  if ($.fn.slick && $slider.hasClass('slick-initialized')) {
    $slider.on('afterChange', function () {
      const $logos = $slider.find('.brand-logo');
      const index = $slider.slick('slickCurrentSlide');

      activate($logos.eq(index < 0 ? 0 : index).get(0));
    });
  }
}

jQuery(function ($) {
  initBrandSlider();

  if (!$.fn.slick) {
    return;
  }

  $('.brand-slider').slick({
    slidesToShow: 8,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 600,
    arrows: false,
    dots: false,
    infinite: true,
    pauseOnHover: true,
    responsive: [
      { breakpoint: 1200, settings: { slidesToShow: 4 } },
      { breakpoint: 992, settings: { slidesToShow: 3 } },
      { breakpoint: 768, settings: { slidesToShow: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 1 } },
    ],
  });

  $('.cate-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 600,
    arrows: false,
    dots: false,
    infinite: true,
    responsive: [
      { breakpoint: 1024, settings: { slidesToShow: 3 } },
      { breakpoint: 768, settings: { slidesToShow: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 1 } },
    ],
  });

  $('.noissue, .popular, .readytoship').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    speed: 600,
    arrows: true,
    dots: false,
    prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
    responsive: [
      { breakpoint: 1200, settings: { slidesToShow: 3 } },
      { breakpoint: 992, settings: { slidesToShow: 2 } },
      { breakpoint: 640, settings: { slidesToShow: 1 } },
    ],
  });

});
jQuery(document).ready(function ($) {

  const $slider = $('#smileSlider');

  $slider.slick({
    slidesToShow: 3.35,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    speed: 600,
    cssEase: 'ease',
    swipeToSlide: true,
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


  $('#smilePrev').on('click', function () {
    $slider.slick('slickPrev');
  });

  $('#smileNext').on('click', function () {
    $slider.slick('slickNext');
  });

});

jQuery(document).ready(function ($) {

  const $slider = $('#smileSlider');

  $slider.slick({
    slidesToShow: 3.35,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    speed: 600,
    cssEase: 'ease',
    swipeToSlide: true,
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


  $('#smilePrev').on('click', function () {
    $slider.slick('slickPrev');
  });

  $('#smileNext').on('click', function () {
    $slider.slick('slickNext');
  });

});
