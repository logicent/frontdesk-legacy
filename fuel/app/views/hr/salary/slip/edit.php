<h2>Editing <span class='muted'>Hr_salary_slip</span></h2>
<br>

<?php echo render('hr/salary/slip/_form'); ?>
<p>
	<?php echo Html::anchor('hr/salary/slip/view/'.$hr_salary_slip->id, 'View'); ?> |
	<?php echo Html::anchor('hr/salary/slip', 'Back'); ?></p>
