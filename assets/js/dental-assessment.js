/**
 * Hale Dental - Free dental assessment form (photo preview + AJAX submit)
 */
jQuery(function ($) {

    var form      = $('#assessment-form');
    var fileInput = $('#assessment_photos');
    var queue     = $('#assessment_photo_queue');
    var list      = $('#assessment_photo_list');
    var uploadLbl = $('#assessment_upload_label');
    var msg       = $('#assessment_form_msg');

    if (!form.length) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Photo selection preview
    |--------------------------------------------------------------------------
    */

    fileInput.on('change', function () {
        var files = this.files;

        if (!files || !files.length) {
            queue.addClass('hidden');
            list.empty();
            uploadLbl.text('Upload Photos');
            return;
        }

        queue.removeClass('hidden');
        list.empty();

        $(files).each(function (index, file) {
            if (!file.type.match(/^image\//)) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                var count = files.length;
                list.append(
                    '<li class="relative overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa]">' +
                        '<img src="' + e.target.result + '" alt="Selected photo" class="h-20 w-full object-cover">' +
                        '<span class="absolute inset-x-0 bottom-0 truncate bg-black/50 px-2 py-0.5 text-[10px] text-white">' + file.name + '</span>' +
                    '</li>'
                );
                uploadLbl.text(count + (count === 1 ? ' photo selected' : ' photos selected'));
            };
            reader.readAsDataURL(file);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Submit via AJAX
    |--------------------------------------------------------------------------
    */

    form.on('submit', function (e) {
        e.preventDefault();

        var files = fileInput[0].files;

        if (!files || !files.length) {
            alert('Please upload at least one dental photograph.');
            return;
        }

        for (var i = 0; i < files.length; i++) {
            if (files[i].size > 5242880) {
                alert('File "' + files[i].name + '" is too large. Maximum size is 5MB.');
                return;
            }
        }

        var fd = new FormData(this);
        fd.append('action', 'hale_assessment_submit');
        fd.append('nonce', window.haleAssessment ? window.haleAssessment.nonce : '');

        var btn = form.find('button[type="submit"]');
        var originalText = btn.text();

        msg.removeClass('hidden').removeClass('text-red-500').addClass('text-primary').text('Sending...');
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: window.haleAssessment ? window.haleAssessment.ajaxUrl : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function (res) {
            if (res && res.success) {
                msg.removeClass('text-primary').addClass('text-green-600').text(res.data);
                form[0].reset();
                fileInput.trigger('change');
                queue.addClass('hidden');
                list.empty();
                uploadLbl.text('Upload Photos');
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