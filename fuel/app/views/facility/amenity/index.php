<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Amenities</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('facility/amenity/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($amenities): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
            <th>Status</th>
            <th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($amenities as $item): ?>
        <tr>
            <td>
                <?= Html::anchor('facility/amenity/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?>
            </td>
            <td><?= (bool) $item->enabled ? 
                    '<i class="fa fa-circle-o fa-fw text-success"></i>Visible' : 
                    '<i class="fa fa-circle-o fa-fw text-danger"></i>Hidden' ?></td>
            <td class="text-muted"><?= $item->code ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                        <?= Html::anchor('facility/amenity/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', 
                                        array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")) ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Amenities found.</p>

<?php endif; ?>