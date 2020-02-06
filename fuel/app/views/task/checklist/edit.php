<h2>Editing <span class='muted'>Checklist</span></h2>
<br>

<?php echo render('task/checklist/_form'); ?>
<p>
	<?php echo Html::anchor('task/checklist/view/'.$checklist->id, 'View'); ?> |
	<?php echo Html::anchor('task/checklist', 'Back'); ?></p>
