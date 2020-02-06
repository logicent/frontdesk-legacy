<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Rates</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('rate/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($rate): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Type</th>
			<th>Rate</th>
			<th>Charges / night</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rate as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('rate/edit/'.$item->id, $item->room_type->name); ?>
            </td>
			<td><?= $item->rate_type->name; ?></td>
			<td class="text-right"><?= number_format($item->charges, 2); ?></td>
			<td class="text-center">
				<?= Html::anchor('rate/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
										array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Rates found.</p>
<?php endif; ?>
