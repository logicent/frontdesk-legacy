<table id="items" class="table table-hover">
	<thead>
		<tr>
			<th class="col-md-1 text-center">
				<?= Form::checkbox('select_all_rows', false, array('id' => 'select_all_rows')) ?>
			</th>
			<th class="col-md-5">Item</th>
			<th class="col-md-2">Qty</th>
			<th class="col-md-2">Price</th><!--
			<th>Disc %</th>-->
			<th class="col-md-2 text-right">Amount</th>
		</tr>
	</thead>
	<tbody id="item_detail">
<?php 
	if ($sales_order_items) : 
        foreach ($sales_order_items as $row_id => $item) :
			echo render('sales/order/item/_form', array('order_item' => $item, 'row_id' => $row_id));
        endforeach;
    else : ?>
        <tr id="no_data"><td class="text-muted text-center" colspan="5">No data</td></tr>
<?php
    endif ?>
	</tbody>
	<tfoot id="item_summary">
		<tr id="tr_subtotal">
			<td rowspan="3" colspan="3" style="border-right: 1px solid #dddddd"></td>
			<th class="text-right" style="border-right: 1px solid #dddddd"><span>Subtotal</span></th>
			<td class="text-right">
				<span id="subtotal"></span>
			</td>
		</tr>
		<tr id="tr_discount">
			<th class="text-right" style="border-right: 1px solid #dddddd"><span>Discount</span></th>
			<td class="text-right">
				<span id="discount"></span>
			</td>
		</tr><!--
		<tr id="tr_tax_total">
			<th class="text-right"><span>Vat</span></th>
			<td class="text-right">
				<span id="tax_total"></span>
			</td>
		</tr>-->
		<tr id="tr_grand_total">
			<th class="text-right" style="border-right: 1px solid #dddddd"><span>Total</span></th>
			<td class="text-right">
				<span id="grand_total"></span>
			</td>
		</tr>
	</tfoot>
</table>

<div class="form-group">
    <div class="col-md-6">
        <button id="del_item" data-url="/accounts/sales-order/del-item" class="btn btn-sm btn-danger" style="display: none;">Delete</button>
        <button id="add_item" data-url="/accounts/sales-order/add-item" class="btn btn-sm btn-default">Add item</button>
    </div>
	<!--
    <div class="col-md-6 text-right">
        <?php Form::hidden('amounts_tax_inc', Input::post('amounts_tax_inc', isset($sales_order) ? $sales_order->amounts_tax_inc : '0')); ?>
        <?php Form::checkbox('cb_amounts_tax_inc', null, array('class' => 'cb-checked', 'data-input' => 'amounts_tax_inc')); ?>
        <?php Form::label('Amount is VAT incl.', 'cb_amounts_tax_inc', array('class'=>'control-label')); ?>		
    </div>-->
</div>

