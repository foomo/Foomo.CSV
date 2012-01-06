<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Boolean extends AbstractValidator
{
	/**
	 * 
	 * @var type 
	 */
	private $true = array();
	private $false = array();
	
	private function __construct(array $true, array $false)
	{
		$this->true = $true;
		$this->false = $false;
	}
	
	public function validate(ValidatedField $field)
	{
		$boolean = trim($field->raw);
		switch(true) {
			case in_array($boolean, $this->true):
				$field->correctedValue = true;
				break;
			case in_array($boolean, $this->false):
				$field->correctedValue = false;
				break;
		}
		$field->valid = is_bool($field->correctedValue);
	}
	/**
	 * make one
	 * 
	 * @param array $true values meaning true
	 * @param array $false values meaning false
	 * 
	 * @return Boolean
	 */
	public static function create(array $true, array $false)
	{
		return new self($true, $false);
	}
}