<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV\Validation;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class LineValidator
{
	/**
	 * validators
	 * @var array hash of functions key => function
	 */
	public $validators = array();
	public static function create()
	{
		return new self;
	}
	public function addValidator($key, $valodatorFunction)
	{
		
	}
	public function validateLine(array $line)
	{
		
	}
}