<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Payments</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/payment/receipt/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($payment_receipts): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Receipt / Trans Ref.</th>
			<th>Date</th>
			<th>Payer</th>
			<th class="text-right">Amount</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($payment_receipts as $item): ?>
		<tr>
			<td>
				<?= Html::anchor('accounts/payment/receipt/edit/'.$item->id, 
								$item->receipt_number . '&nbsp;/&nbsp;' . $item->reference, 
								['class' => 'clickable']); ?>
            </td>
			<td><?= date('d-M-Y', strtotime($item->date)); ?></td>
			<td><?= $item->payer; ?></td>
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<td class="text-center">
				<?php // Html::anchor('cash/receipt/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
                <?php 
                // Should depend on $item->status = Accounts_Sales_Payment_Receipt::PAID
                if ($item->amount > 0) : ?>
					<?= Html::anchor('accounts/payment/receipt/to-print/'.$item->id, '<i class="fa fa-print fa-fw"></i>', ['class' => 'text-muted', 'target' => '_blank']); ?>
				<?php endif; ?>
				<?php // if ($ugroup->id == 5 && $item->amount > 0) : ?>
					<?php // Html::anchor('accounts/payment/receipt/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', ['class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')"]); ?>
				<?php // endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Sales receipt found.</p>
<?php endif; ?>
