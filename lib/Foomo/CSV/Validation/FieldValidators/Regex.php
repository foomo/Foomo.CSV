<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Regex extends AbstractValidator
{
	/**
	 * regular experssion to match to
	 *
	 * @var string
	 */
	public $expressions;
	private function __construct(array $expressions)
	{
		$this->expressions = $expressions;
	}

	public function validate(ValidatedField $field)
	{
		foreach($this->expressions as $expression) {
			if(preg_match($expression, $field->raw) > 0) {
				$field->valid = true;
				$field->correctedValue = $field->raw;
				return;
			}
		}
		$field->report = 'could not find a match';
		$field->valid = false;
	}

	/**
	 * matching expressions
	 *
	 * @param array $expressions
	 */
	public static function create()
	{
		return new self(func_get_arg(0));
	}
}