// JavaScript Document
$(document).ready(function() 
{
	/*
	"Hovernav" navbar dropdown on hover
	Uses jQuery Media Query - see http://www.sitepoint.com/javascript-media-queries/
	*/
	var mq = window.matchMedia('(min-width: 768px)');
	if (mq.matches) 
	{
		$('ul.navbar-nav > li').addClass('hovernav');
	} 
	else 
	{
		$('ul.navbar-nav > li').removeClass('hovernav');
	}
	/*
	The addClass/removeClass also needs to be triggered
	on page resize <=> 768px
	*/
	if (matchMedia) 
	{
		var mq = window.matchMedia('(min-width: 768px)');
		mq.addListener(WidthChange);
		WidthChange(mq);
	}

	function WidthChange(mq) 
	{
		if (mq.matches) 
		{
			$('ul.navbar-nav > li').addClass('hovernav');
			// Restore "clickable parent links" in navbar
			$('.hovernav a').click(function () 
			{
				//  Bruce Anwyl: 12 Jan 2016
				//  Added the following test to avoid navigation of current window to the href 
				//  in addition to navigating to the href in a new window when target="_blank"
				if (this.target && (this.target == '_self' || this.target == ''))
				{
					window.location = this.href;
				}
			});
		} 
		else 
		{
			$('ul.navbar-nav > li').removeClass('hovernav');
		}
	}
	// Restore "clickable parent links" in navbar
	$('.hovernav a').click(function () 
	{
		//  Bruce Anwyl: 12 Jan 2016
		//  Added the following test to avoid navigation of current window to the href 
		//  in addition to navigating to the href in a new window when target="_blank"
		if (this.target && (this.target == '_self' || this.target == ''))
		{
			window.location = this.href;
		}
	});
});