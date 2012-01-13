<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Trim extends AbstractValidator
{
	public function validate(ValidatedField $field)
	{
		$field->valid = true;
		$field->correctedValue = trim($field->raw);
	}
	
	/**
	 * create
	 * 
	 * @return \Foomo\CSV\Validation\FieldValidators\Trim
	 */
	public static function create()
	{
		return new self();
	}
}