xl.format_amount = function(amount) {
	amount = parseFloat(amount);
	return amount.toFixed(2);
}

xl.round_amount = function(amount) {
	return xc.format_amount( Math.round( parseFloat(amount) ) );
}
