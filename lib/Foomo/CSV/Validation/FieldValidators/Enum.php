<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Enum extends AbstractValidator
{
	private $allowedValues = array();
	private $valuesMap = array();
	
	public function __construct(array $allowedValues, array $valuesMap = array())
	{
		$this->allowedValues = $allowedValues;
		$this->valuesMap = $valuesMap;
	}
	public function validate(ValidatedField $field)
	{
		$field->valid = in_array($field->raw, $this->allowedValues);
		if(!$field->valid) {
			 $field->report = 'unallowed value ' . $field->raw . ' not in ' . implode(', ', $this->allowedValues);
		} else if(isset($this->valuesMap[$field->raw])) {
			$field->correctedValue = $this->valuesMap[$field->raw];
			$field->valid = true;
		}
	}
	/**
	 * create
	 * 
	 * @param array $allowedValues
	 * 
	 * @return \Foomo\CSV\Validation\FieldValidators\Enum
	 */
	public static function create()
	{
		return new self(func_get_arg(0));
	}
}