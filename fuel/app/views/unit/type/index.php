<div class="row">
	<div class="col-md-10">
		<h2>Listing <span class='text-muted'>Unit Types</span></h2>
        <p class="text-muted small">The unit type includes info on the number of persons, rates and more. One or more units can be added for each unit type.</p>
	</div>

	<div class="col-md-2">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('unit/type/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($unit_type): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Units</th>
			<th>Default/Max Pax</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($unit_type as $item): ?>		
        <tr>
			<td class="col-md-3">
                <?= Html::anchor('unit/type/edit/'.$item->id, $item->name, ['class' => 'clickable']); ?>
            </td>
            <td><?= (bool) $item->inactive == 1 ? 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' : 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' ?>
            </td>
			<td><?= count($item->units); ?></td>
			<td><?= $item->default_pax . '/' . $item->max_persons; ?></td>
			<td class="col-md-6 text-muted"><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('unit/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw icon-white"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Unit types found.</p>

<?php endif; ?>
