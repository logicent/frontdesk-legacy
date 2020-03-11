<h2>Viewing <span class='muted'>#<?php echo $hr_salary_slip->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $hr_salary_slip->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $hr_salary_slip->name; ?></p>
<p>
	<strong>Employee id:</strong>
	<?php echo $hr_salary_slip->employee_id; ?></p>
<p>
	<strong>Designation:</strong>
	<?php echo $hr_salary_slip->designation; ?></p>
<p>
	<strong>Start date:</strong>
	<?php echo $hr_salary_slip->start_date; ?></p>
<p>
	<strong>End date:</strong>
	<?php echo $hr_salary_slip->end_date; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $hr_salary_slip->status; ?></p>
<p>
	<strong>Date posted:</strong>
	<?php echo $hr_salary_slip->date_posted; ?></p>
<p>
	<strong>Date due:</strong>
	<?php echo $hr_salary_slip->date_due; ?></p>
<p>
	<strong>Payroll period:</strong>
	<?php echo $hr_salary_slip->payroll_period; ?></p>
<p>
	<strong>Total deductions:</strong>
	<?php echo $hr_salary_slip->total_deductions; ?></p>
<p>
	<strong>Total earnings:</strong>
	<?php echo $hr_salary_slip->total_earnings; ?></p>
<p>
	<strong>Total gross:</strong>
	<?php echo $hr_salary_slip->total_gross; ?></p>
<p>
	<strong>Net amount:</strong>
	<?php echo $hr_salary_slip->net_amount; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?php echo $hr_salary_slip->fdesk_user; ?></p>

<?php echo Html::anchor('hr/salary/slip/edit/'.$hr_salary_slip->id, 'Edit'); ?> |
<?php echo Html::anchor('hr/salary/slip', 'Back'); ?>