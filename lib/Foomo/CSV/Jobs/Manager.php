<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV\Jobs;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Manager
{
	public static function addJob(Job $job)
	{
		$job->persist();
	}
	public static function getJobs()
	{
		// loop in jobs directory
	}
	/**
	 *
	 * @param type $id 
	 * @return Job
	 */
	public static function getJobById($id)
	{
		
	}
	public static function deleteJob($id)
	{
		$job = self::getJobById($id);
		if($job) {
			$job->delete();
		}
	}
}