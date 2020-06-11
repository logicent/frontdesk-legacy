<tr id="item_<?= $row_id ?>">
	<td class="col-md-6 item">
		<?= Form::label($invoice_item->item_id, '', array('class' => 'input-sm form-control')) ?>
		<?= Form::label($invoice_item->description, '', array('class' => 'item-description')) ?>
	</td>
	<td class="col-md-2 qty">
		<?= Form::label(number_format($invoice_item->qty, 0), '', array('class' => 'input-sm form-control')) ?>
	</td>
	<td class='col-md-2 price text-right'>
		<?= Form::label(number_format($invoice_item->unit_price, 2), '', array('class' => 'input-sm form-control')) ?>
	</td>
	<td class='col-md-2 item-total text-number'>
		<span><?= number_format($invoice_item->amount, 2) ?></span>
	</td>
</tr>
