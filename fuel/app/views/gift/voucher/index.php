<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Voucher</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('gift/voucher/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($gift_vouchers): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Type</th>
			<th>Value</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($gift_vouchers as $item): ?>		
        <tr>
            <td><?= Html::anchor('gift/voucher/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?></td>
			<td><?= $item->is_redeemed; ?></td>
			<td><?= $item->type; ?></td>
			<td><?= $item->value; ?></td>
			<td><?= $item->code; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                        <?= Html::anchor('gift/voucher/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', 
                                        array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")) ?>
                    </div>
				</div>
			</td>            
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Gift Voucher found.</p>

<?php endif; ?>