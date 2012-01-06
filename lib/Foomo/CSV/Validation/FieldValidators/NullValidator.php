<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class NullValidator extends AbstractValidator
{
	public function validate(ValidatedField $field)
	{
		$field->valid = true;
		$field->report = 'no validation';
	}
}