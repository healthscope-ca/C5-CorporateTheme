<?php defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="col-xs-12 col-sm-12 col-md-4">
	<div class="card-wrapper">
		<div class="row">	
			<div class="col-xs-12 col-sm-5 col-md-12">

<?php if ($cardImage) { ?>
				<div class="card-image"  style="background-image: url('<?php echo $cardImage->getURL(); ?>');">
					<div class="image"></div>
				</div>
<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-12">
				<div class="card-content">
					<div class="card-text">

<?php if (isset($articleDate) && $articleDate > 0) { ?>
    <div class="card-date"><?php echo strftime("%d %B %Y",$articleDate); ?></div><?php } ?>					
					
<?php if (isset($cardTitle) && trim($cardTitle) != "") { ?>
						<h5 class="card-heading"><?php echo $cardTitle; ?></h5><?php } ?>
<?php if (isset($cardBody) && trim($cardBody) != "") { ?>
						<div class="card-body">
							<?php echo $cardBody; ?>
						</div>
<?php } ?>
					</div>
<?php if (isset($buttonUrl) && trim($buttonUrl) != "") { ?>
					<a href="<?php echo $buttonUrl; ?>" class="btn btn-default" target="_blank">
						<i class="fa fa-download"></i>
<?php if (isset($buttonText) && trim($buttonText) != "") { ?>
						<span class="text"><?php echo h($buttonText); ?></span>
<?php } ?>
					</a>
<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>