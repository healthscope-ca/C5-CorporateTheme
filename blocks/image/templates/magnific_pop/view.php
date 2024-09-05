<?php defined('C5_EXECUTE') or die("Access Denied.");
$view->requireAsset('core/lightbox');
$c = Page::getCurrentPage();
if (is_object($f)) {
    $tag = Core::make('html/image', array($f, false))->getTag();
    $tag->addClass('ccm-image-block img-responsive');
    if ($altText) {
        $tag->alt($altText);
    }
    if ($title) {
        $tag->title($title);
    }

    print '<a title="'.$title.'" class="magnific-popup-image" href="' .$f->getRelativePath() . '">';
    print $tag;
    print '</a>';

} else if ($c->isEditMode()) { ?>

    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Image Block.')?></div>

<?php } ?>