<?php defined('C5_EXECUTE') or die("Access Denied.");

$footerSiteTitle = new GlobalArea('Footer Site Title');
$footerSocial = new GlobalArea('Footer Social');
$footerSiteTitleBlocks = $footerSiteTitle->getTotalBlocksInArea();
$footerSocialBlocks = $footerSocial->getTotalBlocksInArea();
$displayFirstSection = $footerSiteTitleBlocks > 0 || $footerSocialBlocks > 0 || $c->isEditMode();

?>
<footer>
	<div class="row our-assistance block-header">
		<div class="col-md-12">
			<h1>Our Assistance</h1>
		</div>
	</div>
	<div class="row our-assistance">
        <?php
        $a = new GlobalArea('Assistance');
        $a->display();
        ?>
    </div>
	<div class="row">
		<div class="col-md-12 footer-content">
			<?php
			$a = new GlobalArea('Contact Details');
			$a->display();
			?>
			</div>
	</div>
	<div class="row">
		<div class="col-md-12 footer-content">
			<?php
			$a = new GlobalArea('Social Links');
			$a->display();
			?>
			<p style="font-size:13px";> &copy; <?php echo date("Y"); ?> Healthscope | All rights reserved  | <a href="https://healthscope.com.au/privacy-summary">Privacy Policy</a></p>
		</div>
	</div>
</footer>
<footer id="concrete5-brand">
	<div class="row footer-content">
		<div class="col-sm-12">
			<!--<span><?php echo t('Built with <a href="http://www.concrete5.org" class="concrete5">concrete5</a> CMS.')?></span>--->
			<span class="pull-right">
				<!--<?php echo Core::make('helper/navigation')->getLogInOutLink()?>-->
			</span>
		</div>
	</div>
</footer>
<?php $this->inc('elements/footer_bottom.php');?>
