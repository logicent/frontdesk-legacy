<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Salary slip</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('hr/salary/slip/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($hr_salary_slips): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Designation</th>
			<th>Payroll period</th>
			<th>Date due</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_salary_slips as $item): ?>
		<tr>
			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->status; ?></td>
			<td><?php echo $item->designation; ?></td>
			<td><?php echo $item->payroll_period; ?></td>
			<td><?php echo $item->date_due; ?></td>
			<td><?php echo $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('hr/salary/slip/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>

<p>No Salary slip found.</p>

<?php endif; ?>