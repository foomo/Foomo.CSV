<?php

namespace Foomo\CSV\Jobs;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Job
{
	public $id;
	public $csvFilename;
	public $validator;
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 */
	public function __construct($id, $csvFilename, \Foomo\CSV\Validator $validator)
	{
		$this->id = $id;
		$this->csvFilename = $csvFilename;
		$this->validator = $validator;
	}
	public function persist()
	{
		
	}
	public function delete()
	{
		
	}
}