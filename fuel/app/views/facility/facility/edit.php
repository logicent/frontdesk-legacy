<h2>Editing <span class='muted'>Facility</span></h2>
<br>

<?php echo render('facility/facility/_form'); ?>
<p>
	<?php echo Html::anchor('facility/facility/view/'.$facility->id, 'View'); ?> |
	<?php echo Html::anchor('facility/facility', 'Back'); ?></p>
