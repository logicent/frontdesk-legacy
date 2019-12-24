<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Cash Expenses</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('cash/payment/create', '<i class="fa fa-plus"></i>&ensp;Expense', array('class' => 'btn btn-primary pull-right')); ?>
	</div>
</div>
<hr>

<?php if ($cash_payments): ?>
<table class="table table-bordered table-hover table-striped datatable">
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
<?php foreach ($cash_payments as $item): ?>
		<tr>
			<td><?= $item->reference; ?></td>
			<td><?= date('d-M-Y', strtotime($item->date)); ?></td>
			<td><?= $item->payee; ?></td>
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<!-- <?php // Html::anchor('cash/payment/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?> -->
				<?= Html::anchor('cash/payment/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>'); ?>
				<?= Html::anchor('cash/payment/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>', array('class' => 'text-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Cash expenses.</p>
<?php endif; ?>
