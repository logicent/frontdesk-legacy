<?= Form::open(array("class"=>"form-horizontal")); ?>

    <tr>
		<td class="col-md-2">
			<select id="form_item_id" name="item_id" data-bind="options: serviceItems, optionsText: 'item', optionsCaption: 'Choose item...', value: id"> </select>
			<?php /*echo Form::select('item_id', Input::post('item_id', isset($sales_invoice_item) ? $sales_invoice_item->item_id : $service->id),
                                        array(),
                                        array('class' => 'input-sm form-control',
                                        'data-bind' => "options: <?= $serviceItems; ?>, optionsText: 'item', optionsCaption: 'Select...', value: id"
                                    ));*/ ?>
		</td>
		<!--<td>
			<?php //echo Form::input('gl_account_id', Input::post('gl_account_id', isset($sales_invoice_item) ? $sales_invoice_item->gl_account_id : ''),
								   //array('class' => 'col-md-4 form-control')); ?>
		</td>-->
		<td class="col-md-3">
			<?= Form::input('description', Input::post('description', isset($sales_invoice_item) ? $sales_invoice_item->description : ''),
                            array('class' => 'input-sm form-control')); ?>
		</td>
		<td class="col-md-2 quantity">
			<!-- <input data-bind='visible: product, value: qty, valueUpdate: "afterkeydown"' /> -->
			<?= Form::input('qty', Input::post('qty', isset($sales_invoice_item) ? $sales_invoice_item->qty : ''),
                            array('class' => 'input-sm form-control',
                                'data-bind' => 'value: qty, valueUpdate: "afterkeydown"')); ?>
		</td>
		<td class='price' data-bind='with: product'>
            <span data-bind='text: formatCurrency(unit_price)'> </span>
			<?php //echo Form::input('unit_price', Input::post('unit_price', isset($sales_invoice_item) ? $sales_invoice_item->unit_price : $service->unit_price),
								   //array('class' => 'input-sm form-control text-right')); ?>
		</td><!--
		<td>
			<?php /* Form::input('discount_percent', Input::post('discount_percent', isset($sales_invoice_item) ? $sales_invoice_item->discount_percent : ''),
                            array('class' => 'input-sm form-control')); */ ?>
		</td>-->
		<td class='price'>
            <span data-bind='text: formatCurrency(amount())' > </span>
			<?php //echo Form::input('amount', Input::post('amount', isset($sales_invoice_item) ? $sales_invoice_item->amount : ''),
								   //array('class' => 'input-sm form-control text-right', 'readonly' => true)); ?>
		</td><!--
		<td>
			 <a href='#' data-bind='click: $parent.removeLine'><i class="glyphicon glyphicon-check"></i></a>
			<?php //echo Html::anchor('sales/invoice/item/save/', '<i class="glyphicon glyphicon-check"></i>',
									//array('class' => 'btn btn-sm btn-success')); ?>
			<?php //echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
		</td>-->
    </tr>

<?= Form::close(); ?>

<script>
	// var serviceItems = <?php //= $serviceItems; ?>
	// console.log(serviceItems);
</script>
