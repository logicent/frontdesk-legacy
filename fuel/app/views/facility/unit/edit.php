<h2>Editing <span class='muted'>Unit</span></h2>
<br>

<?php echo render('facility/unit/_form'); ?>
<p>
	<?php echo Html::anchor('facility/unit/view/'.$unit->id, 'View'); ?> |
	<?php echo Html::anchor('facility/unit', 'Back'); ?></p>
