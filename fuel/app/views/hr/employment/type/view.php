<h2>Viewing <span class='muted'>#<?php echo $hr_employment_type->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $hr_employment_type->code; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $hr_employment_type->description; ?></p>
<p>
	<strong>Enabled:</strong>
	<?php echo $hr_employment_type->enabled; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_employment_type->fdesk_user; ?></p>

<?php echo Html::anchor('hr/employment/type/edit/'.$hr_employment_type->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/employment/type', 'Back'); ?>