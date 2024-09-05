<?php namespace Application\Block\HsCardLayout;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Core;
use File;
use Page;
use AssetList;

class Controller extends BlockController
{
    public $btFieldsRequired = array();
    protected $btExportFileColumns = array('cardImage');
    protected $btTable = 'btHsCardLayout';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $pkg = false;
    
    public function getBlockTypeDescription()
    {
        return t("A card layout for Healthscope");
    }

    public function getBlockTypeName()
    {
        return t("Card & Info");
    }

    public function getSearchableContent()
    {
        $content = [];
        $content[] = $this->cardTitle;
        $content[] = $this->cardBody;
        $content[] = $this->buttonText;
        return implode(" ", $content);
    }

    public function view()
    {
        
        if ($this->cardImage && ($f = File::getByID($this->cardImage)) && is_object($f)) {
            $this->set("cardImage", $f);
        } else {
            $this->set("cardImage", false);
        }
        $this->set('cardBody', LinkAbstractor::translateFrom($this->cardBody));
        if (trim($this->buttonText) == "") {
            $this->set("buttonText", 'more...');
        }
    }

    public function add()
    {
        $this->addEdit();
    }

    public function edit()
    {
        $this->addEdit();
        
        $this->set('cardBody', LinkAbstractor::translateFromEditMode($this->cardBody));
    }

    protected function addEdit()
    {
        $al = AssetList::getInstance();
        $al->register('css', 'datetimepicker', 'blocks/hs_card_layout/css_form/bootstrap-datetimepicker.min.css', array(), $this->pkg);
        $al->register('css', 'bootstrap_fonts', 'blocks/hs_card_layout/css_form/bootstrap.fonts.css', array(), $this->pkg);
        $al->register('css', 'datetimepicker-composer', 'blocks/hs_card_layout/css_form/bootstrap-datetimepicker-composer.css', array(), $this->pkg);
        $al->register('javascript', 'moment', 'blocks/hs_card_layout/js_form/moment.js', array(), $this->pkg);
        $al->register('javascript', 'bootstrap', 'blocks/hs_card_layout/js_form/bootstrap.min.js', array(), $this->pkg);
        $al->register('javascript', 'datetimepicker', 'blocks/hs_card_layout/js_form/bootstrap-datetimepicker.min.js', array(), $this->pkg);
        $this->requireAsset('css', 'datetimepicker');
        $this->requireAsset('css', 'bootstrap_fonts');
        $this->requireAsset('css', 'datetimepicker-composer');
        $this->requireAsset('javascript', 'moment');
        $this->requireAsset('javascript', 'bootstrap');
        $this->requireAsset('javascript', 'datetimepicker');

        $this->requireAsset('core/file-manager');
        $this->requireAsset('redactor');

        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', Core::make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
		if ($args['articleDate'])
			$args['articleDate'] = strtotime(substr($args['articleDate'], 0, 22));
		else
			$args['articleDate'] = 0;
        $args['cardBody'] = LinkAbstractor::translateTo($args['cardBody']);
        parent::save($args);
    }

    public function validate($args)
    {
        $e = Core::make("helper/validation/error");
        if (in_array("cardImage", $this->btFieldsRequired) && (trim($args["cardImage"]) == "" || !is_object(File::getByID($args["cardImage"])))) {
            $e->add(t("The %s field is required.", t("Card Image")));
        }
        if (in_array("cardTitle", $this->btFieldsRequired) && (trim($args["cardTitle"]) == "")) {
            $e->add(t("The %s field is required.", t("Card Title")));
        }
/*
        if (in_array("articleDate", $this->btFieldsRequired) && trim($args["articleDate"]) == "") {
            $e->add(t("The %s field is required.", t("Article Date")));
        } elseif (trim($args["articleDate"]) != "" && strtotime($args["articleDate"]) <= 0) {
            $e->add(t("The %s field is not a valid date.", t("Article Date")));
        }
*/
        if (in_array("cardBody", $this->btFieldsRequired) && (trim($args["cardBody"]) == "")) {
            $e->add(t("The %s field is required.", t("Card Body")));
        }
/*		
        if (((!in_array("buttonUrl", $this->btFieldsRequired) && trim($args["buttonUrl"]) != "") || (in_array("buttonUrl", $this->btFieldsRequired))) && !filter_var($args["buttonUrl"], FILTER_VALIDATE_URL)) {
            $e->add(t("The %s field does not have a valid URL.", t("Button URL")));
        }
*/
        if (in_array("buttonText", $this->btFieldsRequired) && (trim($args["buttonText"]) == "")) {
            $e->add(t("The %s field is required.", t("Button Text")));
        }
        return $e;
    }

    public function composer()
    {
        $al = AssetList::getInstance();
        $al->register('css', 'datetimepicker-composer', 'blocks/hs_card_layout/css_form/bootstrap-datetimepicker-composer.css', array(), $this->pkg);
        $this->requireAsset('css', 'datetimepicker-composer');

        $this->edit();
    }
}