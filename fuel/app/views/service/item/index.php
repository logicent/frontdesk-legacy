<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Services</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('service/item/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($service_items): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Description</th>
			<th>Status</th>
			<th>Qty</th>
			<th>Unit price</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($service_items as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('service/item/edit/'.$item->id, $item->description, ['class' => 'clickable']); ?>
            </td>
            <td><?= (bool) $item->enabled ? 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' :
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' ?> 
            </td>
			<td><?= $item->qty; ?></td>
			<td><?= $item->unit_price; ?></td>
			<td><?= $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('service/item/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Services found.</p>
<?php endif; ?>
