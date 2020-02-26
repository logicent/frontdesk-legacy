<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Bank Deposit</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/bank/deposit/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>
	</div>
</div>
<hr>

<?php if ($bank_deposits): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Reference</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Bank account</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($bank_deposits as $item): ?>
		<tr>
			<td>
				<?= Html::anchor('accounts/bank/deposit/edit/'.$item->id, $item->reference, ['class' => 'clickable']); ?>
            </td>
			<td><?= $item->date; ?></td>
			<td><?= $item->amount; ?></td>
			<td><?= $item->bank_account->account_number; ?></td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('accounts/bank/deposit/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Bank deposit found.</p>
<?php endif; ?>
