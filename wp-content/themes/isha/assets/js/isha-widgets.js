jQuery(document).ready(function(jQuery) {

    var isha_document = jQuery(document);

    isha_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = jQuery(this);
        var media_title = jQuery(this).data('title');
        var media_button = jQuery(this).data('button');
        var media_input_val = jQuery(this).prev();
        var media_image_url_value = jQuery(this).prev().prev().children('img');
        var media_image_url = jQuery(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                LATESTVALUE(media_image_upload.closest("p"));
            }
        });
    });

    // Runs when the image button is clicked.
    jQuery('body').on('click','.media-image-remove', function(e){
        jQuery(this).siblings('.img-preview-wrap').hide();
        jQuery(this).prev().prev().val('');
    });

    var LATESTVALUE = function (wrapObject) {
        wrapObject.find('[name]').each(function(){
            jQuery(this).trigger('change');
        });
    };

    jQuery('.color-picker-hex').addClass('color-picker');
    jQuery(".color-picker").attr('data-alpha','true');

});


jQuery(document).ready(function(jQuery) {

    var count = 0;
    // Features section
    jQuery("body").on('click','.isha-add-features', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-features');
        count = additional.find('.isha-sec').length;

        //Json response
        jQuery.ajax({
            type      : "GET",
            url       : ajaxurl,
            data      : {
                action: 'isha_wp_pages_plucker',
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                var options = '<option disabled>Select pages</option>';

                jQuery.each(data, function( index, value ) {
                    var option = '<option value="'+index+'">'+value+'</option>';
                    options += option;
                });


                additional.append(
                    '<div class="isha-sec"><div class="sub-option section widget-upload">'+
                    '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count+'-page_ids">Select Page</label>'+
                    '<select class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count+'-page_ids"'+
                    'name="widget-'+liver+'['+instance+'][repeaters]['+count+'][page_ids]">'+ options + '</select>' +
                    '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count+'-icon">Use font awesome icon:  <a href="https://fontawesome.com/v4.7.0/icons/"  target="_blank">See more here</a></label>'+
                    '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count+'-icon"'+
                    'name="widget-'+liver+'['+instance+'][repeaters]['+count+'][icon]">'+
                    '<a class="isha-remove delete">Remove Section</a></div></div>' );
            }
        });
    });

    // What we do section
    var count1 = 0;
    jQuery("body").on('click','.isha-add-why-choose', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-why-choose');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-why-choose');
        count1 = additional.find('.isha-sec-why-choose').length;         
        additional.append(
        '<div class="isha-sec-why-choose isha-sec"><div class="sub-option section widget-upload">'+
        '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-number">NUmber</label>'+
        '<input type="number" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-number"'+
        'name="widget-'+liver+'['+instance+'][repeaters]['+count1+'][number]">'+
        '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-symbol">Symbol</label>'+
        '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-symbol"'+
        'name="widget-'+liver+'['+instance+'][repeaters]['+count1+'][symbol]">'+
        '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-text">Text</label>'+
        '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count1+'-text"'+
        'name="widget-'+liver+'['+instance+'][repeaters]['+count1+'][text]">'+
        '<a class="isha-remove delete">Remove Section</a></div></div>' );
    });  


    // Counter section
    var count2 = 0;
    jQuery("body").on('click','.isha-add-counter', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-counter');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-counter');
        count2 = additional.find('.isha-sec-counter').length;

        additional.append(
            '<div class="isha-sec-counter isha-sec"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-icon">Use font awesome icon:  <a href="https://fontawesome.com/v4.7.0/icons/"  target="_blank">See more here</a></label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-icon"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count2+'][icon]">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-number">Number</label>'+
            '<input type="number" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-number"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count2+'][number]">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-text">Text</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count2+'-text"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count2+'][text]">'+
            '<a class="isha-remove delete">Remove Section</a></div></div>' );
        }); 


    //Testimonials section
    var count3 = 0;
    jQuery("body").on('click','.isha-add-testimonials', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-testimonials');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-testimonials');
        count3 = additional.find('.isha-sec-testimonials').length;

        //Json response
        jQuery.ajax({
            type      : "GET",
            url       : ajaxurl,
            data      : {
                action: 'isha_wp_pages_plucker',
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                var options = '<option disabled>Select pages</option>';

                jQuery.each(data, function( index, value ) {
                    var option = '<option value="'+index+'">'+value+'</option>';
                    options += option;
                });

                additional.append(
                    '<div class="isha-sec-testimonials"><div class="sub-option section widget-upload">'+
                    '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count3+'-page_ids">Select Page</label>'+
                    '<select class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count3+'-page_ids"'+
                    'name="widget-'+liver+'['+instance+'][repeaters]['+count3+'][page_ids]">'+ options + '</select>' +
                    '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count3+'-position">Position</label>'+
                    '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count3+'-position"'+
                    'name="widget-'+liver+'['+instance+'][repeaters]['+count3+'][position]">'+
                    '<a class="isha-remove delete">Remove Section</a></div></div>' );
            }
        });
    });


    //Logo section
    var count4 = 0;
    jQuery("body").on('click','.isha-add-logo', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-logo');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-logo');
        count4 = additional.find('.isha-sec-logo').length;

        additional.append(
            '<div class="isha-sec-logo" id="logo'+count4+'"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count4+'-image_url">Image Upload</label>'+
            '<img class="custom_media_image_logo" src="" id="custom_media_image_logo'+count4+'">'+
            '<input type="hidden" class="widefat custom_media_url_logo"'+ 'name="widget-'+liver+'['+instance+'][repeaters]['+count4+'][image_url]" id="custom_media_url_logo'+count4+'">'+
            '<input type="button" value="Upload Image" class="button custom_media_upload_logo" id="custom_image_upload-'+count4+'">'+
            '<a class="isha-remove delete">Remove Section</a></div></div>' );
        
    });

     // Counter section
    var count5 = 0;
    jQuery("body").on('click','.isha-add-footer-social', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional-footer-social');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-footer-social');
        count5 = additional.find('.isha-sec-footer-social').length;

        additional.append(
            '<div class="isha-sec-footer-social isha-sec"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count5+'-social_icon">Social Icon(Use font awesome icon:  <a href="https://fontawesome.com/v4.7.0/icons/"  target="_blank">See more here</a>)</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count5+'-social_icon"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count5+'][social_icon]">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count5+'-social_url">Social Url</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count5+'-social_url"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count5+'][social_url]">'+
            '<a class="isha-remove delete">Remove Section</a></div></div>' );
        }); 

     var count6 = 0;
    // Pricing section
    jQuery("body").on('click','.isha-add-pricing', function(e) {
        e.preventDefault();
        var additional = jQuery(this).parent().parent().find('.isha-additional');
        var container = jQuery(this).parent().parent().parent().parent();

        var container_class = container.attr('id');

        var arr = container_class.split('-');

        var val=  arr[1].split('_');

        val.shift();

        var liver=  val.join('_')

        var container_class_array = container_class.split(liver+"-");
        var instance = container_class_array[1];
        var add = jQuery(this).parent().parent().find('.isha-add-features');
        count6 = additional.find('.isha-sec').length;

        additional.append(
            '<div class="isha-sec"><div class="sub-option section widget-upload">'+
            '<label for="widget-'+liver+'-'+instance+'-repeaters-'+count6+'-feature">Feature</label>'+
            '<input type="text" class="widefat" id="widget-'+liver+'-'+instance+'-repeaters-'+count6+'-feature"'+
            'name="widget-'+liver+'['+instance+'][repeaters]['+count6+'][feature]">'+
            '<a class="isha-remove delete">Remove Section</a></div></div>' );
    });

    jQuery(".isha-remove").live('click', function() {
        jQuery(this).parent().parent().remove();
        jQuery('input[name="savewidget"]').removeAttr('disabled');
    });

});


// Widget Media Uploader for counter
jQuery(document).ready( function(){
function media_upload( button_class) {
var _custom_media = true,
_orig_send_attachment = wp.media.editor.send.attachment;
jQuery('body').on('click',button_class, function(e) {

    var button_id ='#'+jQuery(this).attr('id');
     
    var self = jQuery(button_id);
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = jQuery(button_id);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
        if ( _custom_media  ) {
            jQuery(button_id).parent().find('input[type="hidden"]').val(attachment.url); 
           jQuery(button_id).parent().find('img').attr('src',attachment.url);
           jQuery('.isha-remove-counter').show();
        } else {
            return _orig_send_attachment.apply( button_id, [props, attachment] );
        }
        jQuery('input[name="savewidget"]').removeAttr('disabled');
    }
    wp.media.editor.open(button);
    return true;
});
}
media_upload( '.custom_media_upload');
jQuery('body').on('click','.isha-remove-counter',function(e){
    jQuery(this).parent().find('img').attr('src','');
    jQuery(this).parent().find('input[type="hidden"]').val(''); 
    jQuery(this).hide();
    jQuery('input[name="savewidget"]').removeAttr('disabled');
});
});