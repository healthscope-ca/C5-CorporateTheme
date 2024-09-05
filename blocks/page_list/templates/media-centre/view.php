<?php 
defined("C5_EXECUTE") or die("Access Denied."); 
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */

//  added by bruce to force these
$useButtonForLink = true;
$buttonLinkText = "[Read more]";
$includeDate = false;
$displayThumbnail = true;

    $includeEntryText = false;
    if (
        (isset($includeName) && $includeName)
        ||
        (isset($includeDescription) && $includeDescription)
        ||
        (isset($useButtonForLink) && $useButtonForLink)
    ) {
        $includeEntryText = true;
    }

    foreach ($pages as $page)
	{
		// Prepare data for each page being listed...
        $buttonClasses = 'ccm-block-page-list-read-more';
        $entryClasses = 'ccm-block-page-list-page-entry';
		$title = $th->entities($page->getCollectionName());
		$url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;
		$description = $page->getCollectionDescription();
		$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
		$description = $th->entities($description);
        $thumbnail = false;
        if ($displayThumbnail) {
            $thumbnail = $page->getAttribute('thumbnail');
        }
        if (is_object($thumbnail) && $includeEntryText) {
            $entryClasses = 'ccm-block-page-list-page-entry-horizontal';
        }

        $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);


		//Other useful page data...


		//$last_edited_by = $page->getVersionObject()->getVersionAuthorUserName();

		//$original_author = Page::getByID($page->getCollectionID(), 1)->getVersionObject()->getVersionAuthorUserName();

		/* CUSTOM ATTRIBUTE EXAMPLES:
		 * $example_value = $page->getAttribute('example_attribute_handle');
		 *
		 * HOW TO USE IMAGE ATTRIBUTES:
		 * 1) Uncomment the "$ih = Loader::helper('image');" line up top.
		 * 2) Put in some code here like the following 2 lines:
		 *      $img = $page->getAttribute('example_image_attribute_handle');
		 *      $thumb = $ih->getThumbnail($img, 64, 9999, false);
		 *    (Replace "64" with max width, "9999" with max height. The "9999" effectively means "no maximum size" for that particular dimension.)
		 *    (Change the last argument from false to true if you want thumbnails cropped.)
		 * 3) Output the image tag below like this:
		 *		<img src="<?php echo $thumb->src ?>" width="<?php echo $thumb->width ?>" height="<?php echo $thumb->height ?>" alt="" />
		 *
		 * ~OR~ IF YOU DO NOT WANT IMAGES TO BE RESIZED:
		 * 1) Put in some code here like the following 2 lines:
		 * 	    $img_src = $img->getRelativePath();
		 *      $img_width = $img->getAttribute('width');
		 *      $img_height = $img->getAttribute('height');
		 * 2) Output the image tag below like this:
		 * 	    <img src="<?php echo $img_src ?>" width="<?php echo $img_width ?>" height="<?php echo $img_height ?>" alt="" />
		 */

		/* End data preparation. */

		/* The HTML from here through "endforeach" is repeated for every item in the list... */
		$cardTitle = $page->getAttribute('media_release_title');
		$cardImage  = $thumbnail;
		$cardTitle  = $cardTitle ? $cardTitle : $title;
		$cardBody   = $description;
		$buttonUrl  = $url;
		$buttonText = $buttonLinkText;
?>

<div class="col-xs-122">
	<div class="media-centre-wrapper">
		<div class="row">	
			<div class="col-xs-12 col-sm-6">
<?php if ($cardImage) { ?>
				<div class="card-image"  style="position: relative; background-image: url('<?php echo $cardImage->getURL(); ?>');">
					<div class="image"></div>
				</div>
<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-6">
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
					<a href="<?php echo $buttonUrl; ?>" class="button-url" target="_blank">
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

<?php
	}
?>

    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;?>
	
<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif; ?>	