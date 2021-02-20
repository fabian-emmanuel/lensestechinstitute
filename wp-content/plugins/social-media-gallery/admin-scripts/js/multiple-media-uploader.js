jQuery(function(jQuery) {
    
    var file_frame,
            smgl_gallery = {
        admin_thumb_ul: '',
        init: function() {
            this.admin_thumb_ul = jQuery('#smgl_gallery_thumbs');
            this.admin_thumb_ul.sortable({
                placeholder: '',
				revert: true,
            });
			
            this.admin_thumb_ul.on('click', '.smglgallery_remove', function() {
                if (confirm('Are you sure you want to delete this?')) {
                    jQuery(this).parent().fadeOut(1000, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });
            
            jQuery('#smgl_gallery_upload_button').on('click', function(event) {
                event.preventDefault();
				smgl_gallery.get_thumbnail();
            });
			
			jQuery('#SMGL_delete_all_button').on('click', function() {
                if (confirm('Are you sure you want to delete all the image slides?')) {
                    smgl_gallery.admin_thumb_ul.empty();
                }
                return false;
            });
           
        },
		get_thumbnail: function(cb) {
            cb = cb || function() {
            };
            var data = {
                action: 'smglgallery_get_thumbnail',
            };
            jQuery.post(ajaxurl, data, function(response) {
                smgl_gallery.admin_thumb_ul.append(response);
                cb();
            });
        },
        get_all_thumbnails: function(post_id, included) {
            var data = {
                action: 'smglgallery_get_all_thumbnail',
                post_id: post_id,
                included: included
            };
        }
    };
    smgl_gallery.init();
});