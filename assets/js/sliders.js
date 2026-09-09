/**
 * Hale Coffee - Slick sliders
 */
jQuery(function ($) {
  if (!$.fn.slick) {
    return;
  }

  $('.brand-slider').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 600,
    arrows: false,
    dots: false,
    infinite: true,
    pauseOnHover: false,
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
