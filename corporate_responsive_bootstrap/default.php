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
	<!-- <div class="row investor-centre block-header">
		<div class="col-md-12">
			<h1>Investor Centre</h1>
		</div>
	</div>
	
	<div class="row investor-centre">
        <div class="col-md-12">
			<?php
			//$a = new GlobalArea('Our Services');
			//$a->setBlockWrapperStart('<div class="ourservices1">');
			//$a->setBlockWrapperEnd('</div>');
			//$a->display();
			?>
		</div>
    </div>
    <div class="row investor-centre">
        <?php
        $a = new GlobalArea('Services');
        $a->display();
        ?>
    </div> --->
</main>
<?php  $this->inc('elements/footer.php'); ?>
