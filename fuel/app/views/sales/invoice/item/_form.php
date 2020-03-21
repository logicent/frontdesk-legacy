<tr id="InvoiceItem_<?= $row_id ?>">
	<td class="col-md-1 text-center select-row">
		<?= Form::checkbox($row_id, false, array('value' => isset($invoice_item) ? $invoice_item->item_id : '')) ?>
	</td>
	<td class="col-md-5 item">
		<?= Form::select('item_id', Input::post('item_id', isset($invoice_item) ? $invoice_item->item_id : ''),
						Model_Service_Item::listOptions(), array('class' => 'input-sm form-control')); ?>
		<?= Form::hidden('gl_account_id', Input::post('gl_account_id', isset($invoice_item) ? $invoice_item->gl_account_id : '')); ?>
	</td>
	<td class="col-md-2 qty">
		<?= Form::input('qty', Input::post('qty', isset($invoice_item) ? $invoice_item->qty : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>
	<td class='col-md-2 price'>
		<?= Form::input('unit_price', Input::post('unit_price', isset($invoice_item) ? $invoice_item->unit_price : ''),
						array('class' => 'input-sm form-control text-right')); ?>
	</td><!--
	<td class="col-md-1">
		<?php Form::input('discount_percent', Input::post('discount_percent', isset($invoice_item) ? $invoice_item->discount_percent : ''),
						array('class' => 'input-sm form-control')); ?>
	</td>-->
	<td class='col-md-2 item-total text-right'>
		<span><?= number_format(isset($invoice_item) ? $invoice_item->amount : '0', 2) ?></span>
		<?= Form::hidden('amount', Input::post('amount', isset($invoice_item) ? $invoice_item->amount : '')); ?>						
	</td>
</tr>
