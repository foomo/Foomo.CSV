<?php

namespace Foomo\CSV\Validation;

/**
 * this is a draft so far 
 * 
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
abstract class AbstractLineValidator
{
	/**
	 * @param ValidatedLine
	 */
	abstract public function validateLine(ValidatedLine $validatedLine);
}