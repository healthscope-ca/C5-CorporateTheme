<?php
/**
* I want to use CHTML class from Yii and it references a set of business related functions via $model
* but I do not wish to pollute my DataModel classes with these, so will extend them as required.. for now.
*
* @author bruce
*
*/
namespace Application\Block\HsContactForm\Tools;

interface BusinessModelInterface
{
	public function getAttributeLabel($attribute);
	public function setAttributeLabel($attribute, $label);
	public function hasErrors($attribute);
	public function isAttributeRequired($attribute);
	public function getError($attribute);
	public function getErrors($attribute=null);
	public function getValidators($attribute);
}
?>
