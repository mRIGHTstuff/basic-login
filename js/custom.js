$(document).ready(function() {
	alert(1);

	$('form').submit(function(e){
		alert(1);
		e.preventDefault();
	});

});
