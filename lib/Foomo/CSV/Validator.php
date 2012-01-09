<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Validator
{
	public $fieldValidators = array();
	/**
	 * (user) line validators
	 * 
	 * @var Validation\AbstractLineValidator[]
	 */
	public $lineValidators = array();
	private function __construct() {}
	/**
	 * @return Foomo\CSV\Validation\Validator
	 */
	public static function create()
	{
		return new self;
	}
	/**
	 * validate a line
	 * 
	 * @param array $line
	 * 
	 * @return Validation\ValidatedLine 
	 */
	public function validate(array $line)
	{
		$ret = new Validation\ValidatedLine;
		$report = array();
		$ret->valid = true;
		foreach($line as $field => $value) {
			
			if(isset($this->fieldValidators[$field])) {
				$validators = $this->fieldValidators[$field];
			} else {
				$validators = array(new Validation\FieldValidators\NullValidator);
			}
			$report[$field] = array();
			
			foreach($validators as $fieldValidator) {
				$validatedField = new Validation\FieldValidators\ValidatedField();
				$report[$field][] = $validatedField;
				$validatedField->raw = $value;
				$fieldValidator->validate($validatedField);
				if(!$validatedField->valid) {
					$ret->valid = false;
					break;
				} else {
					$ret->correctedValues[$field] = $validatedField->correctedValue;
				}
			}
		}
		$ret->fields = $report;
		foreach($this->lineValidators as $lineValidator) {
			$lineValidator->validateLine($ret);
		}
		return $ret;
	}
	/**
	 * add a field validato
	 * 
	 * @param type $field
	 * @param FieldValidators\AbstractFieldValidator $validator 
	 * 
	 * @return Validator
	 */
	public function addFieldValidator($field, $validator)
	{
		if(!isset($this->fieldValidators[$field])) {
			$this->fieldValidators[$field] = array();
		}
		$this->fieldValidators[$field][] = $validator;
		return $this;
	}
	/**
	 * add a line validator
	 * 
	 * @param Validation\AbstractLineValidator $validator
	 * 
	 * @return Validator 
	 */
	public function addLineValidator(Validation\AbstractLineValidator $validator)
	{
		$this->lineValidators[] = $validator;
		return $this;
	}
}