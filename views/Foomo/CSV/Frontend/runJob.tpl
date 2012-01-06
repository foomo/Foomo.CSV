<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\CSV\Frontend\Model */
?>
<?= $view->partial('header') ?>
<table>
		<thead>
			<tr>
				<? foreach($model->runJob->parser->getHeader() as $label): ?>
					<th><?= $view->escape($label) ?></th>
				<? endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<? 
				foreach($model->runJob->parser as $line): 
					$validation = $model->runJob->validator->validate($line);
			?>
				<tr>
					<? foreach($validation as $column => $validatedFields):
						$lastValidation = $validatedFields[count($validatedFields)-1]; 
						//var_dump($lastValidation);
					?>
						<td class="<?= ($lastValidation->valid?'valid':'inValid') ?>" title="<?= $view->escape($lastValidation->report) ?>">
							<? foreach($validatedFields as $validatedField): ?>
								<?= $view->escape($validatedField->raw) ?>
							<? endforeach; ?>
						</td>
					<? endforeach; ?>
				</tr>
			<? endforeach; ?>
		</tbody>
</table>
<?= $view->partial('footer') ?>