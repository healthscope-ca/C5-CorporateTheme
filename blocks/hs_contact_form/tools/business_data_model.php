<?php
//abstract class BusinessDataModel extends DataModel implements BusinessModelInterface
namespace Application\Block\HsContactForm\Tools;

abstract class BusinessDataModel implements BusinessModelInterface
{

	public function __construct()
	{
		//parent::__construct();
	}

	//
	//  Adding 'attributes' property set for all.
	//
	function __set($attributeName, $attributeValue)
	{
		switch ($attributeName)
		{
			case 'attributes':
				//
				//  special property assignment that expects an array of fieldname => value combinations.
				//
				if (is_array($attributeValue))
				{
					foreach ($attributeValue as $key => $value)
					{
						$this->$key = $value;
					}
				}
				break;
			default:
				throw new Exception(sprintf("Attempt to write to an unknown attribute '%s',", $attributeName));
		}
	}


	/**
	* Implementation of BusinessModelInterface
	*/
	private $attributeLabels   = array();
	private $attributeErrors   = array();
	private $attributeRequired = array();

	public function getAttributeLabel($attribute)
	{
		$label = $attribute;
		if (array_key_exists($attribute, $this->attributeLabels))
		{
			$label = $this->attributeLabels[$attribute];
		}
		return $label ? $label : $attribute;
	}
	public function setAttributeLabel($attribute, $label)
	{
		$this->attributeLabels[$attribute] = $label;
	}

	/**
	 * Returns a value indicating whether there is any validation error.
	 * @param string $attribute attribute name. Use null to check all attributes.
	 * @return boolean whether there is any error.
	 */
	public function hasErrors($attribute = null)
	{
		if ($attribute === null)
			return (bool)count($this->attributeErrors);
		if (array_key_exists($attribute, $this->attributeErrors))
			return (bool)count($this->attributeErrors[$attribute]);
		else
			return false;
	}

	public function isAttributeRequired($attribute)
	{
		$isRequired = false;
		if (array_key_exists($attribute, $this->attributeRequired))
		{
			$isRequired = (bool)$this->attributeRequired[$attribute];
		}
		return $isRequired;
	}

	public function getError($attribute)
	{
		if (array_key_exists($attribute, $this->attributeErrors))
			return reset($this->attributeErrors[$attribute]); // returns the first error
		else
			return '';
	}

	public function getValidators($attribute)
	{
		return array();
	}

	/**
	* Add this one to the interface.
	*
	*/
	public function getErrors($attribute=null)
	{
		if($attribute === null)
			return $this->attributeErrors;
		else
			return isset($this->attributeErrors[$attribute]) ? $this->attributeErrors[$attribute] : array();
	}

	/**
	* Not part of the Yii interfaces required by CHTML class.
	*
	* @param mixed $attribute
	* @param mixed $isRequired
	*/
	public function setAttributeRequired($attribute, $isRequired)
	{
		$this->attributeRequired[$attribute] = $isRequired;
	}

	public function setAttributeError($attribute, $description)
	{
		$this->attributeErrors[$attribute][] = $description;
	}

}
?>
