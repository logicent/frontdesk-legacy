<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Customers</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('customer/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($customers): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Full name</th>
			<th>Status</th>
			<th>Type</th>
			<th>Group</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($customers as $item): ?>
        <tr>
            <td><?= Html::anchor('customer/edit/'.$item->id, $item->customer_name, array('class' => 'clickable')) ?></td>
            <td><?= (bool) $item->inactive == 1 ? 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' : 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' ?>
            </td>
            <td><?= $item->customer_type ?></td>
            <td><?= $item->customer_group ?></td>
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
<p>No Customers.</p>

<?php endif; ?>
