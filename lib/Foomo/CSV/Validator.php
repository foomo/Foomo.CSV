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
	private function __construct() {}
	/**
	 * @return \Foomo\CSV\Validation\Validator
	 */
	public static function create()
	{
		return new self;
	}
	public function validate(array $line)
	{
		$report = array();
		foreach($line as $field => $value) {
			
			if(isset($this->fieldValidators[$field])) {
				$validators = $this->fieldValidators[$field];
			} else {
				$validators = array(new FieldValidators\NullValidator);
			}
			$report[$field] = array();
			
			foreach($validators as $fieldValidator) {
				$validatedField = new Validation\FieldValidators\ValidatedField();
				$report[$field][] = $validatedField;
				$validatedField->raw = $value;
				$fieldValidator->validate($validatedField);
				if(!$validatedField->valid) {
					break;
				}
			}
		}
		return $report;
	}
	/**
	 * add a validato
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
}