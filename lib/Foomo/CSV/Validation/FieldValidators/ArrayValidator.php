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
class ArrayValidator extends AbstractValidator
{
	private $delimiter = ',';
	/**
	 *
	 * @param string $delimiter
	 * 
	 * @return \Foomo\CSV\Validation\FieldValidators\ArrayValidator 
	 */
	public function delimiter($delimiter)
	{
		$this->delimiter = $delimiter;
		return $this;
	}
	public function validate(ValidatedField $field)
	{
		$parts = explode($this->delimiter, $field->raw);
		$field->valid = true;
		$field->correctedValue = $parts;
	}
}