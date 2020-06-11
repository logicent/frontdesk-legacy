<div class="row">
	<div class="col-md-6">
        <h2>Listing <span class='text-muted'>Orders</span>&ensp;
        <span class="btn-group list-filters">
            <?= Html::anchor('accounts/sales-order', 
                            'All', array('class' => "btn btn-sm btn-default", 'data-status' => '')); ?>
            <?= Html::anchor('accounts/sales-order/?status=' . Model_Sales_Order::ORDER_STATUS_OPEN, 'Open', 
                            array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Sales_Order::ORDER_STATUS_OPEN)); ?>
            <?= Html::anchor('accounts/sales-order/?status=' . Model_Sales_Order::ORDER_STATUS_CLOSED, 'Closed', 
                            array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Sales_Order::ORDER_STATUS_CLOSED)); ?>
            <?= Html::anchor('accounts/sales-order/?status=' . Model_Sales_Order::ORDER_STATUS_CANCELED, 'Canceled', 
                            array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Sales_Order::ORDER_STATUS_CANCELED)); ?>
		</span>
    </h2>
	</div>

	<div class="col-md-6 text-right">
        <br>
		<?= Html::anchor('sales/order/create', 'New', array('class' => 'btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($sales_orders): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Customer name</th>
			<th>Unit no.</th>
			<th>Order no.</th>
			<th>Due date</th>
			<th class="text-right">Amount due</th>
			<th class="text-right">Balance due</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_Orders as $item): ?>
		<tr>
            <td><?= Html::anchor('sales/order/edit/'. $item->id, ucwords($item->customer_name), ['class' => 'clickable']) ?></td>
			<td><?= Model_Sales_Order::getUnitName($item); ?></td>
			<td><?= $item->order_num; ?></td>
			<td><?= date('d-M-Y', strtotime($item->due_date)); ?></td>
			<td class="text-right"><?= number_format($item->amount_due, 2); ?></td>
			<td class="text-right"><span class="<?= $item->balance_due > 0 ? 'text-red' : '' ?>"><?= number_format($item->balance_due, 2); ?></span></td>
			<td class="text-center">
				<?= Html::anchor('sales/order/view/'.$item->id, '<i class="fa fa-file-o fa-fw"></i>'); ?>
				<?php if ($ugroup->id == 5) : ?>
				<?= Html::anchor('sales/order/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
				<?php endif ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No Sales Order found.</p>
<?php endif; ?>
