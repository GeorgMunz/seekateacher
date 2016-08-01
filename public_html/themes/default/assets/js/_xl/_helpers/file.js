
xl.file_ext = function(filename) {
	return filename.substr(filename.lastIndexOf('.') + 1);
};

// Read as Data URL
xl.read_data_url = function(file, callback) {
	var reader = new FileReader();
    reader.onload = function (event) {
    	callback(event.target.result);
    }
    reader.readAsDataURL(file);
};

// Check the File Type
xl.file_type = function(file, callback) {
	xl.read_data_url(file, function(data_url) {
		var file_type = data_url.split(",")[0].split(":")[1].split(";")[0];
		callback(file_type);
	});
};