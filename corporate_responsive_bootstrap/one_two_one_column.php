<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main>
	<div class="row">
		<div class="col-md-10 col-md-offset-1-1">
			<?php
			$a = new Area('Top Main');
			$a->setAreaGridMaximumColumns(12);
			$a->display($c);
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5 col-md-offset-1-1">
			<?php
			$a = new Area('Middle Left');
			$a->display($c);
			?>
		</div>
		<div class="col-md-5">
			<?php
			$a = new Area('Middle Right');
			$a->display($c);
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1-1">
			<?php
			$a = new Area('Bottom Main');
			$a->setAreaGridMaximumColumns(12);
			$a->display($c);
			?>
		</div>
	</div>
</main>

<?php  $this->inc('elements/footer.php'); ?>
