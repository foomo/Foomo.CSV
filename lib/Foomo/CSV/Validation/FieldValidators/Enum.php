<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class EnumValidator extends AbstractValidator
{
	private $allowedValues = array();
	public function setAllowedValues(array $allowedValues)
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
}