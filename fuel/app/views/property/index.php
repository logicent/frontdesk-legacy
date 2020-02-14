<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Properties</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('property/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($properties): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<!--<th>Code</th>-->
			<th>Name</th>
			<th>Inactive</th>
			<th>Location</th>
			<th>Property type</th>
			<th>Owner</th>
			<th>Property ref</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($properties as $item): ?>		
        <tr>
			<!--<td><?php // $item->code; ?></td>-->
            <td><?= Html::anchor('property/edit/'.$item->id, $item->name, array('class' => 'clickable')); ?></td>
			<td><?= $item->inactive; ?></td>
			<td><?= $item->map_location; ?></td>
			<td><?= $item->property_type; ?></td>
			<td><?= $item->owner; ?></td>
			<td><?= $item->property_ref; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">				
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Properties found.</p>

<?php endif; ?>
