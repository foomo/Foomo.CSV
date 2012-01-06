<?php

namespace Foomo\CSV\Jobs;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 * 
 * @property-read $world ManagerWorld
 */
class ManagerSpec extends \Foomo\TestRunner\AbstractSpec
{
	
	public function setUp()
	{
		$this->setWorld(new ManagerWorld);
	}
	
	public function testScenarioJobCreation()
	{
		$this->world
			->givenNoJobExists()
			->whenJobIsCreated()
			->thenJobExists()
		;
	}
	public function testScenarioJobExecution()
	{
		$this->world
			->givenTestJobExists()
			->whenJobIsExecuted()
			->thenReportExists()
		;
	}
			
}