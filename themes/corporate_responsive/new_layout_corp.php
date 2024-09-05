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
                break; } 
    };
</script>
<main>
	<div class="row">
		<?php
			$a = new Area('Rolling Images');
			$a->display($c);
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
		<!--div class="col-md-9 col-md-offset-1-5"-->
			<?php
			$a = new Area('Main');
			$a->display($c);
			?>
		</div>
	</div>
	<div class="row top-row">
<?php
		$a = new Area('CardRowTop');
		$a->display($c);
?>
	</div>
	<div class="row middle-row">
<?php
		$a = new Area('MiddleRow');
		$a->display($c);
?>
	</div>
	<div class="row bottom-row">
<?php
		$a = new Area('BottomRow');
		$a->display($c);
?>
	</div>

</main>
<?php  $this->inc('elements/footer.php'); ?>
