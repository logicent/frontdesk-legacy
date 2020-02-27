<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Units</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('unit/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($unit): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Unit type</th>
			<th>Status</th>
			<th>HK Status</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($unit as $item): ?>
		<tr>
			<td><?= Html::anchor('unit/edit/'.$item->id,  $item->type->alias . ' ' . $item->name, ['class' => 'clickable']); ?></td>
			<td><?= $item->type->name; ?></td>
			<td><span class=""><?= Model_Unit::$unit_status[$item->status] ?></span></td>
			<td><?= Model_Unit::$hk_status[$item->hk_status] ?></td>
			<td class="text-center">
				<?= Html::anchor('unit/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Units found.</p>
<?php endif; ?>
