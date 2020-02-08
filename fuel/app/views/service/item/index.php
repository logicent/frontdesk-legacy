<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Service items</span></h2>
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
			<th>Item</th>
			<th>Description</th>
			<th>Qty</th>
			<th>Unit price</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($service_items as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('service/item/edit/'.$item->id, $item->item, ['class' => 'clickable']); ?>
            </td>
			<td><?= $item->description; ?></td>
			<td><?= $item->qty; ?></td>
			<td><?= $item->unit_price; ?></td>
			<td class="text-center">
				<?= Html::anchor('service/item/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Service items found.</p>
<?php endif; ?>
