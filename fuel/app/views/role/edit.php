<h2>Editing <span class='muted'>Role</span></h2>
<br>

<?php echo render('role/_form'); ?>
<p>
	<?php echo Html::anchor('role/view/'.$role->id, 'View'); ?> |
	<?php echo Html::anchor('role', 'Back'); ?></p>
