<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class BooleanTest extends \PHPUnit_Framework_TestCase
{
	public function testValidator()
	{
		Boolean::create(array('ja', 'true'), array('', 'false'));
	}
}