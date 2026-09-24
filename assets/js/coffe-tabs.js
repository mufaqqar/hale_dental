/**
 * Hale Coffee - Tabs, accordions & quote form
 */
jQuery(function ($) {
  /* ===== FAQ accordion ===== */
  $('.faq-title').on('click', function () {
    var item = $(this).closest('.faq-item');
    var content = item.find('.faq-content');

    item.toggleClass('open');
    content.toggleClass('open');
  });

  /* ===== Available worldwide accordion ===== */
  $('.avail-faq-title').on('click', function () {
    var item = $(this).closest('.avail-faq-item');
    var content = item.find('.avail-faq-content');

    $('.avail-faq-item').removeClass('open');
    $('.avail-faq-content').removeClass('open');

    item.addClass('open');
    content.addClass('open');
  });

  /* ===== Quote / contact form ===== */
  $('#contact-form').on('submit', function (e) {
    e.preventDefault();

    var form = $(this);
    var data = {
      action: 'hale_contact_submit',
      fullname: form.find('#fullname').val(),
      phone: form.find('#phone').val(),
      email: form.find('#email').val(),
      product: form.find('#product').val(),
      message: form.find('#message').val(),
    };

    var valid = true;
    $('.error-message').text('');

    if (!data.fullname.trim()) { form.find('#fullname').next('.error-message').text('Please enter your name.'); valid = false; }
    if (!data.phone.trim()) { form.find('#phone').next('.error-message').text('Please enter your phone number.'); valid = false; }
    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(data.email)) { form.find('#email').next('.error-message').text('Please enter a valid email.'); valid = false; }
    if (!data.message.trim()) { form.find('#message').next('.error-message').text('Please write a message.'); valid = false; }
    if (!form.find('#acceptance').is(':checked')) { form.find('.acceptance-error').text('Please accept the data storage notice.'); valid = false; }

    if (!valid) return;

    var btn = form.find('.form_btn');
    btn.prop('disabled', true).text('Sending...');

    $.post(window.haleCf ? window.haleCf.ajaxUrl : '/wp-admin/admin-ajax.php', data)
      .done(function (res) {
        if (res && res.success) {
          form[0].reset();
          form.find('.error-message').text('');
          form.find('.acceptance-error').text('').addClass('text-green-300').text('Thank you! Your message has been sent.');
        } else {
          form.find('.acceptance-error').text(res && res.data ? res.data : 'Something went wrong. Please try again.');
        }
      })
      .fail(function () {
        form.find('.acceptance-error').text('Network error. Please try again.');
      })
      .always(function () {
        btn.prop('disabled', false).text('Submit');
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {

  const track = document.getElementById("journeyTrack");
  const tabs = document.querySelectorAll(".journey-tab");
  const prevBtn = document.getElementById("journeyPrev");
  const nextBtn = document.getElementById("journeyNext");

  if (!track || !tabs.length) return;


  /*
  |--------------------------------------------------------------------------
  | SLIDER DATA
  |--------------------------------------------------------------------------
  */

  const slides = {
    face: [
      "face/1.webp",
      "face/2.webp",
      "face/3.webp",
      "face/4.webp",
      "face/5.webp",
      "face/6.webp",
      "face/7.webp",
      "face/1.webp"
    ],

    hair: [
      "face/1.webp",
      "face/2.webp",
      "face/3.webp",
      "face/4.webp",
      "face/5.webp",
      "face/6.webp",
      "face/7.webp",
      "face/1.webp"
    ],

    dentistry: [
      "face/1.webp",
      "face/2.webp",
      "face/3.webp",
      "face/4.webp",
      "face/5.webp",
      "face/6.webp",
      "face/7.webp",
      "face/1.webp"
    ]
  };


  /*
  |--------------------------------------------------------------------------
  | CURRENT STATE
  |--------------------------------------------------------------------------
  */

  let currentCategory = "face";
  let currentIndex = 3;


  /*
  |--------------------------------------------------------------------------
  | BUILD SLIDER
  |--------------------------------------------------------------------------
  */

  function buildSlider(category) {

    const imagePath = window.haleCf ? window.haleCf.templateUri + "/assets/images/" : "/assets/images/";

    track.innerHTML = "";

    slides[category].forEach(function (image, index) {

      const slide = document.createElement("div");

      slide.className =
        "journey-slide shrink-0 overflow-hidden rounded-[17px] transition-all duration-500";

      if (index === 3) {
        slide.classList.add(
          "journey-slide-active",
          "rounded-[18px]",
          "border",
          "border-white/5"
        );
      }

      slide.innerHTML = `
                <img
                    src="${imagePath}${image}"
                    alt="${category} transformation"
                    class="h-full w-full object-cover"
                >
            `;

      track.appendChild(slide);
    });

    currentIndex = 3;

    updateSlider(false);
  }


  /*
  |--------------------------------------------------------------------------
  | UPDATE SLIDER
  |--------------------------------------------------------------------------
  */

  function updateSlider(animate = true) {

    const slidesElements =
      track.querySelectorAll(".journey-slide");

    if (!slidesElements.length) return;

    slidesElements.forEach(function (slide, index) {

      const distance = Math.abs(index - currentIndex);

      /*
      Center image
      */
      if (index === currentIndex) {

        slide.classList.add(
          "journey-slide-active"
        );

        slide.style.width = "298px";
        slide.style.height = "300px";
        slide.style.opacity = "1";
        slide.style.filter = "none";
        slide.style.zIndex = "10";

      }

      /*
      Adjacent images
      */
      else if (distance === 1) {

        slide.classList.remove(
          "journey-slide-active"
        );

        slide.style.width = "210px";
        slide.style.height = "213px";
        slide.style.opacity = "0.55";
        slide.style.filter = "brightness(.65)";
        slide.style.zIndex = "5";

      }

      /*
      Far images
      */
      else {

        slide.classList.remove(
          "journey-slide-active"
        );

        slide.style.width = "210px";
        slide.style.height = "213px";
        slide.style.opacity = "0.35";
        slide.style.filter = "brightness(.55)";
        slide.style.zIndex = "3";

      }
    });


    /*
    Calculate center position
    */

    const activeSlide =
      slidesElements[currentIndex];

    if (!activeSlide) return;

    const trackWidth =
      track.parentElement.offsetWidth;

    const activeCenter =
      activeSlide.offsetLeft +
      activeSlide.offsetWidth / 2;

    const translate =
      (trackWidth / 2) - activeCenter;

    track.style.transition =
      animate
        ? "transform 500ms ease"
        : "none";

    track.style.transform =
      `translateX(calc(-50% + ${translate}px))`;
  }


  /*
  |--------------------------------------------------------------------------
  | NEXT
  |--------------------------------------------------------------------------
  */

  nextBtn.addEventListener("click", function () {

    const slidesElements =
      track.querySelectorAll(".journey-slide");

    if (currentIndex < slidesElements.length - 1) {
      currentIndex++;
      updateSlider();
    }

  });


  /*
  |--------------------------------------------------------------------------
  | PREVIOUS
  |--------------------------------------------------------------------------
  */

  prevBtn.addEventListener("click", function () {

    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }

  });


  /*
  |--------------------------------------------------------------------------
  | TABS
  |--------------------------------------------------------------------------
  */

  tabs.forEach(function (tab) {

    tab.addEventListener("click", function () {

      const category =
        tab.dataset.tab;

      currentCategory = category;


      /*
      Active tab
      */

      tabs.forEach(function (item) {

        item.classList.remove(
          "active",
          " ",
          "text-[#f3a895]"
        );

        item.classList.add(
          "font-normal",
          "text-white/40"
        );

        item.setAttribute(
          "aria-selected",
          "false"
        );
      });


      tab.classList.add(
        "active",
        " ",
        "text-[#f3a895]"
      );

      tab.classList.remove(
        "font-normal",
        "text-white/40"
      );

      tab.setAttribute(
        "aria-selected",
        "true"
      );


      /*
      Load category
      */

      buildSlider(category);

    });

  });


  /*
  |--------------------------------------------------------------------------
  | INITIALIZE
  |--------------------------------------------------------------------------
  */

  buildSlider("face");


  /*
  |--------------------------------------------------------------------------
  | RESIZE
  |--------------------------------------------------------------------------
  */

  window.addEventListener("resize", function () {
    updateSlider(false);
  });

});

document.addEventListener('DOMContentLoaded', function () {

  const faqContainer = document.getElementById('services');

  if (!faqContainer) {
    return;
  }


  const faqItems = faqContainer.querySelectorAll('[data-service-item]');


  faqItems.forEach(function (item) {

    const button = item.querySelector('[data-service-button]');
    const title = item.querySelector('.service-title');
    const answer = item.querySelector('.service-answer');
    const icon = item.querySelector('.service-icon');
    const background = item.querySelector('.service-bg');


    if (!button) {
      return;
    }


    button.addEventListener('click', function () {

      const currentlyOpen =
        button.getAttribute('aria-expanded') === 'true';


      /*
      =========================================
      CLOSE ALL service ITEMS
      =========================================
      */

      faqItems.forEach(function (otherItem) {

        const otherButton =
          otherItem.querySelector('[data-service-button]');

        const otherTitle =
          otherItem.querySelector('.service-title');

        const otherAnswer =
          otherItem.querySelector('.service-answer');

        const otherIcon =
          otherItem.querySelector('.service-icon');

        const otherBackground =
          otherItem.querySelector('.service-bg');


        if (!otherButton) {
          return;
        }


        /* Button state */
        otherButton.setAttribute(
          'aria-expanded',
          'false'
        );


        /* Background */
        if (otherBackground) {

          otherBackground.classList.remove(
            'opacity-100'
          );

          otherBackground.classList.add(
            'opacity-0'
          );
        }


        /* Title */
        if (otherTitle) {

          otherTitle.classList.remove(
            'text-white'
          );

          otherTitle.classList.add(
            'text-[#333]'
          );
        }


        /* Answer */
        if (otherAnswer) {

          otherAnswer.classList.remove(
            'max-h-[100px]',
            'opacity-100'
          );

          otherAnswer.classList.add(
            'max-h-0',
            'opacity-0'
          );
        }


        /* Icon */
        if (otherIcon) {

          otherIcon.textContent = '+';

        }

      });


      /*
      =========================================
      OPEN CLICKED ITEM
      =========================================
      */

      if (!currentlyOpen) {

        button.setAttribute(
          'aria-expanded',
          'true'
        );


        /* Background */
        if (background) {

          background.classList.remove(
            'opacity-0'
          );

          background.classList.add(
            'opacity-100'
          );

        }


        /* Title */
        if (title) {

          title.classList.remove(
            'text-[#333]'
          );

          title.classList.add(
            'text-white'
          );

        }


        /* Answer */
        if (answer) {

          answer.classList.remove(
            'max-h-0',
            'opacity-0'
          );

          answer.classList.add(
            'max-h-[100px]',
            'opacity-100'
          );

        }


        /* Icon */
        if (icon) {

          icon.textContent = '−';

        }

      }

    });

  });

});

jQuery(document).ready(function ($) {

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE SLICK
    |--------------------------------------------------------------------------
    */

    const $slider = $('#testimonial-slider');

    $slider.slick({

        slidesToShow: 4,
        slidesToScroll: 1,

        infinite: false,

        arrows: true,

        prevArrow: $('.testimonial-prev'),
        nextArrow: $('.testimonial-next'),

        dots: false,

        speed: 500,

        adaptiveHeight: false,

        responsive: [

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },

            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1.5,
                    slidesToScroll: 1
                }
            }

        ]

    });


    /*
    |--------------------------------------------------------------------------
    | TAB FILTER
    |--------------------------------------------------------------------------
    */

    $('.testimonial-tab').on('click', function () {

        const category = $(this).data('tab');


        /*
        | Active tab
        */

        $('.testimonial-tab')
            .removeClass('is-active border-[#4d7cff] text-[#4d7cff]')
            .addClass('border-[#222] text-[#222]');

        $(this)
            .addClass('is-active border-[#4d7cff] text-[#4d7cff]')
            .removeClass('border-[#222] text-[#222]');


        /*
        | Stop all videos
        */

        $('.testimonial-video').each(function () {

            this.pause();
            this.currentTime = 0;

            $(this)
                .addClass('hidden');

            $(this)
                .closest('.testimonial-card')
                .find('.testimonial-image')
                .removeClass('hidden');

            $(this)
                .closest('.testimonial-card')
                .find('.testimonial-play')
                .removeClass('hidden');

        });


        /*
        |--------------------------------------------------------------------------
        | FILTER SLICK
        |--------------------------------------------------------------------------
        */

        $slider.slick('slickUnfilter');


        if (category !== 'all') {

            $slider.slick(
                'slickFilter',
                function () {

                    return $(this)
                        .data('category') === category;

                }
            );

        }


        /*
        | Go back to first slide
        */

        $slider.slick('slickGoTo', 0);


        /*
        | Refresh layout
        */

        $slider.slick('setPosition');

    });


    /*
    |--------------------------------------------------------------------------
    | PLAY VIDEO INSIDE CARD
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.testimonial-play', function (e) {

        e.preventDefault();

        const $button = $(this);
        const $card = $button.closest('.testimonial-card');

        const video = $card.find('.testimonial-video')[0];
        const $image = $card.find('.testimonial-image');


        /*
        | Stop all other videos
        */

        $('.testimonial-video').each(function () {

            if (this !== video) {

                this.pause();
                this.currentTime = 0;

                $(this).addClass('hidden');

                $(this)
                    .closest('.testimonial-card')
                    .find('.testimonial-image')
                    .removeClass('hidden');

                $(this)
                    .closest('.testimonial-card')
                    .find('.testimonial-play')
                    .removeClass('hidden');

            }

        });


        /*
        | Start selected video
        */

        $image.addClass('hidden');

        $(video).removeClass('hidden');

        $button.addClass('hidden');

        video.play();

    });


    /*
    |--------------------------------------------------------------------------
    | VIDEO FINISHED
    |--------------------------------------------------------------------------
    */

    $(document).on('ended', '.testimonial-video', function () {

        const $video = $(this);
        const $card = $video.closest('.testimonial-card');

        this.pause();
        this.currentTime = 0;

        $video.addClass('hidden');

        $card
            .find('.testimonial-image')
            .removeClass('hidden');

        $card
            .find('.testimonial-play')
            .removeClass('hidden');

    });


    /*
    |--------------------------------------------------------------------------
    | PAUSE VIDEO WHEN SLIDE CHANGES
    |--------------------------------------------------------------------------
    */

    $slider.on('beforeChange', function () {

        $('.testimonial-video').each(function () {

            this.pause();
            this.currentTime = 0;

            $(this).addClass('hidden');

            $(this)
                .closest('.testimonial-card')
                .find('.testimonial-image')
                .removeClass('hidden');

            $(this)
                .closest('.testimonial-card')
                .find('.testimonial-play')
                .removeClass('hidden');

        });

    });

});

