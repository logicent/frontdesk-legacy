<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Bank Deposits</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/bank/deposit/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>
	</div>
</div>
<hr>

<?php if ($bank_receipts): ?>
<table class="table table-bordered table-hover table-striped datatable">
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
<?php foreach ($bank_receipts as $item): ?>
		<tr>
			<td><?= $item->reference; ?></td>
			<td><?= $item->date; ?></td>
			<td><?= $item->amount; ?></td>
			<td><?= $item->bank_account_id; ?></td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<!-- <?php // Html::anchor('bank/receipt/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?> -->
				<?= Html::anchor('bank/receipt/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>'); ?>
				<?= Html::anchor('bank/receipt/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Bank deposit.</p>
<?php endif; ?>
