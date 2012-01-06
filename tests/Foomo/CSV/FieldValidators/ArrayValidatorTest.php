<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ArrayValidatorTest extends \PHPUnit_Framework_TestCase
{
	public function testValidator()
	{
		$data = array(
			'a, b, c' => array('data' => array('a', 'b', 'c'), 'delimiter' => ','),
			'a, b, c' => array('data' => array('a, b, c'), 'delimiter' => ';'),
		);
		foreach($data as $value => $testData) {
			$validator = ArrayValidator::create()->delimiter($testData['delimiter']);
			$field = new ValidatedField;
			$field->raw = $value;
			$validator->validate($field);
			$this->assertEquals($testData['data'], $field->correctedValue);
		}
	}
}