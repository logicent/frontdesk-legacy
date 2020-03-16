<table id="items" class="table table-hover">
	<thead>
		<tr>
			<th>Item</th>
			<!--<th>Gl account</th>-->
			<th>Qty</th>
			<th>Price</th>
			<th>Discount %</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody id="item_detail">
<?php 
    if ($sales_invoice_items):
        foreach ($sales_invoice_items as $item): ?>
		<tr>
			<td class="col-md-4 item">
				<?= Form::select('item_id', Input::post('item_id', $item->item_id), Model_Service_Item::listOptions(), 
								array('class' => 'input-sm form-control')); ?>
				<?= Form::hidden('gl_account_id', Input::post('gl_account_id', $item->gl_account_id)) ?>				
			</td>
			<td class="col-md-2 qty">
				<?= Form::input('qty', Input::post('qty', $item->qty), array('class' => 'input-sm form-control')); ?>
			</td>
			<td class='col-md-2 price'>
				<?= Form::input('unit_price', Input::post('unit_price', $item->unit_price), 
								array('class' => 'input-sm form-control text-right')); ?>
			</td>
			<td class="col-md-2">
				<?= Form::input('discount_percent', Input::post('discount_percent', $item->discount_percent),
								array('class' => 'input-sm form-control')); ?>
			</td>
			<td class='col-md-2 total'>
				<?= Form::input('amount', Input::post('amount', $item->amount),
								array('class' => 'input-sm form-control text-right', 'readonly' => true)); ?>
			</td>
		</tr>
    <?php 
        endforeach;
    else : ?>
        <tr id="no_data"><td class="text-muted text-center" colspan="5">No data</td></tr>
<?php
    endif ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" class='text-right'>
                <span class="text-muted">Total:</span>
			</th>
			<td class='col-md-2'>
                <?= Form::input('total_amount', '', array('id' => 'subtotal_amount', 'class' => 'input-sm form-control text-right', 'readonly' => true)); ?>
			</td>
		</tr>
	</tfoot>
</table>

<div class="form-group">
    <div class="col-md-6">
        <button id="add_item" data-url="add_item" class="btn btn-xs btn-default">Add item</button>
    </div>

    <div class="col-md-6 text-right">
        <?= Form::checkbox('amounts_tax_inc', Input::post('amounts_tax_inc', isset($sales_invoice) ? $sales_invoice->amounts_tax_inc : '0')); ?>
        <?= Form::label('Amount is VAT incl.', 'amounts_tax_inc'); ?>
    </div>
</div>

