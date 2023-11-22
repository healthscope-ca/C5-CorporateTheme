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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
.news-blog-entry-content h1
{
	font-size: 14pt;
}
.news-blog-entry-content
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
<!-- hello bruce -->
	<div class="row top-row">
		<div class="col-md-9">
			<div class="row" >
				<div class="col-md-12">
					<div class="news-blog-entry-content">
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
