<h2>Editing <span class='muted'>Permission</span></h2>
<br>

<?php echo render('permission/_form'); ?>
<p>
	<?php echo Html::anchor('permission/view/'.$permission->id, 'View'); ?> |
	<?php echo Html::anchor('permission', 'Back'); ?></p>
