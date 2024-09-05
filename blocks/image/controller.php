<?php
namespace Application\Block\Image;

class Controller extends \Concrete\Block\Image\Controller {
    public function registerViewAssets($outputContent = '') {
        // Ensure we have JQuery if we have an onState image
        $this->requireAsset('core/lightbox');

        if(is_object($this->getFileOnstateObject())) {
            $this->requireAsset('javascript', 'jquery');
        }
    }
} ?>