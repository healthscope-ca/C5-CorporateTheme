<?php namespace Application\Block\HsCardLinkLayout;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Core;
use File;
use Page;
use AssetList;

class Controller extends BlockController
{
    public $btFieldsRequired = array('buttonUrl');
    protected $btExportFileColumns = array(
		'cardImage',
		'cardTitle',
		'buttonUrl',
		'buttonText',
	);
    protected $btTable = 'btHsCardLinkLayout';
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
        return t("Image and Title - all link");
    }

    public function getBlockTypeName()
    {
        return t("Card as Link");
    }

    public function getSearchableContent()
    {
        $content = [];
        $content[] = $this->cardTitle;
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
    }

    protected function addEdit()
    {
        $this->requireAsset('core/file-manager');

        $this->set('btFieldsRequired', $this->btFieldsRequired);
        $this->set('identifier_getString', Core::make('helper/validation/identifier')->getString(18));
    }

    public function save($args)
    {
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
        if (in_array("buttonText", $this->btFieldsRequired) && (trim($args["buttonText"]) == "")) {
            $e->add(t("The %s field is required.", t("Button Text")));
        }
		//  Note that the validation of the url is removed because we want to use relative URLs for internal references but it did not like them. 
		if (in_array("buttonUrl", $this->btFieldsRequired) && trim($args["buttonUrl"]) == "") {
			$e->add(t("The %s field is required.", t("Button URL")));
        }

        return $e;
    }

    public function composer()
    {
        $this->edit();
    }
}