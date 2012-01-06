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
class ParserTest extends \PHPUnit_Framework_TestCase
{
	private $csvs;
	//---------------------------------------------------------------------------------------------
	// ~ boilderplate
	//---------------------------------------------------------------------------------------------
	public function setUp()
	{
		$this->csvs = array(
			'mock-comma-double-quot' => array(
				'delimiter' => ',',
				'enclosure' => '"'
			),
			'mock-semicolon-single-quot' => array(
				'delimiter' => ';',
				'enclosure' => '\''
			)
		);
		foreach($this->csvs as $name => $defs) {
			$defs['filename'] = __DIR__ . DIRECTORY_SEPARATOR . $name . '.csv';
			$this->csvs[$name] = $defs;
		}
	}
	public function tearDown()
	{
		
	}
	//---------------------------------------------------------------------------------------------
	// ~ test
	//---------------------------------------------------------------------------------------------
	public function testParseCounts()
	{
		foreach($this->csvs as $name => $csv) {
			foreach(array(Parser::PARSE_MODE_ARRAY => 5, Parser::PARSE_MODE_HASH => 4) as $mode => $expectedLines) {
				$this->assertInternalType('array', $actual = $this->parse($csv['filename'], $mode, $csv['delimiter'], $csv['enclosure']), $name);
				$this->assertCount($expectedLines, $actual, 'failed mode:' . $mode . ' in : ' . $name);
			}
		}
	}
	public function testParseHash()
	{
		foreach($this->csvs as $name => $csv) {
			foreach ($this->parse($csv['filename'], Parser::PARSE_MODE_HASH, $csv['delimiter'], $csv['enclosure']) as $line) {
				foreach(array("foo","bar","fooBar","foos","text") as $expectedKey) {
					$this->assertArrayHasKey($expectedKey, $line);
				}
			}
		}
	}

	//---------------------------------------------------------------------------------------------
	// ~ helpers
	//---------------------------------------------------------------------------------------------
	private function parse($filename, $mode, $delimiter, $enclosure)
	{
		$ret = array();
		foreach(Parser::create($filename, $delimiter, $enclosure)->setParseMode($mode) as $line) {
			$ret[] = $line;
		}
		return $ret;
	}
}