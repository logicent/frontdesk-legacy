<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Tenants</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('tenant/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($tenants): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Full name</th>
			<th>Status</th>
			<th>Phone</th>
			<!-- <th>Active Leases</th> -->
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tenants as $item): ?>
        <tr>
            <td><?= Html::anchor('tenant/edit/'.$item->id, $item->customer_name, array('class' => 'clickable')) ?></td>
            <td><?= (bool) $item->inactive == 1 ? 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' : 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' ?>
            </td>
            <td><?= $item->mobile_phone ?></td>
            <!-- <td><?php // $item->activeLeases ?></td> -->
			<td class="text-center">
            <?php if ($ugroup->id == 5) : ?>
				<?= Html::anchor('tenant/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
            <?php endif ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Tenants.</p>

<?php endif; ?>
