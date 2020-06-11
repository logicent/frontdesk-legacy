<tr id="item_<?= $row_id ?>">
	<td class="col-md-1 text-center select-row">
		<?= Form::checkbox($row_id, false, array('value' => isset($invoice_item) ? $invoice_item->item_id : '')) ?>
		<?= Form::hidden("item[$row_id][id]", Input::post('id', isset($invoice_item) ? $invoice_item->id : ''),
						array('class' => 'item-id')); ?>
	</td>
	<td class="col-md-5 item">
		<?= Form::select("item[$row_id][item_id]", Input::post('item_id', isset($invoice_item) ? $invoice_item->item_id : ''),
						Model_Service_Item::listOptions(isset($invoice_item) ? $invoice_item->item_id : ''), 
						array('class' => 'input-sm form-control select-from-list')); ?>
		<?= Form::hidden("item[$row_id][description]", Input::post('description', isset($invoice_item) ? $invoice_item->description : ''),
						array('class' => 'item-description')); ?>
		<?= Form::hidden("item[$row_id][gl_account_id]", Input::post('gl_account_id', isset($invoice_item) ? $invoice_item->gl_account_id : '')); ?>
	</td>
	<td class="col-md-2 qty">
		<?= Form::input("item[$row_id][qty]", Input::post('qty', isset($invoice_item) ? 
						number_format($invoice_item->qty, 0, '.', '') : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>
	<td class='col-md-2 price'>
		<?= Form::input("item[$row_id][unit_price]", Input::post('unit_price', isset($invoice_item) ? 
						number_format($invoice_item->unit_price, 0, '.', '') : ''),
						array('class' => 'input-sm form-control text-right')); ?>
		<?= Form::hidden("item[$row_id][discount_percent]", Input::post('discount_percent', isset($invoice_item) ? 
						number_format($invoice_item->discount_percent, 0, '.', '') : '0'),
						array('class' => 'input-sm form-control')); ?>						
	</td>
	<td class='col-md-2 item-total text-number'>
		<span><?= number_format(isset($invoice_item) ? $invoice_item->amount : '0', 0) ?></span>
		<?= Form::hidden("item[$row_id][amount]", Input::post('amount', isset($invoice_item) ? $invoice_item->amount : '')); ?>						
	</td>
</tr>
