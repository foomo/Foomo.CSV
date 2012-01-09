<?php

namespace Foomo\CSV\Jobs;

use Foomo\CSV\Parser as CSVParser;
use Foomo\CSV\Validator as CSVValidator;
use Foomo\CSV\Validation\FieldValidators\Enum;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ManagerWorld
{
	/**
	 * @var PHPUnit_Framework_TestCase
	 */
	public $testCase;
	// missing method on your world:
	/**
	 * @story given no job exists
	 * @return Foomo\CSV\Jobs\ManagerWorld
	 */
	public function givenNoJobExists()
	{
		Manager::clearJobs();
	}

	// missing method on your world:
	/**
	 * @story when job is created
	 * @return Foomo\CSV\Jobs\ManagerWorld
	 */
	public function whenJobIsCreated()
	{
		$this->createJob();
	}

	// missing method on your world:
	/**
	 * @story then job exists
	 * @return Foomo\CSV\Jobs\ManagerWorld
	 */
	public function thenJobExists()
	{
		$this->testCase->assertInstanceOf(__NAMESPACE__ . '\\Job', Manager::getJobById($this->myJobId));
	}

	private $myJobId;
	private function createJob()
	{
		$parser = CSVParser::create(__DIR__ . DIRECTORY_SEPARATOR . 'mockAddresses.csv')->setParseMode(CSVParser::PARSE_MODE_HASH);
		$validator = CSVValidator::create()
			->addFieldValidator('salutation', Enum::create(array('Mr.', 'Ms.', 'Mrs.')))
			->addFieldValidator('sex', Enum::create(array('male', 'female')))
			->addLineValidator(new \Foomo\CSV\Validation\MockLineValidator())
		;
		$job = new Job($parser, $validator, $comment = 'that would be  a test address list');
		$this->myJobId = $job->getId();
		Manager::addJob($job);
	}
}