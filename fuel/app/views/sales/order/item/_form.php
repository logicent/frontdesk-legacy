<tr id="InvoiceItem_<?= $row_id ?>">
	<td class="col-md-1 text-center select-row">
		<?= Form::checkbox($row_id, false, array('value' => isset($invoice_item) ? $invoice_item->item_id : '')) ?>
		<?= Form::hidden("id[$row_id]", Input::post('id', isset($invoice_item) ? $invoice_item->id : ''),
						array('class' => 'item-id')); ?>
	</td>

	<td class="col-md-5 item">
		<?= Form::select("item_id[$row_id]", Input::post('item_id', isset($invoice_item) ? $invoice_item->item_id : ''),
						Model_Service_Item::listOptions(), array('class' => 'input-sm form-control select-from-list')); ?>
		<?= Form::hidden("description[$row_id]", Input::post('description', isset($invoice_item) ? $invoice_item->description : ''),
						array('class' => 'item-description')); ?>
		<?= Form::hidden("gl_account_id[$row_id]", Input::post('gl_account_id', isset($invoice_item) ? $invoice_item->gl_account_id : '')); ?>
	</td>

	<td class="col-md-2 qty">
		<?= Form::input("qty[$row_id]", Input::post('qty', isset($invoice_item) ? $invoice_item->qty : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>

	<td class='col-md-2 price'>
		<?= Form::input("unit_price[$row_id]", Input::post('unit_price', isset($invoice_item) ? $invoice_item->unit_price : ''),
						array('class' => 'input-sm form-control text-right')); ?>
		
		<?= Form::hidden("discount_percent[$row_id]", Input::post('discount_percent', isset($invoice_item) ? $invoice_item->discount_percent : '0'),
						array('class' => 'input-sm form-control')); ?>						
	</td>
	<!--
	<td class="col-md-1">
	</td>-->
	<td class='col-md-2 item-total text-right'>
		<span><?= number_format(isset($invoice_item) ? $invoice_item->amount : '0', 2) ?></span>
		<?= Form::hidden("amount[$row_id]", Input::post('amount', isset($invoice_item) ? $invoice_item->amount : '')); ?>						
	</td>
</tr>
