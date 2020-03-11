<h2>Viewing <span class='muted'>#<?php echo $hr_designation->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $hr_designation->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $hr_designation->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $hr_designation->description; ?></p>
<p>
	<strong>Enabled:</strong>
	<?php echo $hr_designation->enabled; ?></p>
<p>
	<strong>Reports to:</strong>
	<?php echo $hr_designation->reports_to; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_designation->fdesk_user; ?></p>

<?php echo Html::anchor('hr/designation/edit/'.$hr_designation->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/designation', 'Back'); ?>