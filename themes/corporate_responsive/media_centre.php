<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
<style type="text/css">
.media-centre-content h1
{
}
.media-centre-content
{
	
}

.row.top-row
{
	margin-top: 10px;
}
</style>
	<div class="row top-row">
		<div class="col-md-9">
			<div class="row" >
				<div class="col-md-12">
					<div class="media-centre-content">
<?php
			$a = new Area('Main');
			$a->display($c);
?>
					</div>
				</div>
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
