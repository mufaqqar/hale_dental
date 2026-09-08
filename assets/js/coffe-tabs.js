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
          "font-semibold",
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
        "font-semibold",
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
