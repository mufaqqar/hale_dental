/**
 * Hale Dental - Detailed online dental consultation form
 * (conditional X-ray/CBCT upload, photo preview, AJAX submit)
 */
jQuery(function ($) {

    var form         = $('#consultation-form');
    var photoInput   = $('#consultation_photos');
    var photoQueue   = $('#consultation_photo_queue');
    var photoList    = $('#consultation_photo_list');
    var photoLabel   = $('#consultation_photo_label');
    var xrayUpload   = $('#consultation_xray_upload');
    var xrayInput    = $('#consultation_xray');
    var xrayLabel    = $('#consultation_xray_label');
    var cbctUpload   = $('#consultation_cbct_upload');
    var cbctInput    = $('#consultation_cbct');
    var cbctLabel    = $('#consultation_cbct_label');
    var msg          = $('#consultation_form_msg');

    if (!form.length) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Photo selection preview (multiple)
    |--------------------------------------------------------------------------
    */

    photoInput.on('change', function () {
        var files = this.files;
        photoList.empty();

        if (!files || !files.length) {
            photoQueue.addClass('hidden');
            photoLabel.text('Upload Photos');
            return;
        }

        $(files).each(function (index, file) {
            if (!file.type.match(/^image\//)) {
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                photoList.append(
                    '<li class="relative overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa]">' +
                        '<img src="' + e.target.result + '" alt="Selected photo" class="h-20 w-full object-cover">' +
                        '<span class="absolute inset-x-0 bottom-0 truncate bg-black/50 px-2 py-0.5 text-[10px] text-white">' + file.name + '</span>' +
                    '</li>'
                );
            };
            reader.readAsDataURL(file);
        });

        photoQueue.removeClass('hidden');
        photoLabel.text(files.length + (files.length === 1 ? ' photo selected' : ' photos selected'));
    });

    /*
    |--------------------------------------------------------------------------
    | Conditional X-ray / OPG upload
    |--------------------------------------------------------------------------
    */

    $('input[name="has_xray"]').on('change', function () {
        if ($(this).val() === 'yes') {
            xrayUpload.removeClass('hidden');
            xrayInput.prop('required', true);
        } else {
            xrayUpload.addClass('hidden');
            xrayInput.prop('required', false).val('');
            xrayLabel.text('Upload X-ray / OPG');
        }
    });

    xrayInput.on('change', function () {
        var files = this.files;
        xrayLabel.text(files && files.length ? files[0].name : 'Upload X-ray / OPG');
    });

    /*
    |--------------------------------------------------------------------------
    | Conditional CBCT upload
    |--------------------------------------------------------------------------
    */

    $('input[name="has_cbct"]').on('change', function () {
        if ($(this).val() === 'yes') {
            cbctUpload.removeClass('hidden');
            cbctInput.prop('required', true);
        } else {
            cbctUpload.addClass('hidden');
            cbctInput.prop('required', false).val('');
            cbctLabel.text('Upload CBCT');
        }
    });

    cbctInput.on('change', function () {
        var files = this.files;
        cbctLabel.text(files && files.length ? files[0].name : 'Upload CBCT');
    });

    /*
    |--------------------------------------------------------------------------
    | Submit via AJAX
    |--------------------------------------------------------------------------
    */

    form.on('submit', function (e) {
        e.preventDefault();

        var photos = photoInput[0].files;

        if (!photos || !photos.length) {
            alert('Please upload at least one dental photograph.');
            return;
        }

        var allFiles = [].slice.call(photos).concat(
            [].slice.call(xrayInput[0].files || []),
            [].slice.call(cbctInput[0].files || [])
        );

        for (var i = 0; i < allFiles.length; i++) {
            if (allFiles[i].size > 5242880) {
                alert('File "' + allFiles[i].name + '" is too large. Maximum size is 5MB.');
                return;
            }
        }

        var fd = new FormData(this);
        fd.append('action', 'hale_consultation_submit');
        fd.append('nonce', window.haleConsultation ? window.haleConsultation.nonce : '');

        var btn = form.find('button[type="submit"]');
        var originalText = btn.text();

        msg.removeClass('hidden').removeClass('text-red-500').addClass('text-primary').text('Sending...');
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: window.haleConsultation ? window.haleConsultation.ajaxUrl : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function (res) {
            if (res && res.success) {
                msg.removeClass('text-primary').addClass('text-green-600').text(res.data);
                form[0].reset();
                photoInput.trigger('change');
                photoQueue.addClass('hidden');
                photoList.empty();
                photoLabel.text('Upload Photos');
                xrayUpload.addClass('hidden');
                cbctUpload.addClass('hidden');
                xrayInput.prop('required', false);
                cbctInput.prop('required', false);
                xrayLabel.text('Upload X-ray / OPG');
                cbctLabel.text('Upload CBCT');
            } else {
                msg.removeClass('text-primary').addClass('text-red-500').text(res && res.data ? res.data : 'Something went wrong. Please try again.');
            }
        }).fail(function () {
            msg.removeClass('text-primary').addClass('text-red-500').text('Network error. Please try again.');
        }).always(function () {
            btn.prop('disabled', false).text(originalText);
        });
    });

});