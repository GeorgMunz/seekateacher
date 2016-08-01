/* --------------------------------------------------------------
 * IMAGE PREVIEW
 * ------------------------------------------------------------ */

/**
 * image preview
 */
/*
<div class="img-preview" data-img-preview="#upload_1">
	<span class="glyphicon glyphicon-plus"></span>
</div>
<input type="file" id="upload_1" class="hide" name="upload_1">
 */
$(function() {

	function init() {
		$('[data-img-preview]').each(function() {
			var $preview = $(this),
				$input = $( $preview.data('img-preview') ),
				allowed_types = $preview.data('img-allowed'),
				allowed_size = $preview.data('img-size'),
				allowed_width = $preview.data('img-width'),
				allowed_height = $preview.data('img-height');

			// Attaching on change
			$input.on('change', function() {
				var file = this.files[0];

				if ( ! file) return false;

				// check file size
				if (file.size > xl.to_bytes(allowed_size)) {
					bootbox.alert('Only less than 1MB');
					return false;
				}

				// only jpg
				if ( ! xl.is_jpg(file)) {
	    			bootbox.alert('Only JPG are allowed');
					return false;
	    		}

	    		// check width and height
	    		xl.image_from_file(file, function(img) {

	    			if (img.width < allowed_width) {
	    				bootbox.alert('Min width should be ' + allowed_width + 'px');
	    				return false;
	    			}

	    			if (img.height < allowed_height) {
	    				bootbox.alert('Min height should be ' + allowed_height + 'px');
	    				return false;
	    			}

		    		// success then read
	    			$preview.css('background-image', 'url("'+img.src+'")' );
	    		});

			});
			// Attaching on click
			$preview.on('click', function(){
				$input.trigger('click');
			});
		});
	}

	// let's go
	init();

	xl.image_preview_init = init;
});
