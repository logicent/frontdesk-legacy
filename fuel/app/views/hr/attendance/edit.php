<h2>Editing <span class='muted'>Hr_attendance</span></h2>
<br>

<?php echo render('hr/attendance/_form'); ?>
<p>
	<?php echo Html::anchor('hr/attendance/view/'.$hr_attendance->id, 'View'); ?> |
	<?php echo Html::anchor('hr/attendance', 'Back'); ?></p>
