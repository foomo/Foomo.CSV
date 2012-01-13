<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class CustomFunction extends AbstractValidator
{
	private $function = '';

	public function __construct($function)
	{
		$this->function = $function;
	}

	public function validate(ValidatedField $field)
	{
		if (is_callable($this->function))
		{
			$field->valid = true;
			$field->correctedValue = call_user_func($this->function, $field->raw);
		}
	}

	/**
	 * create
	 *
	 * @return \Foomo\CSV\Validation\FieldValidators\CustomFunction
	 */
	public static function create()
	{
		return new self();
	}
}