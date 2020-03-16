<tr id="SalesInvoiceItem_<?= $row_id ?>">
	<td class="col-md-4 item">
		<?= Form::select('item_id', Input::post('item_id', isset($sales_invoice_item) ? $sales_invoice_item->item_id : ''),
						Model_Service_Item::listOptions(),
						array('class' => 'input-sm form-control')); ?>

		<?= Form::hidden('gl_account_id', Input::post('gl_account_id', isset($sales_invoice_item) ? $sales_invoice_item->gl_account_id : '')); ?>
	</td>
	<td class="col-md-2 qty">
		<?= Form::input('qty', Input::post('qty', isset($sales_invoice_item) ? $sales_invoice_item->qty : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>
	<td class='col-md-2 price'>
		<?= Form::input('unit_price', Input::post('unit_price', isset($sales_invoice_item) ? $sales_invoice_item->unit_price : ''),
						array('class' => 'input-sm form-control text-right')); ?>
	</td>
	<td class="col-md-2">
		<?= Form::input('discount_percent', Input::post('discount_percent', isset($sales_invoice_item) ? $sales_invoice_item->discount_percent : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>
	<td class='col-md-2 total'>
		<?= Form::input('amount', Input::post('amount', isset($sales_invoice_item) ? $sales_invoice_item->amount : ''),
						array('class' => 'input-sm form-control text-right', 'readonly' => true)); ?>
	</td>
</tr>
