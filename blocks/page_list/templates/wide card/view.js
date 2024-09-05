
$(document).ready(function() {
	$('.top-row .card-wrapper-wide').each(function(index) {
		if (index % 2 == 0)
			$(this).addClass('even-card');
		else
		{
			$(this).addClass('odd-card');
			$('.card-image', $(this)).parent().addClass('col-sm-push-6');
			$('.card-content', $(this)).parent().addClass('col-sm-pull-6');
		}
	});
});
