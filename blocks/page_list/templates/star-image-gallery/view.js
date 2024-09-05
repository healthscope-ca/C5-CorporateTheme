
$(document).ready(function() {
	$('.media-centre-wrapper').each(function(index) {
		if (index % 2 == 0)
			$(this).addClass('even-card');
		else
			$(this).addClass('odd-card');
	});
});
