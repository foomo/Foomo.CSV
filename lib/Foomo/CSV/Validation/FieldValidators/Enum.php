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
	private $defaultValue = null;

	private function __construct(array $allowedValues, array $valuesMap = array(), $defaultValue = null)
	{
		$this->allowedValues = $allowedValues;
		$this->valuesMap = $valuesMap;
		$this->defaultValue = $defaultValue;
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
		if(!$field->valid && $this->defaultValue !== null) {
			$field->correctedValue = $this->defaultValue;
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
		return new self(func_get_arg(0), func_get_arg(1), func_get_arg(2));
	}
}