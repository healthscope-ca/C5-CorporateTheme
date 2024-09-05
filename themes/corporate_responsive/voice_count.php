<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main>
	<div class="row">
			<?php
			$a = new Area('Full Width');
			$a->display($c);
			?>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1-1">
			<?php
			$a = new Area('Main');
			$a->setAreaGridMaximumColumns(12);
			$a->display($c);
			?>
		</div>
	</div>
	<div class="row">
		<!-- <div class="col-md-10" style="margin-left:270px;"> -->
		<div class="col-md-10">
			<?php
			$a = new Area('Main2');
			/* $a->setAreaGridMaximumColumns(10); */
			$a->display($c);
			?>
		</div>
	</div>
	<div class="row investor-centre">
		<?php
			$a = new Area('Full Width - Footer');
			$a->display($c);
		?>
	</div>

</main>

<?php  $this->inc('elements/footer.php'); ?>
