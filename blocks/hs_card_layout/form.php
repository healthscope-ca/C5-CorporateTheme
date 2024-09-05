<?php defined("C5_EXECUTE") or die("Access Denied."); ?>
<script type="text/javascript">
    $(function () {
        $(".ft-dateTime-date_picker-articleDate").datetimepicker({
			"pickDate":true,
			"pickTime":false,
			"useMinutes":false,
			"useSeconds":false,
			"useCurrent":true,
			"showToday":true,
			"useStrict":true,
			"sideBySide":false,
//			"format": 'DD/MM/YYYY',
//			"locale": 'en-au',
			"minuteStepping":1,
			"minDate":"",
			"defaultDate":"",
			"icons ":{
			"time":"glyphicon glyphicon-time",
			"date":"glyphicon glyphicon-calendar",
			"up":"glyphicon glyphicon-chevron-up",
			"down":"glyphicon glyphicon-chevron-down"},
			"language":"en",
			"disabledDates":[],
			"enabledDates":[],
			"daysOfWeekDisabled":[]
		});
    });
</script>
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
	<?php echo $form->label($view->field('articleDate'), t("Article Date") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("Date Published") . '"></i>'); ?>
	<?php echo isset($btFieldsRequired) && in_array('articleDate', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
	<?php echo $form->text($view->field('articleDate'), $articleDate > 0 ? date("m/d/Y", $articleDate) : null, 
		array (
			'autocomplete' => 'off',
			'class' => 'ft-dateTime-date_picker-articleDate',
		)
	); 
	?>
</div>

<div class="form-group">
    <?php echo $form->label($view->field('cardBody'), t("Card Body") . ' <i class="fa fa-question-circle launch-tooltip" data-original-title="' . t("The body text for this card") . '"></i>'); ?>
    <?php echo isset($btFieldsRequired) && in_array('cardBody', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php echo Core::make('editor')->outputBlockEditModeEditor($view->field('cardBody'), $cardBody); ?>
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