
// TODO string to
xl.to_bytes = function(str) {

	var explode = str.split(' ');

	var value = explode[0];

	var unit = explode[1];

	var multiplier = {
		'MB': 1000000,
		'KB': 1000
	};

	return value * multiplier[unit];
}
