<?php

namespace Foomo\CSV\Frontend;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 * 
 */
class Controller
{
	/**
	 * @var Model
	 */
	public $model;
	public function actionDefault() {}
	public function actionRunJob($id)
	{
		$this->model->runJob = \Foomo\CSV\Jobs\Manager::getJobById($id);
	}
	public function actionDeleteJob($id)
	{
		\Foomo\CSV\Jobs\Manager::deleteJob($id);
		\Foomo\MVC::redirect('default');
	}
}