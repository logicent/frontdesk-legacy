<h2 class="page-header">Viewing <span class='text-muted'>Order</span>&nbsp;
<span><?= Html::anchor('accounts/sales-order', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Folio no.', 'order_num', array('class'=>'control-label')); ?>
            <?= Form::label($sales_order->order_num, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::label(Model_Sales_Order::$order_status[$sales_order->status], '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Customer', 'customer_name', array('class'=>'control-label')); ?>
            <?= Form::label($sales_order->customer_name, '', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Issue date', 'issue_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_order->issue_date, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Due date', 'due_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_order->due_date, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Shipping address', 'shipping_address', array('class'=>'control-label')); ?>
            <?= Form::label($sales_order->shipping_address, '', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<ul id="order_detail" class="nav nav-tabs">
		<li>
			<a id="shipping-tab" data-toggle="tab" href="#shipping">Bills</a>
		</li>
		<li>
			<a id="receipts-tab" data-toggle="tab" href="#receipts">Receipts</a>
		</li>
	</ul>
    <!-- <br> -->
	<div id="order_tabs" class="tab-content">
		<div id="shipping" class="tab-pane fade">
			<?= render('sales/order/item/index', array('sales_order_items' => isset($sales_order) ? $sales_order->items : array())); ?>
		</div>

		<div id="receipts" class="tab-pane fade">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Receipt No.</th>
						<th>Date</th>
						<th>Description</th>
						<th class="text-right">Amount</th>
					</tr>
				</thead>
				<tbody>
            <?php 
            if (isset($sales_order)) :
                foreach ($sales_order->receipts as $item): ?>
                    <tr class="<?= $item->amount > 0 ? : 'strikeout text-muted' ?>">
                        <td><?= Html::anchor('accounts/payment/receipt/edit/'.$item->id, $item->reference); ?></td>
                        <td><?= $item->date; ?></td>
                        <td><?= $item->description; ?></td>
                        <td class="text-right"><?= number_format($item->amount, 2); ?></td>
                    </tr>
            <?php 
                endforeach;
            endif ?>
				</tbody>
			</table>
		</div>
	</div>

    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($sales_order) ? $sales_order->fdesk_user : $uid)); ?>
    <?= Form::hidden('source', Input::post('source', isset($sales_order) ? $sales_order->source : '')); ?>
    <?= Form::hidden('source_id', Input::post('source_id', isset($sales_order) ? $sales_order->source_id : '')); ?>

	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
        		<div class="col-md-12">
                    <?= Form::label('Notes', 'notes', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->notes, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?= Form::label('Summary', 'summary', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->summary, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
		
		<div class="col-md-6">
            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Amount Due', 'amount_due', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->amount_due, '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <div class="col-md-6">
                    <?= Form::label('Amount Paid', 'amount_paid', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->amount_paid, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Discount Amount', 'disc_total', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->disc_total, '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <?= Form::hidden('tax_total', Input::post('tax_total', isset($sales_order) ? $sales_order->tax_total : 0.0)); ?>

                <div class="col-md-6">
                    <?= Form::label('Balance Due', 'balance_due', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->balance_due, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Paid Status', 'paid_status', array('class'=>'control-label')); ?>
                    <?= Form::label(Model_Sales_Order::$order_paid_status[$sales_order->paid_status], '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <div class="col-md-6">
                    <?= Form::label('Advance Paid', 'advance_paid', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_order->advance_paid, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
    </div>
	
    <hr>

	<div class="form-group">
		<div class="col-md-6">
			<button class="btn btn-primary">Print</button>
		</div>
	</div>

<?= Form::close(); ?>

<script>
	$('#order_detail a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

	$('#order_detail a:first').tab('show')
</script>