<script>
$(window).on('load', function() 
{
	$('#add_item').on('click',
		function(e) {
			el_table_body = $('#items').find('tbody')
			last_row_id = el_table_body.find('tr').length

			$.ajax({
				url: $(this).data('url'),
				type: 'post',
				data: {
					'next_row_id': last_row_id + 1
				},
				success: function(response) {
					el_table_body.append(response);
					
					if (last_row_id == 1)
						$('#no_data').remove();
					
					el_checkbox_all = $('#select_all_rows > input');

					rowCount = $('#item_detail ' + ' tbody > tr').length;
					if (rowCount > 0)
						el_checkbox_all.css('display', '');
					else
						el_checkbox_all.css('display', 'none');
					
					// displaySelectAllCheckboxIf()
				},
				error: function(jqXhr, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			});
			// stops execution
			return false
		});

	function getLineTotal(el) 
	{
		el_tbody = el.closest('tbody');

		return el_tbody.find('.item-total > input');
	}

	function getLineInputs(el) 
	{
		el_table_row = el.closest('tr');
		el_item_description = el_table_row.find('td.item > input.item-description');
		el_item_qty = el_table_row.find('td.qty > input');
		el_item_price = el_table_row.find('td.price > input');
		el_item_total = el_table_row.find('td.item-total > input');

		el_item_total_display = el_table_row.find('td.item-total > span');

		return [el_item_qty, el_item_price, el_item_total, el_item_total_display, el_item_description];
	}

	// Re-calculate the Line item totals
	function recalculateLineTotal(line, item, lineTotalDisplay) 
	{
		line.val(
			(item.unit_price * item.qty).toFixed(2)
		);
		
		lineTotalDisplay.text(line.val()); 
	}

	// Re-calculate the Document totals
	function getDocTotalInputs() 
	{
		el_tfoot = $('tfoot#item_summary');
		el_subtotal = el_tfoot.find('#subtotal');
		el_taxtotal = el_tfoot.find('#tax_total');
		el_grandtotal = el_tfoot.find('#grand_total');

		return [el_subtotal, el_taxtotal, el_grandtotal];
	}

	function recalculateDocTotals(linesTotal, totals) 
	{
		sum_line_total = sum_vat_amount = 0;

		linesTotal.each(
			function() {
				line_total = $(this).val();
				if (line_total == '')
					return false;
				sum_line_total += parseFloat(line_total);

				// vat_amount = item_total * item.tax_rate / (1 + item.tax_rate);
				// sum_vat_amount += parseFloat(vat_amount);
			});

		totals[0].text(sum_line_total.toFixed(2));
		totals[1].text(0);
		totals[2].text(sum_line_total.toFixed(2));

		$('#form_amount_due').val(sum_line_total.toFixed(2));
		unpaidBalance = $('#form_amount_due').val() - $('#form_amount_paid').val();
		$('#form_balance_due').val(unpaidBalance.toFixed(2));
		// $('#form_tax_total').val(sum_vat_amount.toFixed(2));
	}

	// fetch line item detail
	$('#item_detail').on('change', '#form_item_id', 
		function() { 
			if ($(this).val() == '')
				return false;

			linesTotal = getLineTotal($(this));
			lineInputs = getLineInputs($(this));
			docTotalInputs = getDocTotalInputs();
			lineDesc = $(this).closest('.item-description');

			$.ajax({
				type: 'post',
				url: '/accounts/sales-order/get-item',
				data: {
					'item_id': $(this).val(),
				},
				success: function(item) 
				{
					item = JSON.parse(item);
					lineInputs[0].val(item.qty); // default is 1
					lineInputs[1].val(item.unit_price);
					recalculateLineTotal(lineInputs[2], item, lineInputs[3]);
					recalculateDocTotals(linesTotal, docTotalInputs);
					lineDesc.val(item.description);
				},
				error: function(jqXhr, textStatus, errorThrown) {
					console.log(errorThrown)
				}
			});
		});

	// update line and doc totals if qty/price changes
	$('tbody#item_detail').on('change', 'td.qty input, td.price input',
		function(e) {
			if ($(this).val() == '')
				return false;

			linesTotal = getLineTotal($(this));
			lineInputs = getLineInputs($(this));
			docTotalInputs = getDocTotalInputs();

			lineInputs[2].val((lineInputs[0].val() * lineInputs[1].val()).toFixed(2));
			lineInputs[3].text(lineInputs[2].val());
			recalculateDocTotals(linesTotal, docTotalInputs);
		});

	$('#select_all_rows').on('click',
		function(e) {
			select_all_rows = $(this).is(':checked');

			$('#item_detail .select-row > input').each(
				function(e) {
					if (select_all_rows)
						$(this).prop('checked', true);
					else
						$(this).prop('checked', false);
				});

			if (select_all_rows)
				$('#del_item').css('display', '');
			else
				$('#del_item').css('display', 'none');
		});

	$('tbody#item_detail').on('click', '.select-row > input',
		function(e) {
			selected_rows = $('.select-row > input:checked');
			selected_row = $(this).is(':checked');
			
			if (selected_row)
				$('#del_item').css('display', '');
			else {
				$('#select_all_rows').prop('checked', false);
				if (selected_rows.length == 0)
					$('#del_item').css('display', 'none');
			}
		});

	$('#del_item').on('click',
		function(e) {
			$(this).css('display', 'none');

			deleteUrl = $(this).data('url');

			$('td.select-row > input:checked').each(
				function(e) {
					el_table_row = $(this).closest('tr');
					el_id = el_table_row.find('td.select-row > .item-id');
					
					// delete row if only added in table but not persisted in DB
					if (el_id.val() == '')
					{
						$(this).closest('tr').remove();
					} 
					else
					{
						// delete row from persisted DB table and also from html table
						$.ajax({
							url: deleteUrl,
							type: 'post',
							data: {
								'id': el_id.val(),
							},
							success: function(response) {
								el_table_row.remove();

								// alert(response);

								// update totals fields

								// linesTotal = getLineTotal($(this));
								// lineInputs = getLineInputs($(this));
								// docTotalInputs = getDocTotalInputs();

								// lineInputs[2].val((lineInputs[0].val() * lineInputs[1].val()).toFixed(2));
								// lineInputs[3].text(lineInputs[2].val());
								// recalculateDocTotals(linesTotal, docTotalInputs);								
							},
							error: function(jqXhr, textStatus, errorThrown) {
								console.log(errorThrown);
							}
						});
					}
				});

			el_checkbox_all = $('th.select-all-rows > input');

			el_checkbox_all.prop('checked', false);

			rowCount = $('tbody#item_detail > tr').length;
			if (rowCount > 0)
				el_checkbox_all.css('display', '');
			else
				el_checkbox_all.css('display', 'none');
			// displaySelectAllCheckboxIf()

			// stops execution
			return false;
		});

	function displaySelectAllCheckboxIf() {
		countItemRows = $('tbody#item_detail > tr').length;
		if (countItemRows > 0)
			el_checkbox_all.css('display', '');
		else
			el_checkbox_all.css('display', 'none');
	}
});
</script>
