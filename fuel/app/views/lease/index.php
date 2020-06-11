<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Leases</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('lease/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($leases): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Title</th>
			<th>Status</th>
			<th>Tenant</th>
			<th>Unit</th>
			<th>Reference</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($leases as $item): ?>		
        <tr>
			<td><?= Html::anchor('lease/edit/'.$item->id, $item->title, array('class' => 'clickable')); ?></td>
			<td><?= $item->status; ?></td>
			<td><?= $item->customer->customer_name; ?></td>
			<td><?= $item->unit->name; ?></td>
			<td><?= $item->reference; ?></td>
			<td class="text-center">
            <?php if ($ugroup->id == 5) : ?>
				<?= Html::anchor('lease/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			<?php endif ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Lease found.</p>

<?php endif; ?>