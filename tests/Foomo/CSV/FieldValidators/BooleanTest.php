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
		$validator = Boolean::create(array('ja', 'true'), array('', 'false'));
		foreach(array('ja' => true, ' ja ' => true) as $value => $expectedValid) {
			$field = new ValidatedField;
			$field->raw = $value;
			$validator->validate($field);
			$this->assertEquals($field->valid, $expectedValid);
		}
	}
}