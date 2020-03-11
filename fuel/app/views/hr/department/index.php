<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Department</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('hr/department/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($hr_departments): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Belongs to</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_departments as $item): ?>
		<tr>
            <td>
                <?= Html::anchor('hr/department/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?>
            </td>			
            <td><?= (bool) $item->enabled ? 
                    '<i class="fa fa-circle-o fa-fw text-success"></i>Visible' : 
                    '<i class="fa fa-circle-o fa-fw text-danger"></i>Hidden' ?>
			</td>
			<td><?= !is_null($item->parent) ? $item->parent->name : null; ?></td>
			<td class="text-muted"><?= $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('hr/department/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Department found.</p>

<?php endif; ?>
