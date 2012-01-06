<?php

namespace Foomo\CSV\Jobs;

use Foomo\CSV\Module as CSVModule;
/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Job
{
	/**
	 * @var Foomo\CSV\Parser;
	 */
	public $parser;
	/**
	 * @var Foomo\CSV\Validator
	 */
	public $validator;
	/**
	 * a comment explaining, what the that job is
	 * 
	 * @var string
	 */
	public $comment;
	/**
	 * @var string
	 */
	private $id;
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------
	public function __construct(\Foomo\CSV\Parser $parser, \Foomo\CSV\Validator $validator, $comment)
	{
		$this->comment = $comment;
		$this->parser = $parser;
		$this->validator = $validator;
		$this->parser->rewind();
		$this->id = md5(serialize($this->validator) . serialize($this->parser));
	}
	/**
	 * unique id derived from job content
	 * 
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	public function persist()
	{
		file_put_contents($this->getFilename(), serialize($this));
	}
	public function delete()
	{
		if(file_exists($filename = $this->getFilename())) {
			unlink($filename);
		}
	}
	private function getFilename()
	{
		return CSVModule::getJobsFolderResource()->getFileName() . DIRECTORY_SEPARATOR . $this->getId();
	}
}