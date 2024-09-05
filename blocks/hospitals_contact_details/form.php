<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

?>

<div class="form-group">
    <label class="control-label" for="hospitalName"><?php echo t('Hospital Name')?></label>
    <input type="text" class="form-control" name="hospitalName" value="<?php echo $hospitalName?>">
</div>

<div class="form-group">
    <label class="control-label" for="address"><?php echo t('Address')?></label>
    <input type="text" class="form-control" name="address" value="<?php echo $address?>">
</div>

<div class="form-group">
    <label class="control-label" for="phoneNumber"><?php echo t('Phone Number')?></label>
    <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber?>">
</div>




