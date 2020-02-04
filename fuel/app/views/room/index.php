<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Rooms</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('room/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($room): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Room type</th>
			<th>Status</th>
			<!--<th>HK Status</th>-->
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($room as $item): ?>
		<tr>
			<td><?= $item->name; ?></td>
			<td><?= $item->rm_type->name; ?></td>
			<td><span class=""><?= strtoupper($item->status); ?></span></td>
			<!--<td><?php //echo $item->hk_status; ?></td>-->
			<td class="text-center">
				<?= Html::anchor('room/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>'); ?>
				<?= Html::anchor('room/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg fa-fw fa-lg"></i>',
										array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Rooms found.</p>
<?php endif; ?>
