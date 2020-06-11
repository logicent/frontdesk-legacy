<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
        <!-- <div class="col-md-6">
            <?php Form::label('Source', 'source', array('class'=>'control-label')); ?>
            <?php Form::select('source', Input::post('source', isset($sales_order) ? $sales_order->source : ''),
                            array(), // Model_Sales_Order::getSourceName($business), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div> -->
        <div class="col-md-3">
			<?= Form::label('Order no.', 'order_num', array('class'=>'control-label')); ?>
            <?= Form::input('order_num', Input::post('order_num', isset($sales_order) ? $sales_order->order_num : 
                            Model_Sales_Order::getNextSerialNumber()), 
                            array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::hidden('status', Input::post('status', isset($sales_order) ? $sales_order->status : Model_Sales_Order::ORDER_STATUS_OPEN)); ?>
            <?= Form::select('status_list', Input::post('status_list', isset($sales_order) ? $sales_order->status : ''), 
                            Model_Sales_Order::$order_status, 
                            array('class' => 'col-md-4 form-control', 'disabled' => true)); ?>
		</div>
	</div>
	<div class="form-group">
        <!-- <div class="col-md-6">
            <?php Form::label('Source ref.', 'source_id', array('class'=>'control-label')); ?>
            <?php Form::select('source_id', Input::post('source_id', isset($sales_order) ? $sales_order->source_id : ''), 
                            array(), // Model_Lease::listOptions(), 
                            array('class' => 'col-md-4 form-control select-from-list')); ?>
        </div> -->
		<div class="col-md-3">
			<?= Form::label('Issue date', 'issue_date', array('class'=>'control-label')); ?>
            <?= Form::input('issue_date', Input::post('issue_date', isset($sales_order) ? $sales_order->issue_date : date('Y-m-d')), 
                            array('class' => 'col-md-4 form-control datepicker', 'readonly' => isset($sales_order) ? true : false)); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Due date', 'due_date', array('class'=>'control-label')); ?>
            <?= Form::input('due_date', Input::post('due_date', isset($sales_order) ? $sales_order->due_date :  date('Y-m-d')), 
                            array('class' => 'col-md-4 form-control datepicker', 'readonly' => isset($sales_order) ? true : false)); ?>
		</div>
	</div>
	<div class="form-group">
    <div class="col-md-6">
			<?= Form::label('Tenant', 'customer_name', array('class'=>'control-label')); ?>
            <?= Form::input('customer_name', Input::post('customer_name', isset($sales_order) ? $sales_order->customer_name : ''), 
                            array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
            <?php /* Form::select('customer_name', Input::post('customer_name', isset($sales_order) ? $sales_order->customer_name : ''), 
                            Model_Customer::listOptions(Model_Customer::CUSTOMER_TYPE_TENANT), 
                            array('class' => 'col-md-4 form-control')); */ ?>
            <?php /* Form::select('customer_list', Input::post('customer_list', isset($sales_order) ? $sales_order->customer_name : ''), 
                            Model_Customer::listOptions(Model_Customer::CUSTOMER_TYPE_TENANT), 
                            array('class' => 'col-md-4 form-control', 'disabled' => isset($sales_order) ? true : false)); */ ?>
        </div>
        <div class="col-md-6">
			<?= Form::label('Shipping address', 'shipping_address', array('class'=>'control-label')); ?>
            <?= Form::textarea('shipping_address', Input::post('shipping_address', isset($sales_order) ? $sales_order->shipping_address : ''), 
                                array('class' => 'col-md-4 form-control', 'rows' => 2)); ?>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <br>
	<ul id="doc_detail" class="nav nav-tabs">
		<li>
			<a id="shipping-tab" data-toggle="tab" href="#shipping">Services</a>
		</li>
		<li>
			<a id="receipts-tab" data-toggle="tab" href="#receipts">Receipts</a>
		</li>
	</ul>
    <!-- <br> -->
	<div id="doc_tabs" class="tab-content">
		<div id="shipping" class="tab-pane fade">
			<?= render('sales/order/item/index', array('sales_order_items' => isset($sales_order) ? $sales_order->items : array())); ?>
		</div>
		<div id="receipts" class="tab-pane fade">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="col-md-2">Receipt no.</th>
						<th class="col-md-2">Date</th>
						<th class="col-md-6">Description</th>
						<th class="col-md-2 text-right">Amount</th>
					</tr>
				</thead>
				<tbody>
        <?php 
            if (isset($sales_order) && !empty($sales_order->receipts)) :
                foreach ($sales_order->receipts as $item): ?>
                    <tr class="<?= $item->amount > 0 ? : 'strikeout text-muted' ?>">
                        <td><?= Html::anchor('accounts/payment/receipt/edit/'.$item->id, $item->reference); ?></td>
                        <td><?= $item->date; ?></td>
                        <td><?= $item->description; ?></td>
                        <td class="text-right"><?= number_format($item->amount, 2); ?></td>
                    </tr>
        <?php 
                endforeach;
            else : ?>
                    <tr id="no_data"><td class="text-muted text-center" colspan="4">No data</td></tr>
        <?php
            endif ?>
				</tbody>
			</table>
		</div>
	</div>
    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($sales_order) ? $sales_order->fdesk_user : $uid)); ?>
    <br>
	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
                <div class="col-md-12">
                    <?= Form::label('Notes', 'notes', array('class'=>'control-label')); ?>
                    <?= Form::textarea('notes', Input::post('notes', isset($sales_order) ? $sales_order->notes : ''), 
                                        array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?= Form::label('Summary', 'summary', array('class'=>'control-label')); ?>
                    <?= Form::input('summary', Input::post('summary', isset($sales_order) ? $sales_order->summary : ''), array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
		<div class="col-md-6">
            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Advance Paid', 'advance_paid', array('class'=>'control-label')); ?>
                    <?= Form::input('advance_paid', Input::post('advance_paid', isset($sales_order) ? $sales_order->advance_paid : ''), 
                            array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                    <?php Form::label('Discount Amount', 'disc_total', array('class'=>'control-label')); ?>
                    <?= Form::hidden('disc_total', Input::post('disc_total', isset($sales_order) ? $sales_order->disc_total : 0), 
                                    array('class' => 'col-md-4 form-control text-right')); ?>
                </div>
                <div class="col-md-6">
                    <?= Form::label('Amount Due', 'amount_due', array('class'=>'control-label')); ?>
                    <?= Form::input('amount_due', Input::post('amount_due', isset($sales_order) ? $sales_order->amount_due : 0), 
                            array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                </div>
                <?= Form::hidden('tax_total', Input::post('tax_total', isset($sales_order) ? $sales_order->tax_total : 0.0)); ?>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Amount Paid', 'amount_paid', array('class'=>'control-label')); ?>
                    <?= Form::input('amount_paid', Input::post('amount_paid', isset($sales_order) ? $sales_order->amount_paid : 0), 
                                    array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                </div>
                <div class="col-md-6">
                    <?= Form::label('Balance Due', 'balance_due', array('class'=>'control-label')); ?>
                    <?= Form::input('balance_due', Input::post('balance_due', isset($sales_order) ? $sales_order->balance_due : 0), 
                                    array('class' => 'col-md-4 form-control text-right text-red', 'readonly' => true)); ?>
                </div>                
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?= Form::label('Paid Status', 'paid_status', array('class'=>'control-label')); ?>
                    <?= Form::hidden('paid_status', Input::post('paid_status', isset($sales_order) ? $sales_order->paid_status : '')); ?>
                    <?= Form::select('paid_status_list', Input::post('paid_status_list', isset($sales_order) ? $sales_order->paid_status : ''), 
                            Model_Sales_Order::$order_paid_status, array('class' => 'col-md-4 form-control', 'disabled' => true)); ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
	<div class="form-group">
		<div class="col-md-6">
			<!-- <button class="btn btn-success" data-bind='click: save'>Save</button> -->
			<?= Form::submit('submit', isset($sales_order) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="col-md-6">
			<div class="pull-right btn-group">
            <?php 
                if (isset($sales_order)) :
                    if ($sales_order->status == 'O') : ?>
                        <a href="<?= Uri::create('accounts/payment/receipt/create/' . $sales_order->id); ?>" class="btn btn-default ">Add payment</a>
            <?php 
                    endif;
                endif ?>
			</div>
		</div>
	</div>

<?= Form::close(); ?>

<script>
	$('#doc_detail a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
	})
	$('#doc_detail a:first').tab('show')
</script>