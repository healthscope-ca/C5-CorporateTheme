
$(document).ready(function() {
	$('.top-row .card-wrapper').each(function(index) {
		if (index % 2 == 0)
			$(this).addClass('even-card');
		else
			$(this).addClass('odd-card');
	});
});
