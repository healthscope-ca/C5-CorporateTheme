<?php

namespace Application\Block\HospitalsContactDetails;

use Concrete\Core\Block\BlockController;
use Core;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController
{

    protected $btTable = "btHospitalsContactDetails";
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "450";
    protected $btDefaultSet = 'basic';

    public function getBlockTypeName()
    {
        return t('Hospitals Contact Details');
    }

    public function validate($data)
    {
        $e = Core::make('error');
        if (!$data['hospitalName']) {
            $e->add(t('You must enter a Hospital Name.'));
        }
		if (!$data['address']) {
            $e->add(t('You must enter an Address.'));
        }
		if (!$data['phoneNumber']) {
            $e->add(t('You must enter a Phone Number.'));
        }

        return $e;
    }

    public function getBlockTypeDescription()
    {
        return t('Hospitals Contact Details block');
    }

    public function save($data)
    {
        parent::save($data);
    }
}
