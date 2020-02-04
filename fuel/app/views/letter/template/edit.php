<h2>Editing <span class='muted'>Template</span></h2>
<br>

<?php echo render('letter/template/_form'); ?>
<p>
	<?php echo Html::anchor('letter/template/view/'.$template->id, 'View'); ?> |
	<?php echo Html::anchor('letter/template', 'Back'); ?></p>
