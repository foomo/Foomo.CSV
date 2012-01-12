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
	private $mapKeys = array();
	
	public function __construct(array $allowedValues, array $valueMap = array())
	{
		$this->allowedValues = $allowedValues;
		$this->valuesMap = $valueMap;
		$this->mapKeys = array_keys($this->valuesMap);
	}
	public function validate(ValidatedField $field)
	{
		$field->valid = in_array($field->raw, $this->allowedValues);
		if(!$field->valid) {
			 $field->report = 'unallowed value ' . $field->raw . ' not in ' . implode(', ', $this->allowedValues);
		} else {
			if(isset($this->mapKeys[$field->raw])) {
				$field->correctedValue = $this->mapKeys[$field->raw];
			}
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