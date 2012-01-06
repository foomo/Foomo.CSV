<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV\Jobs;

use Foomo\CSV\Module as CSVModule;
/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Manager
{
	/**
	 * add a job
	 * 
	 * @param Job $job 
	 */
	public static function addJob(Job $job)
	{
		$job->persist();
	}
	/**
	 * get all jobids
	 * 
	 * @return string
	 */
	public static function getJobIds()
	{
		$dirIterator = new \DirectoryIterator(CSVModule::getJobsFolderResource()->getFileName());
		$ret = array();
		foreach($dirIterator as $fileInfo) {
			/* @var $fileInfo \SplFileInfo */
			if($fileInfo->isFile() && !$fileInfo->isDot()) {
				$ret[] = $fileInfo->getFilename();
			}
		}
		return $ret;
	}
	/**
	 * get a job
	 * 
	 * @param type $id 
	 * 
	 * @return Job
	 */
	public static function getJobById($id)
	{
		self::validateJobId($id);
		$jobFilename = self::getJobFilename($id);
		if(file_exists($jobFilename)) {
			$try = unserialize(file_get_contents($jobFilename));
			if($try !== false && $try instanceof Job) {
				return $try;
			}
		}
	}
	private static function getJobFilename($id)
	{
		return CSVModule::getJobsFolderResource()->getFileName() . DIRECTORY_SEPARATOR . $id;
	}
	public static function deleteJob($id)
	{
		self::validateJobId($id);
		$job = self::getJobById($id);
		if($job) {
			$job->delete();
		}
	}
	/**
	 * clean up and remove all jobs 
	 */
	public static function clearJobs()
	{
		foreach(self::getJobIds() as $jobId) {
			self::deleteJob($jobId);
		}
	}
	/**
	 * prevent that someone screws us with an id
	 * 
	 * @param string $id 
	 */
	private static function validateJobId($id)
	{
		$jobFilename = self::getJobFilename($id);
		if(realpath(dirname($jobFilename)) != realpath(CSVModule::getJobsFolderResource()->getFileName())) {
			trigger_error('very nasty id' . $id, E_USER_ERROR);
		}
	}
}