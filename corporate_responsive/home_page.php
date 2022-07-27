<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

	<div class="row">
		<div class="col-md-9">
			<div class="row" >
			
						<div class="top-row" >
<?php
				$a = new Area('Top Row');
				$a->display($c);
?>
			</div>
			
			
				<div class="col-md-12">
<?php
					$a = new Area('Main');
					$a->display($c);
?>
				</div>
			</div>

			<div class="row bottom-row" >
<?php
				$a = new Area('Bottom Row');
				$a->display($c);
?>
			</div>
		</div>
		<div class="col-md-3">
<?php
			$a = new Area('Sidebar');
			$a->display($c);
?>
		</div>
	</div>
	
<?php  $this->inc('elements/footer.php'); ?>
