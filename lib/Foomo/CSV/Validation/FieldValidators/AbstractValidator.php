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
abstract class AbstractValidator
{
	abstract public function validate(ValidatedField $field);
	/**
	 * create and chain
	 * 
	 * @return self
	 */
	public static function create()
	{
		$class = get_called_class();
		return new $class;
	}
}