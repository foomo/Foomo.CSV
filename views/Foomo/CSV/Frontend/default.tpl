<?php

?>
<?= $view->partial('header') ?>
<h2>Jobs</h2>
<table>
	<thead>
		<tr>
			<th>
				id
			</th>
			<th>
				comment
			</th>
			<th>
				actions
			</th>
		</tr>
	</thead>
	<tbody>
		<? 
			foreach (\Foomo\CSV\Jobs\Manager::getJobIds() as $jobId): 
				$job = \Foomo\CSV\Jobs\Manager::getJobById($jobId);
		?>
			<tr>
				<td>
					<?= $view->escape($job->getId()) ?>
				</td>
				<td>
					<?= $view->escape($job->comment) ?>
				</td>
				<td>
					<?= $view->link('run', 'runJob', array($jobId)) ?> <br>
					<?= $view->link('delete', 'deleteJob', array($jobId)) ?>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<?= $view->partial('footer') ?>