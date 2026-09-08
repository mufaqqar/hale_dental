/**
 * Hale Coffee - Tabs, accordions & quote form
 */
jQuery(function ($) {

  /* ===== Packaging partner tabs ===== */
  $('.tab-btn').on('click', function () {
    var tabId = $(this).data('tab');

    $('.tab-btn').removeClass('active');
    $(this).addClass('active');

    $('.tab-content').addClass('hidden').removeClass('active');
    $('#' + tabId).removeClass('hidden').addClass('active');

    /* Refresh sliders hidden inside the tab pane */
    $('#' + tabId).find('.slick-initialized').slick('refresh');
  });

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