<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$formHtml = HtmlView::formHtml($view);
	
	$scalarEiProperties = $view->getParam('scalarEiProperties');
	$csvPropertyNames = $view->getParam('csvPropertyNames');
	$assignationJsonArr = $view->getParam('assignationJsonArr');
?>

<table class="rocket-list">
	<thead>
	<tr>
		<th></th>
		<?php foreach ($csvPropertyNames as $csvPropName): ?>
			<th><?php $html->out($csvPropName) ?></th>
		<?php endforeach ?>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($scalarEiProperties as $scalarEiProperty): ?>
		<?php $scalarEiPropertyFieldPath = $scalarEiProperty->getEiPropPath() ?>
		<tr>
			<th>
				<?php $html->out((string) $scalarEiProperty->getLabelLStr()) ?>
			</th>
			<?php foreach ($csvPropertyNames as $csvPropName): ?>
				<td>
					<?php if ($assignationJsonArr === null
							&& strpos(strtolower($csvPropName), strtolower((string) $scalarEiProperty->getLabelLStr())) > -1): ?>
						<?php $formHtml->inputRadio('assignationMap[' . $csvPropName. ']',
							(string) $scalarEiPropertyFieldPath, array('checked' => 1)) ?>
					<?php elseif ($assignationJsonArr !== null
						&& isset($assignationJsonArr[$csvPropName])
						&& $assignationJsonArr[$csvPropName] === (string) $scalarEiProperty->getEiPropPath()): ?>

						<?php $formHtml->inputRadio('assignationMap[' . $csvPropName. ']',
							(string) $scalarEiPropertyFieldPath, array('checked' => 1)) ?>
					<?php else: ?>
						<?php $formHtml->inputRadio('assignationMap[' . $csvPropName. ']',
							(string) $scalarEiPropertyFieldPath) ?>
					<?php endif ?>
				</td>
			<?php endforeach ?>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>