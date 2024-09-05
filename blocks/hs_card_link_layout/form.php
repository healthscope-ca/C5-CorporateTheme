<?php defined("C5_EXECUTE") or die("Access Denied."); ?>
<div class="form-group">
    <?php
    if (isset($cardImage) && $cardImage > 0) {
        $cardImage_o = File::getByID($cardImage);
        if (!is_object($cardImage_o)) {
            unset($cardImage_o);
        }
    } ?>
    <?php echo $form->label($view->field('cardImage'), t("Card Image") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("This is the image description") . '"></i>'); ?>
    <?php echo isset($btFieldsRequired) && in_array('cardImage', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php echo Core::make("helper/concrete/asset_library")->image('ccm-b-hs_card_layout-cardImage-' . $identifier_getString, $view->field('cardImage'), t("Choose Image"), $cardImage_o); ?>
</div>

<div class="form-group">
    <?php echo $form->label($view->field('cardTitle'), t("Card Title") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("The title of this card") . '"></i>'); ?>
    <?php echo isset($btFieldsRequired) && in_array('cardTitle', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php echo $form->text($view->field('cardTitle'), $cardTitle, array (
  'maxlength' => 255,
)); ?>
</div>

<div class="form-group">
    <?php echo $form->label($view->field('buttonUrl'), t("Button URL") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("The URL that the button goes to") . '"></i>'); ?>
    <?php echo isset($btFieldsRequired) && in_array('buttonUrl', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php echo $form->text($view->field('buttonUrl'), $buttonUrl, []); ?>
</div>

<div class="form-group">
    <?php echo $form->label($view->field('buttonText'), t("Button Text") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("The text on the button or link") . '"></i>'); ?>
    <?php echo isset($btFieldsRequired) && in_array('buttonText', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php echo $form->text($view->field('buttonText'), $buttonText, array (
  'maxlength' => 255,
)); ?>
</div>