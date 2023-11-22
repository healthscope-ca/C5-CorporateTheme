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
.media-release-content h1
{
	font-size: 14pt;
}
.media-release-content
{
	
}
.media-release-separator
{
	text-align: center;
	font-weight: bold;
	margin-bottom: 10px;
}
.media-release-disclaimer
{
	font-size: 8pt;
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
					<div class="media-release-content">
<?php
			$a = new Area('Main');
			$a->display($c);
?>
					</div>
					<div class="media-release-separator">
					</div>
					<div class="media-release-disclaimer">
<?php
			$a = new Area('Disclaimer');
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
