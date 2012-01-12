<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\CSV\Frontend\Model */
?>
<?= $view->partial('header') ?>
<? if($model->runJob): ?>
	<table>
			<thead>
				<tr>
					<th>line</th>
					<? foreach($model->runJob->parser->getHeader() as $label): ?>
						<th><?= $view->escape($label) ?></th>
					<? endforeach; ?>
						<th>line validation</th>
				</tr>
			</thead>
			<tbody>
				<? 
					$lineCounter = 0;
					foreach($model->runJob->parser as $line): 
						$lineCounter ++;
						$lineValidation = $model->runJob->validator->validate($line);
				?>
					<tr title="<?= $view->escape($lastValidation->report) ?>" class="<?= $lineValidation->valid?'validLine':'inValidLine' ?>">
						<td><?= $lineCounter  ?></td>
						<? foreach($lineValidation->fields as $column => $validatedFields):
							$lastValidation = $validatedFields[count($validatedFields)-1];
						?>
							<td class="<?= ($lastValidation->valid?'valid':'inValid') ?> ">
								<? foreach($validatedFields as $validatedField): ?>
									<?= $view->escape($validatedField->raw) ?>
								<? endforeach; ?>
							</td>
						<? endforeach; ?>
							<td>
								<?= $view->escape($lineValidation->report) ?>
							</td>
					</tr>
				<? endforeach; ?>
			</tbody>
	</table>
<? else: ?>
	<p>No Job selected or job expired</p>
<? endif; ?>

<?= $view->partial('footer') ?>