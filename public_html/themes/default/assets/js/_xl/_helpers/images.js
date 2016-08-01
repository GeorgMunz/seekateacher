/* --------------------------------------------------------------
 * IMAGE VALIDATIONS
 * ------------------------------------------------------------ */

// verify file type is jpg or not
xl.is_jpg_fr = function(file, callback) {

	// Check file type
	xl.file_type(file, function(mime_type) {
		var valid = false;

		if ( mime_type == 'image/jpg' || mime_type == 'image/jpeg' ) {
			valid = true;
		}

		// calling the callback
		callback(valid);
	});

};


xl.is_jpg = function(file) {
	var valid = false,
		mime_type = file.type;

	if ( mime_type == 'image/jpg' || mime_type == 'image/jpeg' ) {
		valid = true;
	}

	return valid;
};

xl.image_from_file = function(file, callback) {
	var url = URL.createObjectURL(file);
	var img = new Image;

	img.onload = function() {
	    callback(img);
	};

	img.src = url;
};
