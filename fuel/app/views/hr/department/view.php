<h2>Viewing <span class='muted'>#<?php echo $hr_department->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $hr_department->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $hr_department->name; ?></p>
<p>
	<strong>Enabled:</strong>
	<?php echo $hr_department->enabled; ?></p>
<p>
	<strong>Parent id:</strong>
	<?php echo $hr_department->parent_id; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_department->fdesk_user; ?></p>

<?php echo Html::anchor('hr/department/edit/'.$hr_department->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/department', 'Back'); ?>