<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class EnumTest extends \PHPUnit_Framework_TestCase
{
	public function testValidator()
	{
		$validator = Enum::create(array('foo', 'bar', 'boo'));
		$data = array(
			'bla' => false,
			'foo' => true,
			'bar' => true
		);
		foreach($data as $value => $valid) {
			$field = new ValidatedField;
			$field->raw = $value;
			$validator->validate($field);
			$this->assertEquals($valid, $field->valid);
		}
	}
}