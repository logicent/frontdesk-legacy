<div class="row">
	<div class="col-md-10">
		<h2>Listing <span class='text-muted'>Room Types</span></h2>
        <p class="text-muted small">The room type includes information as to the number of beds, price and more. One or more units can be added for each room type.</p>
	</div>

	<div class="col-md-2">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('room/type/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($room_type): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Rooms</th>
			<th>Reg/Max Pax</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($room_type as $item): ?>		
        <tr>
			<td class="col-md-3">
                <?= Html::anchor('room/type/edit/'.$item->id, $item->name, ['class' => 'clickable']); ?>
            </td>
			<td><?php // $item->description; ?></td>
			<td><?php // $item->description; ?></td>
			<td><?php // $item->description; ?></td>
			<td class="text-muted"><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('room/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw icon-white"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Room types found.</p>

<?php endif; ?>
