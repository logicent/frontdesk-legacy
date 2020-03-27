<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Payment Method</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/payment/method/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($payment_methods): ?>
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
    <?php foreach ($payment_methods as $item): ?>	
        <tr>
            <td><?= Html::anchor('accounts/payment/method/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?></td>
            <td><?= (bool) $item->enabled ? 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' : 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' ?>
            </td>
            <td class="text-muted"><?= $item->code ?></td>
			<td class="text-center">
				<?= Html::anchor('accounts/payment/method/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
        </tr>
    <?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Payment method found.</p>

<?php endif; ?><p>
