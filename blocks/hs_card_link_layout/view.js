
$(document).ready(function() {
	$('.card-link-wrapper').each(function(index) {
		if (index % 2 == 0)
			$(this).addClass('even-card');
		else
			$(this).addClass('odd-card');
	});
});
