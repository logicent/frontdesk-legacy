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
<table class="table table-striped">
	<thead>
		<tr>
            <th>Code</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($amenities as $item): ?>
        <tr>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?= Html::anchor('facility/amenity/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('facility/amenity/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('facility/amenity/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
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