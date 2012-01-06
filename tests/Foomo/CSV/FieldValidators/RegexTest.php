<?php

namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class RegexTest extends \PHPUnit_Framework_TestCase
{
	public function testValidator()
	{
		$data = array(
			'test' => array(
				'expressions' => array('/test/i'),
				'valid' => true
			),
			'foo' => array(
				'expressions' => array('/test/i', '/fooo/'),
				'valid' => false
			)
		);
		foreach($data as $value => $data) {
			$validator = Regex::create($data['expressions']);
			$field = new ValidatedField;
			$field->raw = $value;
			$validator->validate($field);
			$this->assertEquals($valid = $data['valid'], $field->valid, 'for value : ' . $value);
			if($valid) {
				$this->assertEquals($field->raw, $field->correctedValue);
			} else {
				$this->assertEmpty($field->correctedValue);
				$this->assertNotEmpty($field->report);
			}
		}
	}
}