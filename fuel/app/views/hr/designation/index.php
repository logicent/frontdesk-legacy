<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Designation</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('hr/designation/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($hr_designations): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Reports to</th>
			<!--<th>Description</th>-->
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_designations as $item): ?>		
		<tr>
			<td>
                <?= Html::anchor('hr/designation/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?>
            </td>
            <td><?= (bool) $item->enabled ? 
                    '<i class="fa fa-circle-o fa-fw text-success"></i>Visible' : 
                    '<i class="fa fa-circle-o fa-fw text-danger"></i>Hidden' ?>
			</td>
			<td><?= !is_null($item->manager) ? $item->manager->name : null; ?></td>
			<!--<td class="col-md-4 text-muted"><?= $item->description; ?></td>-->
			<td class="text-muted"><?= $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('hr/designation/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>

<p>No Designation found.</p>

<?php endif; ?>