document.addEventListener('DOMContentLoaded', function () {

    const items = document.querySelectorAll('.faq-item');
    const search = document.getElementById('faqSearch');
    const answerText = document.getElementById('answerText');
    const answerBox = document.getElementById('faqAnswer');


    /*
    |--------------------------------------------------------------------------
    | Change active FAQ
    |--------------------------------------------------------------------------
    */

    function activateFAQ(index) {

        const selected = items[index];

        if (!selected) return;


        // Update answer with small fade animation
        answerText.classList.add('opacity-0', 'translate-y-1');

        setTimeout(() => {
            answerText.textContent = selected.dataset.answer;

            answerText.classList.remove('opacity-0', 'translate-y-1');
        }, 120);


        // Update FAQ buttons
        items.forEach((item, itemIndex) => {

            const dot = item.querySelector('.faq-dot');
            const arrow = item.querySelector('.faq-arrow');

            if (itemIndex === index) {

                item.classList.remove('bg-white');
                item.classList.add('bg-amber-50');

                dot.classList.remove('bg-[#b6caff]');
                dot.classList.add('bg-[#6794ff]');

                arrow.classList.add('translate-x-0.5');

            } else {

                item.classList.remove('bg-amber-50');
                item.classList.add('bg-white');

                dot.classList.remove('bg-[#6794ff]');
                dot.classList.add('bg-[#b6caff]');

                arrow.classList.remove('translate-x-0.5');
            }
        });
    }


    /*
    |--------------------------------------------------------------------------
    | FAQ click
    |--------------------------------------------------------------------------
    */

    items.forEach((item) => {

        item.addEventListener('click', function () {

            const index = Number(this.dataset.index);

            activateFAQ(index);

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    search.addEventListener('input', function () {

        const value = this.value.trim().toLowerCase();

        items.forEach((item) => {

            const question = item.dataset.question;

            if (question.includes(value)) {

                item.classList.remove('hidden');

            } else {

                item.classList.add('hidden');

            }

        });

    });

});