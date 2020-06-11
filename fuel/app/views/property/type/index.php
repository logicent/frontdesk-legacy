<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Property Type</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('property/type/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>
<?php if ($property_types): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
            <th>Description</th>
            <th>Status</th>
            <th>Group</th>
            <th>Code</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($property_types as $item): ?>
        <tr>
            <td>
                <?= Html::anchor('property/type/edit/'.$item->id, $item->name, ['class' => 'clickable']); ?>
            </td>
            <td>
				<?= (bool) $item->enabled ? 
					'<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' :
					'<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' ?> 
            </td>
			<td><?= $item->group ?></td>
			<td class="text-muted"><?= $item->code ?></td>
			<td class="text-center">
				<?= Html::anchor('property/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
								array(
									'class' => 'text-muted del-btn', 
									// 'method' => 'post',
									'onclick' => "return confirm('Are you sure?')")
								) ?>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>
<?php else: ?>
<p>No Property type found.</p>
<?php endif ?>