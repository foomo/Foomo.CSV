<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\CSV\Frontend\Model */
?>
<?= $view->partial('header') ?>
<? if($model->runJob): ?>
	<table>
			<thead>
				<tr>
					<? foreach($model->runJob->parser->getHeader() as $label): ?>
						<th><?= $view->escape($label) ?></th>
					<? endforeach; ?>
						<th>line validation</th>
				</tr>
			</thead>
			<tbody>
				<? 
					foreach($model->runJob->parser as $line): 
						$lineValidation = $model->runJob->validator->validate($line);
				?>
					<tr title="<?= $view->escape($lastValidation->report) ?>">
						<? foreach($lineValidation->fields as $column => $validatedFields):
							$lastValidation = $validatedFields[count($validatedFields)-1]; 
							//var_dump($lastValidation);
						?>
							<td class="<?= ($lastValidation->valid?'valid':'inValid') ?> ">
								<? foreach($validatedFields as $validatedField): ?>
									<?= $view->escape($validatedField->raw) ?>
								<? endforeach; ?>
							</td>
						<? endforeach; ?>
							<td class="<?= $lineValidation->valid?'validLine':'inValidLine' ?>">
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