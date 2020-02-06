<h2>Editing <span class='muted'>Template</span></h2>
<br>

<?php echo render('policy/template/_form'); ?>
<p>
	<?php echo Html::anchor('policy/template/view/'.$template->id, 'View'); ?> |
	<?php echo Html::anchor('policy/template', 'Back'); ?></p>
