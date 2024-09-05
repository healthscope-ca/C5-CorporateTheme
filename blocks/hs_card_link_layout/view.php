<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="col-xs-12 col-sm-12 col-md-4">
	<div class="card-link-wrapper">
		<div class="row">	
			<div class="col-xs-12 col-sm-5 col-md-12">
				<a href="<?php echo $buttonUrl; ?>" class="button-url">
<?php if ($cardImage) { ?>
					<div class="card-image"  style="background-image: url('<?php echo $cardImage->getURL(); ?>');">
						<div class="image"></div>
					</div>
<?php } ?>
				</a>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-12">
				<a href="<?php echo $buttonUrl; ?>" class="button-url">
					<div class="card-content">
					<div class="card-text">					
<?php if (isset($cardTitle) && trim($cardTitle) != "") { ?>
							<h5 class="card-heading"><?php echo $cardTitle; ?></h5><?php } ?>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>