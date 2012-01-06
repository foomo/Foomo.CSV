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
	
	public function __construct(array $allowedValues)
	{
		$this->allowedValues = $allowedValues;
	}
	public function validate(ValidatedField $field)
	{
		$field->valid = in_array($field->raw, $this->allowedValues);
		if(!$field->valid) {
			 $field->report = 'unallowed value ' . $field->raw . ' not in ' . implode(', ', $this->allowedValues);
		}
	}
	/**
	 * create
	 * 
	 * @param array $allowedValues
	 * 
	 * @return \Foomo\CSV\Validation\FieldValidators\Enum
	 */
	public static function create(array $allowedValues)
	{
		return new self($allowedValues);
	}
}