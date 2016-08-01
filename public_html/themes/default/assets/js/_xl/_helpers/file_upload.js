
xl.file_upload_xhr = function($el) {
	var myXhr = $.ajaxSettings.xhr();
	if(myXhr.upload) { // Check if upload property exists
		myXhr.upload.addEventListener('progress', function(event) {
			if(event.lengthComputable) {
				var per = Math.round(( event.loaded / event.total ) * 100) + '%';
				$el.css('width', per);
				$el.html(per);
			}
		}, false); // For handling the progress of the upload
	}
	return myXhr;
}
