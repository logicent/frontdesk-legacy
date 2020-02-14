<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Service types</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('service/type/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($service_types): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Code</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($service_types as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('service/item/edit/'.$item->id, $item->item, ['class' => 'clickable']); ?>
            </td>
			<td><?= $item->code; ?></td>
			<td><?= $item->name; ?></td>
			<td class="text-center">
				<?= Html::anchor('service/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Service types found.</p>
<?php endif; ?>
