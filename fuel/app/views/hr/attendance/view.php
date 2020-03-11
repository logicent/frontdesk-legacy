<h2>Viewing <span class='muted'>#<?php echo $hr_attendance->id; ?></span></h2>

<p>
	<strong>Employee id:</strong>
	<?php echo $hr_attendance->employee_id; ?></p>
<p>
	<strong>Work day:</strong>
	<?php echo $hr_attendance->work_day; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $hr_attendance->status; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_attendance->fdesk_user; ?></p>

<?php echo Html::anchor('hr/attendance/edit/'.$hr_attendance->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/attendance', 'Back'); ?>