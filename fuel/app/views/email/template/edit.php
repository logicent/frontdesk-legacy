<h2>Editing <span class='muted'>Template</span></h2>
<br>

<?php echo render('email/template/_form'); ?>
<p>
	<?php echo Html::anchor('email/template/view/'.$template->id, 'View'); ?> |
	<?php echo Html::anchor('email/template', 'Back'); ?></p>
