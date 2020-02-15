<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Sales Invoices</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-group">
			<?= Html::anchor('accounts/sales-invoices/?status='.Model_Sales_Invoice::INVOICE_STATUS_OPEN, 'Open', array('class' => 'btn btn-sm btn-default')); ?>
			<?= Html::anchor('accounts/sales-invoices/?status='.Model_Sales_Invoice::INVOICE_STATUS_CLOSED, 'Closed', array('class' => 'btn btn-sm btn-default')); ?>
			<!-- <?= Html::anchor('accounts/sales-invoices/?status='.Model_Sales_Invoice::INVOICE_STATUS_CANCELED, 'Canceled', array('class' => 'btn btn-sm btn-danger')); ?> -->
		</div>
	</div>
</div>
<hr>

<?php if ($sales_invoices): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Guest name</th>
			<th>Unit no.</th>
			<th>Invoice no.</th>
			<th>Due date</th>
			<th>Amount due</th>
			<th>Balance due</th>
			<!--<th>&nbsp;</th>-->
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_invoices as $item): ?>
		<tr>
            <td><?= Html::anchor('accounts/salesinvoice/edit/'. $item->id, ucwords($item->guest->first_name .' '. $item->guest->last_name), ['class' => 'clickable']) ?></td>
			<td><?= $item->guest->unit->name; ?></td>
			<td><?= $item->invoice_num; ?></td>
			<td><?= date('d-M-Y', strtotime($item->due_date)); ?></td>
			<td class="text-right"><?= number_format($item->amount_due, 2); ?></td>
			<td class="text-right"><span class="<?= $item->balance_due > 0 ? 'text-red' : '' ?>"><?= number_format($item->balance_due, 2); ?></span></td>
			<!--<td class="text-center">
				<?php //echo Html::anchor('sales/invoice/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
				<?php //echo Html::anchor('sales/invoice/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>-->
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Sales Invoices found.</p>
<?php endif; ?>
