<h2>Viewing <span class='muted'>#<?php echo $hr_salary_component->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $hr_salary_component->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $hr_salary_component->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $hr_salary_component->description; ?></p>
<p>
	<strong>Enabled:</strong>
	<?php echo $hr_salary_component->enabled; ?></p>
<p>
	<strong>Is payable:</strong>
	<?php echo $hr_salary_component->is_payable; ?></p>
<p>
	<strong>Is tax applicable:</strong>
	<?php echo $hr_salary_component->is_tax_applicable; ?></p>
<p>
	<strong>Depends on payment days:</strong>
	<?php echo $hr_salary_component->depends_on_payment_days; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $hr_salary_component->type; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_salary_component->fdesk_user; ?></p>

<?php echo Html::anchor('hr/salary/component/edit/'.$hr_salary_component->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/salary/component', 'Back'); ?>