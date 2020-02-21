<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Property</span></h2>
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
			<th>Status</th>
			<th>Property type</th>
			<th>Owner</th>
			<th>Location</th>
			<th>Property ref</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($properties as $item): ?>
        <tr>
			<!--<td><?php // $item->code; ?></td>-->
            <td><?= Html::anchor('property/edit/'.$item->id, $item->name, array('class' => 'clickable')); ?></td>
            <td><?= (bool) $item->inactive == 1 ? 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' : 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' ?>
            </td>
			<td><?= Model_Property::listOptionsPropertyType()[$item->property_type]; ?></td>
			<td><?= $item->owner ? $item->propertyOwner->customer_name : ''; ?></td>
			<td><?= $item->map_location; ?></td>
			<td><?= $item->property_ref; ?></td>
			<td class="text-center">
				<?= Html::anchor('property/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Properties found.</p>

<?php endif; ?>
