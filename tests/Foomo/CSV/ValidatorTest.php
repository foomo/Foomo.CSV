<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV;

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
		$lineReport =Validator::create()
			->addFieldValidator('goodBool', new Validation\FieldValidators\Boolean(array('yes'), array('no')))
			->addFieldValidator('badBool', new Validation\FieldValidators\Boolean(array('yes'), array('no')))
			->validate($data = array(
				$goodBoolKey = 'goodBool' => 'yes',
				$anotherGoodBoolKey = 'goodBool' => 'yes ',
				$badBoolKey = 'badBool' => 'yäs'
			))
		;
		$keys = array_keys($data);
		foreach($keys as $key) {
			$this->assertArrayHasKey($key, $lineReport);
		}
		// \Foomo\TestRunner\VerbosePrinter\HTML::dump($lineReport, $goodBoolKey);
		$this->assertTrue($lineReport[$goodBoolKey][0]->valid);
		$this->assertFalse($lineReport[$badBoolKey][0]->valid);
	}
}