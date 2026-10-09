/**
 * Hale Dental - Country-code dropdown + generic lead form AJAX submit
 * Used by the hero banners and the contact page.
 */
jQuery(function ($) {

    /*
    |--------------------------------------------------------------------------
    | Country-code dropdown
    |--------------------------------------------------------------------------
    */

    function closeAllCountryLists() {
        $('.hale-country-list').addClass('hidden');
        $('.hale-country-toggle').attr('aria-expanded', 'false');
    }

    $(document).on('click', '.hale-country-toggle', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var toggle = $(this);
        var list = toggle.closest('.hale-country').find('.hale-country-list');
        var willOpen = list.hasClass('hidden');

        closeAllCountryLists();

        if (willOpen) {
            list.removeClass('hidden');
            toggle.attr('aria-expanded', 'true');
        }
    });

    $(document).on('click', '.hale-country-list li', function (e) {
        e.stopPropagation();

        var item = $(this);
        var wrap = item.closest('.hale-country');

        wrap.find('.hale-country-flag').text(item.data('flag'));
        wrap.find('.hale-country-dial').text(item.data('dial'));
        wrap.find('input[name="country_code"]').val(item.data('dial'));

        closeAllCountryLists();
    });

    $(document).on('click', function () {
        closeAllCountryLists();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            closeAllCountryLists();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Footer newsletter
    |--------------------------------------------------------------------------
    */

    $('.hale-newsletter-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);

        if (!this.checkValidity()) {
            if (this.reportValidity) {
                this.reportValidity();
            }
            return;
        }

        var msg = form.find('.hale-form-msg');
        var btn = form.find('button[type="submit"]');
        var originalText = btn.text();

        var fd = new FormData(this);
        fd.append('action', 'hale_newsletter_submit');
        fd.append('nonce', window.haleLead ? window.haleLead.nonce : '');

        msg.removeClass('hidden text-green-500').addClass('text-red-500').text('Subscribing...');
        btn.prop('disabled', true).text('Subscribing...');

        $.ajax({
            url: window.haleLead ? window.haleLead.ajaxUrl : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function (res) {
            if (res && res.success) {
                msg.removeClass('text-red-500').addClass('text-green-500').text(res.data);
                form[0].reset();
            } else {
                msg.removeClass('text-green-500').addClass('text-red-500').text(res && res.data ? res.data : 'Something went wrong. Please try again.');
            }
        }).fail(function () {
            msg.removeClass('text-green-500').addClass('text-red-500').text('Network error. Please try again.');
        }).always(function () {
            btn.prop('disabled', false).text(originalText);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Submit via AJAX
    |--------------------------------------------------------------------------
    */
    $('.hale-lead-form').each(function () {
        var form = $(this);
        var msg = form.find('.hale-form-msg');
        var btn = form.find('button[type="submit"]');

        form.on('submit', function (e) {
            e.preventDefault();

            if (typeof this.checkValidity === 'function' && !this.checkValidity()) {
                if (this.reportValidity) {
                    this.reportValidity();
                }
                return;
            }

            var fd = new FormData(this);
            fd.append('action', 'hale_lead_submit');
            fd.append('nonce', window.haleLead ? window.haleLead.nonce : '');

            var originalText = btn.text();

            msg.removeClass('hidden text-green-500').addClass('text-red-500').text('Sending...');
            btn.prop('disabled', true).text('Sending...');

            $.ajax({
                url: window.haleLead ? window.haleLead.ajaxUrl : '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json'
            }).done(function (res) {
                if (res && res.success) {
                    msg.removeClass('text-red-500').addClass('text-green-500').text(res.data);
                    form[0].reset();
                    resetCountryDropdown(form);
                } else {
                    msg.removeClass('text-green-500').addClass('text-red-500').text(res && res.data ? res.data : 'Something went wrong. Please try again.');
                }
            }).fail(function () {
                msg.removeClass('text-green-500').addClass('text-red-500').text('Network error. Please try again.');
            }).always(function () {
                btn.prop('disabled', false).text(originalText);
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    function resetCountryDropdown(scope) {
        scope.find('.hale-country').each(function () {
            var wrap = $(this);
            var flag = wrap.data('default-flag');
            var dial = wrap.data('default-dial');

            wrap.find('.hale-country-flag').text(flag);
            wrap.find('.hale-country-dial').text(dial);
            wrap.find('input[name="country_code"]').val(dial);
            wrap.find('.hale-country-list').addClass('hidden');
            wrap.find('.hale-country-toggle').attr('aria-expanded', 'false');
        });
    }

});
