/**
 * Hale Dental - Quote popup (open/close, file upload, AJAX submit)
 */
jQuery(function ($) {

    var popup     = $('#quotePopup');
    var openBtn   = $('#openQuotePopup');
    var closeBtn  = $('#closeQuote_Popup');
    var uploadBtn = $('#uploadBtn');
    var fileInput = $('#fileInput');
    var form      = $('#quote-form');

    if (!popup.length || !form.length) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Open / close popup
    |--------------------------------------------------------------------------
    */

    function openPopup() {
        popup.removeClass('translate-x-full opacity-0 pointer-events-none');
        popup.addClass('translate-x-0 opacity-100 pointer-events-auto');
    }

    function closePopup() {
        popup.addClass('translate-x-full opacity-0 pointer-events-none');
        popup.removeClass('translate-x-0 opacity-100 pointer-events-auto');
    }

    openBtn.on('click', openPopup);

    closeBtn.on('click', closePopup);

    popup.on('click', function (e) {
        if (e.target === popup[0]) {
            closePopup();
        }
    });

    $(document).on('keyup', function (e) {
        if (e.key === 'Escape') {
            closePopup();
        }
    });


    /*
    |--------------------------------------------------------------------------
    | File upload
    |--------------------------------------------------------------------------
    */

    uploadBtn.on('click', function () {
        fileInput.trigger('click');
    });

    fileInput.on('change', function () {
        var name = this.files && this.files.length ? this.files[0].name : '';
        uploadBtn.find('span').text(name || uploadBtn.data('label') || 'Attached File');
    });

    if (uploadBtn.find('span').length === 0) {
        uploadBtn.wrapInner('<span>Attached File</span>');
        uploadBtn.data('label', 'Attached File');
    }


    /*
    |--------------------------------------------------------------------------
    | Submit via AJAX
    |--------------------------------------------------------------------------
    */

    form.on('submit', function (e) {
        e.preventDefault();

        var file = fileInput[0].files[0];

        if (file && file.size > 5242880) {
            alert('File is too large. Maximum size is 5MB.');
            return;
        }

        var fd = new FormData(this);

        fd.append('action', 'hale_contact_submit');
        fd.append('nonce', window.haleQuote ? window.haleQuote.nonce : '');

        var btn = $('#quote-submit');
        var originalText = btn.text();

        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: window.haleQuote ? window.haleQuote.ajaxUrl : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function (res) {
            if (res && res.success) {
                form[0].reset();
                uploadBtn.find('span').text('Attached File');
                closePopup();
            } else {
                alert(res && res.data ? res.data : 'Something went wrong. Please try again.');
            }
        }).fail(function () {
            alert('Network error. Please try again.');
        }).always(function () {
            btn.prop('disabled', false).text(originalText);
        });
    });

});