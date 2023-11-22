<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
<script type="text/javascript"> // Reload page when mobile device changes orientation
    window.onorientationchange = function() { 
        var orientation = window.orientation; 
            switch(orientation) { 
                case 0: window.location.reload(); 
                break; 
                case 90: window.location.reload(); 
                break; 
                case -90: window.location.reload(); 
                break; 
			} 
    };
</script>
<style type="text/css">
.health-blog-entry-content h1
{
	font-size: 14pt;
}
.health-blog-entry-content
{
	
}
.row.top-row
{
	margin-top: 10px;
}
</style>
	<div class="row">
			<?php
			$a = new Area('Full Width');
			$a->display($c);
			?>
	</div>
<?php
	$a = new Area('Page Header');
	//$a->enableGridContainer();
	$a->display($c);
?>
	<div class="row top-row">
		<div class="col-md-9">
			<div class="row" >
				<div class="col-md-12">
					<div class="health-blog-entry-content">
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
<?php
	$a = new Area('Page Footer');
	//$a->enableGridContainer();
	$a->display($c);
?>

<?php  $this->inc('elements/footer.php'); ?>
