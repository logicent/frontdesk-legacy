<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Expenses</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/payment/expense/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>
	</div>
</div>
<hr>

<?php if ($expenses): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Reference</th>
			<th>Date</th>
			<th>Payee</th>
			<th>Amount</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($expenses as $item): ?>
		<tr>
			<td>
				<?= Html::anchor('accounts/payment/expense/edit/'.$item->id, $item->reference, ['class' => 'clickable']); ?>
            </td>
            <td><?= date('d-M-Y', strtotime($item->date)); ?></td>
			<td><?= $item->payee; ?></td>
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('accounts/payment/expense/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Expenses found.</p>
<?php endif; ?>
