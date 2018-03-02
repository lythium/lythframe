jQuery(document).ready( function($){
    var $addform = $('#addtolist'),
        $success = $('#lythframe_success p'),
        $error = $('#lythframe_error p'),
        $closeMessage = $('.alert .icon-cancel-circled');

    $addform.submit(function(e) {
        $('#add_btn').prop('disabled', true);
        $('#add_btn i').css('display', 'block');
        $('#add_btn .icon_text').css('display', 'none');
        e.preventDefault();
        $success.parent().css('display', 'none');
        $error.parent().css('display', 'none');
        var $data = $(this).serializeArray();
        $data.push(
            {name: 'action', value: 'validateProcess'}
        );
        console.log($data);

        setTimeout(function(){
            $.ajax({
                url: ajax_object.ajaxurl,
                type: 'POST',
                dataType: 'JSON',
                data: $data,
                success: function(data){
                    if (data.return) {
                        console.log(data.message);
                        $success.html(data.message);
                        $success.parent().css('display', 'block');

                    } else {
                        console.log(data.error);
                        $error.html(data.error);
                        $error.parent().css('display', 'block');
                    }
                    $('#add_btn i').css('display', 'none');
                    $('#add_btn .icon_text').css('display', 'block');
                    $('#add_btn').prop('disabled', false);
                },
                error: function(XHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $('#add_btn i').css('display', 'none');
                    $('#add_btn .icon_text').css('display', 'block');
                    $('#add_btn').prop('disabled', false);
                }
            });
        }, 2000);
    });

    $closeMessage.on('click', function(e){
        e.preventDefault();
        $(this).parent().css('display', 'none');
        $(this).parent().children('p').html('');
    });

    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open()
        .on('select', function(e){

            var $upload_image = image.state().get('selection').first();

            console.log($upload_image);
            var $image_url = $upload_image.toJSON().url;

            $('#image_url').val($image_url);
            $('#upload_image').attr('src', $image_url);
            $('.image_group').css('display', 'flex');
            $('#image_url_group').css('display', 'none');
        });
    });
    $('#close_upload').click(function(e) {
        e.preventDefault();
        $('#image_url').val('');
        $('#upload_image').attr('src', '');
        $('.image_group').css('display', 'none');
        $('#image_url_group').css('display', 'block');
    });
});
