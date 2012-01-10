<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Scalar extends AbstractValidator
{
	const TYPE_STRING = 'string';
	const TYPE_INTEGER = 'integer';
	const TYPE_FLOAT = 'float';
	private $type;
	private function __construct($type)
	{
		if(!in_array($type, array(self::TYPE_FLOAT, self::TYPE_INTEGER, self::TYPE_STRING))) {
			throw new \InvalidArgumentException('unsupported type: ' . $type, 1);
		}
		$this->type = $type;
	}
	public function validate(ValidatedField $field)
	{
		switch($this->type) {
			case self::TYPE_STRING:
				$field->correctedValue = $field->raw;
				$field->valid = true;
				break;
			case self::TYPE_INTEGER:
			case self::TYPE_FLOAT:
				$this->validateReverseCheck($field, $this->type);
				break;
		}
	}
	private function validateReverseCheck($field, $type)
	{
		$test = $rawTrim = trim($field->raw);
		if(settype($test, $type)) {
			$field->valid = ($rawTrim === (string) $test);
			if($field->valid) {
				$field->correctedValue = $test;
			} else {
				$field->report = 'reverse matching failed for type : ' . $type . ' on : ' . $rawTrim . ' != ' . ((string) $test);
			}
		} else {
			$field->valid = false;
			$field->report = 'failed to cast ' . $field->raw . ' to ' . $type;
		}
	}
	/**
	 * create
	 * 
	 * @param type $type one of self::TYPE_*
	 * 
	 * @return \Foomo\CSV\Validation\FieldValidators\Scalar
	 */
	public static function create()
	{
		return new self(func_get_arg(0));
	}
	
}