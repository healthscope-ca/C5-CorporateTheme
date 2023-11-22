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
</main>

<?php  $this->inc('elements/footer.php'); ?>
