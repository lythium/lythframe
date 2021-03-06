jQuery(document).ready( function($){
    var $addToForm = $('#addtolist'),
        $updateForm = $('#update'),
        $success = $('#lythframe_success p'),
        $error = $('#lythframe_error p'),
        $closeMessage = $('.alert .icon-cancel-circled'),
        $formlist = $('#formlist');

    // var $count = 0;

    $addToForm.submit(function(e) {
        btnAddLoade(false);
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
                        addtolist(data.datapost);
                        $('#addtolist')[0].reset();
                        $('#upload_image').attr('src', '');
                        $('.image_group').css('display', 'none');
                        $('#image_url_group').css('display', 'block');
                    } else {
                        console.log(data.error);
                        $error.html(data.error);
                        $error.parent().css('display', 'block');
                    }
                    btnAddLoade(true);
                },
                error: function(XHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    btnAddLoade(true);
                }
            });
        }, 2000);
    });

    $formlist.submit(function(e) {
        // $('#add_btn').prop('disabled', true);
        // $('#add_btn i').css('display', 'block');
        // $('#add_btn .icon_text').css('display', 'none');
        e.preventDefault();
        $success.parent().css('display', 'none');
        $error.parent().css('display', 'none');
        var $actionUrl = $(this).attr('action');
        console.log($actionUrl);
        var $data = $(this).serializeArray();
        $data.push(
            {name: 'action', value: 'addProcess'}
        );
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
                        $('#formlist')[0].reset();
                        $('#formlist div div[id^=formlist_item]').remove();
                        $('#add_list tr[id^=add_list_item_]').remove();
                        console.log(data.datapost);
                    } else {
                        console.log(data.error);
                        $error.html(data.error);
                        $error.parent().css('display', 'block');
                    }
                },
                error: function(XHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }, 2000);
    });

    $updateForm.submit(function(e) {
        e.preventDefault();
        btnUpdateLoade(false);
        $success.parent().css('display', 'none');
        $error.parent().css('display', 'none');
        var $data = $(this).serializeArray();
        $data.push(
            {name: 'action', value: 'validateProcess'}
        );

        setTimeout(function(){
            $.ajax({
                url: ajax_object.ajaxurl,
                type: 'POST',
                dataType: 'JSON',
                data: $data,
                success: function(data){
                    if (data.return) {
                        console.log('data valide, go to update');
                        $data.push(
                            {name: 'action', value: 'updateProcess'}
                        );
                        $.ajax({
                            url: ajax_object.ajaxurl,
                            type: 'POST',
                            dataType: 'JSON',
                            data: $data,
                            success: function(data){
                                if (data.return) {
                                    console.log('data updated !');
                                    $success.html(data.message);
                                    $success.parent().css('display', 'block');
                                    btnUpdateLoade(true);
                                } else {
                                    console.log(data.error);
                                    $error.html(data.error);
                                    $error.parent().css('display', 'block');
                                    btnUpdateLoade(true);
                                }
                            },
                            error: function(XHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                                btnUpdateLoade(true);
                            }
                        });
                    } else {
                        console.log(data.error);
                        $error.html(data.error);
                        $error.parent().css('display', 'block');
                        btnUpdateLoade(true);
                    }
                },
                error: function(XHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    btnUpdateLoade(true);
                }
            });
        }, 1000);
    });


    function addtolist(data) {
        var $formListContent = $('#itemlist_content');
        var $list = $('#add_list');
        var $count = $("div[id^=formlist_item]").length;
        if ($count == null) {
            $count = 0;
        }
        // add in form
        $('<div id="formlist_item_'+$count+'" class="items_form">'+
            '<input type="hidden" name="save_unit_name['+$count+']" value="'+data.unit_name+'">'+
            '<input type="hidden" name="save_image_url['+$count+']" value="'+data.image_url+'">'+
            '<input type="hidden" name="save_url_post['+$count+']" value="'+data.url_post+'">'+
            '<input type="hidden" name="save_spell_name_en['+$count+']" value="'+data.spell_name_en+'">'+
            '<input type="hidden" name="save_spell_name_fr['+$count+']" value="'+data.spell_name_fr+'">'+
            '<input type="hidden" name="save_hits['+$count+']" value="'+data.hits+'">'+
            '<input type="hidden" name="save_spell_frame['+$count+']" value="'+data.spell_frame+'">'+
            '<input type="hidden" name="save_frame_delay_hit['+$count+']" value="'+data.frame_delay_hit+'">'+
            '<input type="hidden" name="save_frame_pattern['+$count+']" value="'+data.frame_pattern+'">'+
        '</div>').appendTo($formListContent);

        // add in list display
        $('<tr id="add_list_item_'+$count+'">'+
            '<th>'+
                '<span class="save_unit_name">'+data.unit_name+'</span>'+
                '<br>'+
                '<span class="save_url_post">'+data.url_post+'</span>'+
            '</th>'+
            '<th>'+
                '<img  src="'+data.image_url+'" alt="" class="save_upload_image">'+
            '</th>'+
            '<th>'+
                '<span class="save_spell_name_en">'+data.spell_name_en+'</span>'+
                '<br>'+
                '<span class="save_spell_name_fr">'+data.spell_name_fr+'</span>'+
            '</th>'+
            '<th>'+
                '<span class="save_hits">'+data.hits+'</span>'+
            '</th>'+
            '<th>'+
                '<span class="save_spell_frame">'+data.spell_frame+'</span>'+
            '</th>'+
            '<th>'+
                '<span class="save_frame_delay_hit">'+data.frame_delay_hit+'</span>'+
            '</th>'+
            '<th>'+
                '<span class="save_frame_pattern">'+data.frame_pattern+'</span>'+
            '</th>'+
        '</tr>').appendTo($list);
    };

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

    function btnAddLoade(mode) {
        switch (mode) {
            case true:
                $('#add_btn i').css('display', 'none');
                $('#add_btn .icon_text').css('display', 'block');
                $('#add_btn').prop('disabled', false);
                break;
            case false:
                $('#add_btn').prop('disabled', true);
                $('#add_btn i').css('display', 'block');
                $('#add_btn .icon_text').css('display', 'none');
                break;
        }
    }

    function btnUpdateLoade(mode) {
        switch (mode) {
            case true:
                $('#update_btn i').css('display', 'none');
                $('#update_btn .icon_text').css('display', 'block');
                $('#update_btn').prop('disabled', false);
                break;
            case false:
                $('#update_btn').prop('disabled', true);
                $('#update_btn i').css('display', 'block');
                $('#update_btn .icon_text').css('display', 'none');
                break;
        }
    }
});