<script>
$('#add_item').on('click',
    function(e) {
        el_table_body = $('#items').find('tbody')
		last_row_id = el_table_body.find('tr').length

        $.ajax({
            url: '/accounts/sales-invoice/add-item',
            type: 'post',
            data: {
                'last_row_id': last_row_id
            },
            success: function(response) {
				// console.log(response);
				el_table_body.append(response);
				
				if (last_row_id == 1)
					$('#no_data').remove();
				
                // el_checkbox_all = $(sales_order.table_id + ' th.select-all-rows > input');

                // rowCount = $(sales_order.table_id + ' tbody > tr').length;
                // if (rowCount > 0)
                //     el_checkbox_all.css('display', '');
                // else
				//     el_checkbox_all.css('display', 'none');
				
                // displaySelectAllCheckboxIf()
            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
		});
		// stops execution
		return false
    });

    // Fetch dependent item detail
	$('#item_detail').on('change', '#form_item_id', 
		function() { 
			if ($(this).val() == '')
				return false;

			el_tbody = $(this).closest('tbody');
			el_doc_subtotal = el_tbody.find('td.total > input');

			el_table_row = $(this).closest('tr');
			// el_item_description = el_table_row.find('td.description > input');
			el_item_qty = el_table_row.find('td.qty > input');
			el_item_price = el_table_row.find('td.price > input');
			el_item_total = el_table_row.find('td.total > input');

            $.ajax({
                type: 'post',
                url: '/accounts/sales-invoice/get-item',
                data: {
                    'item_id': $(this).val(),
                },
                success: function(item) 
                {
					// console.log(item);
					item = JSON.parse(item);
					// Re-calculate the Line item totals
					el_item_qty.val(item.qty); // default is 1
					el_item_price.val(item.unit_price);
					el_item_total.val(item.unit_price * item.qty);

					// Re-calculate the Document totals
					sum_item_total = sum_vat_amount = 0;

					el_doc_subtotal.each(
						function() {
							item_total = $(this).val();
							if (item_total == null)
								return false;

							sum_item_total += parseFloat(item_total);

							// vat_amount = item_total * item.tax_rate / (1 + item.tax_rate);
							// sum_vat_amount += parseFloat(vat_amount);
						});
					
					$('#subtotal_amount').val(sum_item_total);
					
					// unpaidBalance = sum_item_total - $(sales_order.form_id + '-total_amount_paid').val();
					// // if (unpaidBalance > 0)
					// // show the Payment button
					$('form_amount_due').val(sum_item_total.toFixed(2));
					// $(sales_order.form_id + '-unpaid_balance').val(unpaidBalance.toFixed(2));
					// $(sales_order.form_id + '-total_tax_amount').val(sum_vat_amount.toFixed(2));
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
        });

// $(sales_order.table_id + ' tbody').on('change', 'select.list-option',
//     function(e) {
//         e.stopPropagation(); // !! DO NOT use return false it stops execution

//         if ($(this).val() == '')
//             return false;

//         el_table_row = $(this).closest('tr');
//         el_input_item_qty = el_table_row.find('td.item-qty > input');
//         el_input_item_rate = el_table_row.find('td.item-rate > input');
//         el_input_item_tax = el_table_row.find('td.item-tax > input');
//         el_input_item_total = el_table_row.find('td.item-total > input');

//         $.ajax({
//             url: sales_order.get_item_url,
//             type: 'post',
//             data: {
//                 _csrf: yii.getCsrfToken(),
//                 'item_id': $(this).val()
//             },
//             success: function(item) {
//                 // Re-calculate the Line item totals
//                 el_input_item_qty.val(item.min_order_qty); // default is 1
//                 el_input_item_rate.val(item.standard_rate);
//                 el_input_item_tax.val(item.tax_rate);
//                 el_input_item_total.val(item.standard_rate * item.min_order_qty);

//                 // Re-calculate the Document totals
//                 sum_item_total = sum_vat_amount = 0;

//                 $(sales_order.table_id + ' td.item-total > input').each(
//                     function() {
//                         item_total = $(this).val();
//                         if (item_total == null)
//                             return false;

//                         sum_item_total += parseFloat(item_total);

//                         vat_amount = item_total * item.tax_rate / (1 + item.tax_rate);
//                         sum_vat_amount += parseFloat(vat_amount);
//                     });

//                 unpaidBalance = sum_item_total - $(sales_order.form_id + '-total_amount_paid').val();
//                 // if (unpaidBalance > 0)
//                 // show the Payment button
//                 $(sales_order.form_id + '-total_amount_due').val(sum_item_total.toFixed(2));
//                 $(sales_order.form_id + '-unpaid_balance').val(unpaidBalance.toFixed(2));
//                 $(sales_order.form_id + '-total_tax_amount').val(sum_vat_amount.toFixed(2));
//             },
//             error: function(jqXhr, textStatus, errorThrown) {
//                 console.log(errorThrown);
//             }
//         });
//     });

// $(sales_order.table_id + ' tbody').on('change', 'td.item-qty input',
//     function(e) {
//         e.stopPropagation(); // !! DO NOT use return false it stops execution

//         if ($(this).val() == '')
//             return false;

//         el_table_row = $(this).closest('tr');
//         el_input_item_rate = el_table_row.find('td.item-rate > input');
//         el_input_item_tax = el_table_row.find('td.item-tax > input');
//         el_input_item_qty = $(this);
//         el_input_item_total = el_table_row.find('td.item-total > input');
//         el_input_item_total.val(el_input_item_rate.val() * el_input_item_qty.val());

//         // Re-calculate the Document totals
//         sum_item_total = sum_vat_amount = 0;

//         $(sales_order.table_id + ' td.item-total > input').each(
//             function() {
//                 item_total = $(this).val();
//                 if (item_total == null)
//                     return false;

//                 sum_item_total += parseFloat(item_total);

//                 vat_amount = item_total * el_input_item_tax.val() / (1 + el_input_item_tax.val());
//                 sum_vat_amount += parseFloat(vat_amount);
//             });

//         $(sales_order.form_id + '-total_amount_due').val(sum_item_total.toFixed(2));
//         $(sales_order.form_id + '-unpaid_balance').val(sum_item_total.toFixed(2));
//         $(sales_order.form_id + '-total_tax_amount').val(sum_vat_amount.toFixed(2));
//         $(sales_order.form_id + '-total_amount_paid').val('0.00');
//     });

// $(sales_order.table_id + ' th.select-all-rows > input').on('click',
//     function(e) {
//         select_all_rows = $(this).is(':checked');

//         $(sales_order.table_id + ' .select-row > input').each(
//             function(e) {
//                 if (select_all_rows)
//                     $(this).prop('checked', true);
//                 else
//                     $(this).prop('checked', false);
//             });

//         if (select_all_rows)
//             $(sales_order.table_id + ' .del-row').css('display', '');
//         else
//             $(sales_order.table_id + ' .del-row').css('display', 'none');
//     });

// $(sales_order.table_id + ' tbody').on('click', '.select-row > input',
//     function(e) {
//         selected_row = $(this).is(':checked');

//         if (selected_row)
//             $(sales_order.table_id + ' .del-row').css('display', '');
//         else
//             $(sales_order.table_id + ' .del-row').css('display', 'none');
//     });

// $(sales_order.table_id + ' .del-row').on('click',
//     function(e) {
//         $(this).css('display', 'none');

//         $(sales_order.table_id + ' td.select-row > input:checked').each(
//             function(e) {
//                 el_table_row = $(this).closest('tr');

//                 // delete row if only added in table but not persisted in DB
//                 if ($(this).val() == 'on') // strange value "on" set by default
//                 {
//                     $(this).closest('tr').remove();
//                     // return false
//                 } else
//                 // delete row from persisted DB table and also from html table
//                     $.ajax({
//                     url: sales_order.del_row_url,
//                     type: 'post',
//                     data: {
//                         _csrf: yii.getCsrfToken(),
//                         'id': $(this).val(),
//                     },
//                     success: function(response) {
//                         el_table_row.remove();
//                         // update totals fields
//                     },
//                     error: function(jqXhr, textStatus, errorThrown) {
//                         console.log(errorThrown);
//                     }
//                 });
//             });

//         el_checkbox_all = $(sales_order.table_id + ' th.select-all-rows > input');

//         el_checkbox_all.prop('checked', false);

//         el_checkbox_all = $(sales_order.table_id + ' th.select-all-rows > input');

//         rowCount = $(sales_order.table_id + ' tbody > tr').length;
//         if (rowCount > 0)
//             el_checkbox_all.css('display', '');
//         else
//             el_checkbox_all.css('display', 'none');
//         // displaySelectAllCheckboxIf()
//     });

// function displaySelectAllCheckboxIf() {
//     countItemRows = $(sales_order.table_id + ' tbody > tr').length;
//     if (countItemRows > 0)
//         el_checkbox_all.css('display', '');
//     else
//         el_checkbox_all.css('display', 'none');

// }
</script>
