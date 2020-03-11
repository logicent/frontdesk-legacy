<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Salary component</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('hr/salary/component/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($hr_salary_components): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Enabled</th>
			<th>Description</th>
			<th>Type</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_salary_components as $item): ?>
		<tr>
			<td><?= $item->name; ?></td>
			<td><?= $item->enabled; ?></td>
			<td><?= $item->description; ?></td>
			<td><?= $item->type; ?></td>
			<td><?= $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('hr/salary/component/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>

<p>No Salary component found.</p>

<?php endif; ?>