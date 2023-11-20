<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap-custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap-custom-nav.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap.min.css">
	<?php echo $html->css($view->getStylesheet('main.less'))?>
	<?php Loader::element('header_required', array('pageTitle' => isset($pageTitle) ? $pageTitle : ''));?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?php echo $view->getThemePath()?>/js/jquery.min.js"></script>
	<script src="<?php echo $view->getThemePath()?>/js/bootstrap.min.js"></script> 
	<script src="<?php echo $view->getThemePath()?>/js/hovernav.js"></script>
    <script src="<?php echo $view->getThemePath()?>/js/bootstrap.bundle.min.js"></script>
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
		
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
    </script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TJ3W69H');</script>
<!-- End Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-33350492-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-33350492-1');
</script>

<!-- Google Analytics 
<script>(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-33350492-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJ3W69H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="<?php echo $c->getPageWrapperClass()?>">
<div class="container">
