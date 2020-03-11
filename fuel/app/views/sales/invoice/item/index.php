<!-- <h4>Items <span class='text-muted'>billed</span></h4> -->

<table class="table table-hover">
	<thead>
		<tr>
			<th>Item</th>
			<!--<th>Gl account</th>-->
			<th>Description</th>
			<th>Qty</th>
			<th class="text-right">Price</th>
			<!--<th>Discount %</th>-->
			<th class="text-right">Amount</th>
			<!-- <th>&nbsp;</th> -->
		</tr>
	</thead>
	<tbody>
<?php 
    if ($sales_invoice_items):
        foreach ($sales_invoice_items as $item): ?>
		<tr>
			<td><?= $item->item_id; ?></td>
			<!--<td><?php //= $item->gl_account_id; ?></td>-->
			<td><?= $item->description; ?></td>
			<td><?= number_format($item->qty, 2); ?></td>
			<td class="text-right"><?= number_format($item->unit_price, 2); ?></td>
			<!--<td><?php //= $item->discount_percent; ?></td>-->
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<!-- <td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php /* Html::anchor('sales/invoice/item/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>',
												array('class' => 'btn btn-small')); */ ?>
						<?php /* Html::anchor('sales/invoice/item/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>',
												array('class' => 'btn btn-small')); */ ?>
						<?php /* Html::anchor('sales/invoice/item/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
												array('class' => 'btn btn-small', 'onclick' => "return confirm('Are you sure?')")); */ ?>
					</div>
				</div>
			</td> -->
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
			<th colspan="5" class='text-right grandTotal'>
                Total amount: <span data-bind='text: formatCurrency(grandTotal())'> </span>
				<?php //echo Form::input('total_amount', '', // compute total here
										//array('class' => 'input-sm form-control', 'readonly' => true)); ?>
			</th>
		</tr>
	</tfoot>
</table>

<div class="form-group">
    <div class="col-md-6">
        <!--<button class="btn btn-sm btn-default" data-bind='click: addLine'>Add item</button>-->
        <button class="btn btn-sm btn-default">Add item</button>
    </div>

    <div class="col-md-6 text-right">
        <?= Form::checkbox('amounts_tax_inc', Input::post('amounts_tax_inc', isset($sales_invoice) ? $sales_invoice->amounts_tax_inc : '0')); ?>
        <?= Form::label('Amounts is VAT incl.', 'amounts_tax_inc'); ?>
    </div>
</div>

<script>
</script>
