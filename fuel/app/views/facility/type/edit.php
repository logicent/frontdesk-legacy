<h2>Editing <span class='muted'>Type</span></h2>
<br>

<?php echo render('facility/type/_form'); ?>
<p>
	<?php echo Html::anchor('facility/type/view/'.$type->id, 'View'); ?> |
	<?php echo Html::anchor('facility/type', 'Back'); ?></p>
