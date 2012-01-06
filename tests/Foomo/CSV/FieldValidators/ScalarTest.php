<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ScalarTest extends \PHPUnit_Framework_TestCase
{
	public function testValidator()
	{
		
		$data = array(
			Scalar::TYPE_FLOAT => array(
				'' => false,
				'0.1' => true,
				'0,2' => false
			),
			Scalar::TYPE_INTEGER => array(
				'' => false,
				'12345' => true,
				'-1234' => true,
				'1.000' => false
			),
		);
		foreach($data as $type => $samples) {
			$validator = Scalar::create($type);
			foreach($samples as $value => $valid) {
				$field = new ValidatedField;
				$field->raw = $value;
				$validator->validate($field);
				$this->assertEquals($valid, $field->valid, 'testing type : ' . $type . ' value : ' . $value . ' should have been : ' . ($valid?'valid':'invalid'));
			}
		}
	}
}