jQuery(document).ready( function($){
    var $addform = $('#addtolist');

    $addform.submit(function(e) {
      e.preventDefault();
      var $data = $(this).serializeArray();
      $data.push(
          {name: 'action', value: 'validateProcess'}
      );
      console.log($data);

      $.ajax({
        url: ajax_object.ajaxurl,
        type: 'POST',
        dataType: 'JSON',
        data: $data,
        success: function(data){
            if (data.return) {
                console.log(data.message);
            } else {
                console.log(data.error);
            }
        },
        error: function(XHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
      });
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
