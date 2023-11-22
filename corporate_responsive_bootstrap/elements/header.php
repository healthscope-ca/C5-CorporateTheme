<?php defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header_top.php');
?>

<header>
	<div class="row">
		<nav id="top" class="navbar navbar-default">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">All Sites Menu</a>
			</div>

			<div class="collapse navbar-collapse" id="top-navbar-collapse">
			  <ul class="nav navbar-nav">
				<li><a href="#">Healthscope</a></li>
				<li><a href="http://www.healthscopeHospitals.com.au/">Hospitals</a></li>
				<li><a href="http://www.communityprograms.com.au/">Independence Services</a></li>
			  </ul>
			</div>
		</nav>
	</div>
<style type="text/css">
	.vcenter {
		display: inline-block;
		vertical-align: middle;
		float: none;
	}
</style>
	<div class="row" style="background-color: #ffffff;">
		<div class="col-xs-10 vcenter">
			<a href="/"><img class="logos" src="<?php echo $view->getThemePath()?>/images/logo.svg" /></a>
		</div><!-- this comment must wrap to next div so that vertical alignment works properly
		--><div class="col-xs-2 vcenter">
			<a title="Search this site" class="pull-right" href="/search"><img class="logos search-icon" src="<?php echo $view->getThemePath()?>/images/magnifying-glass-2-32.png" /></a>
		</div>
	</div>		
		
	<div class="row">
		<?php
			$a = new GlobalArea('Header Navigation');
			$a->display();
		?>
	</div>

</header>