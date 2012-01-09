<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV;

use Foomo\CSV\Validation\FieldValidators\Boolean;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		
	}
	public function testValidator()
	{
		$lineReport = Validator::create()
			->addFieldValidator('goodBool', Boolean::create(array('yes'), array('no')))
			->addFieldValidator('badBool', Boolean::create(array('yes'), array('no')))
			->addLineValidator(new Validation\MockLineValidator())
			->validate($data = array(
				$goodBoolKey = 'goodBool' => 'yes',
				$anotherGoodBoolKey = 'goodBool' => 'yes ',
				$badBoolKey = 'badBool' => 'yäs'
			))
		;
		$keys = array_keys($data);
		foreach($keys as $key) {
			$this->assertArrayHasKey($key, $lineReport->fields);
		}
		// \Foomo\TestRunner\VerbosePrinter\HTML::dump($lineReport, $goodBoolKey);
		$this->assertTrue($lineReport->fields[$goodBoolKey][0]->valid);
		$this->assertFalse($lineReport->fields[$badBoolKey][0]->valid);
	}
}