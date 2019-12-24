<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Cash Receipts</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?php //echo Html::anchor('cash/receipt/create', 'New Cash Receipt', array('class' => 'pull-right btn btn-info')); ?>
	</div>
</div>
<hr>

<?php if ($cash_receipts): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Reference</th>
			<th>Date</th>
			<th>Payer</th>
			<th>Amount</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($cash_receipts as $item): ?>
		<tr class="<?= $item->amount > 0 ? : 'strikeout text-muted' ?>">
			<td><?= $item->reference; ?></td>
			<td><?= date('d-M-Y', strtotime($item->date)); ?></td>
			<td><?= $item->payer; ?></td>
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<td class="text-center">
				<?php // Html::anchor('cash/receipt/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
				<?php if ($item->amount > 0) : ?>
					<?= Html::anchor('front-desk/receipts/to-print/'.$item->id, '<i class="fa fa-print fa-fw fa-lg"></i>', ['class' => 'text-muted', 'target' => '_blank']); ?>
				<?php endif; ?>
				<?php if ($item->amount > 0) : ?>
					<?= Html::anchor('cash/receipt/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>', ['class' => 'text-warning']); ?>
				<?php endif; ?>
				<?php if ($ugroup->id == 5 && $item->amount > 0) : ?>
					<?= Html::anchor('cash/receipt/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>', ['class' => 'text-danger', 'onclick' => "return confirm('Are you sure?')"]); ?>
				<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Cash receipts found.</p>
<?php endif; ?>
