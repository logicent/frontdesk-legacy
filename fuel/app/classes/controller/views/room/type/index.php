<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Room Types</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('room/type/create', '<i class="fa fa-plus"></i>&ensp;Type', array('class' => 'btn btn-primary')); ?>
			</div>
			<?php if($ugroup->id == 6 || $ugroup->id == 5) : ?>
			<div class="btn-group">
				<?= Html::anchor('room', '<i class="fa fa-th-list"></i>&ensp;Rooms', array('class' => 'btn btn-danger')); ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>
<hr>

<?php if ($room_type): ?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($room_type as $item): ?>		<tr>

			<td><?= $item->name; ?></td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('room/type/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>',
										array('class' => 'btn btn-sm')); ?>
				<?= Html::anchor('room/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg icon-white"></i>',
										array('class' => 'text-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Room types found.</p>

<?php endif; ?>
