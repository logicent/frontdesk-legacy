<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Receipt Number', 'receipt_number', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
                <?= Form::input('receipt_number', Input::post('receipt_number', isset($payment_receipt) ? 
                                $payment_receipt->receipt_number : Model_Accounts_Payment_Receipt::getNextSerialNumber()), 
                                array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
			<?= Form::hidden('bill_id', Input::post('bill_id', isset($payment_receipt) ? $payment_receipt->bill_id : (isset($bill) ? $bill->id : ''))); ?>
		</div>

		<div class="col-md-3">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
            <?= Form::input('date', Input::post('date', isset($payment_receipt) ? $payment_receipt->date : date('Y-m-d')), 
                            array('class' => 'col-md-4 form-control datepicker')); ?>
		</div>
	</div>

    <div class="form-group">
        <div class="col-md-3">
            <?= Form::label('Payment Method', 'payment_method', array('class'=>'control-label')); ?>
            <?= Form::select('payment_method', Input::post('payment_method', isset($payment_receipt) ? $payment_receipt->payment_method : ''), 
                            Model_Accounts_Payment_Method::listOptions(isset($payment_receipt) ? $payment_receipt->payment_method : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="col-md-3">
            <?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
            <?= Form::input('reference', Input::post('reference', isset($payment_receipt) ? $payment_receipt->reference : ''), 
                            array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
        </div>
    </div>

    <div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>
            <?= Form::input('payer', Input::post('payer', isset($payment_receipt) ? 
                            $payment_receipt->payer : (isset($bill) ? $bill->booking->customer_name : '')), 
                            array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
            <?= Form::input('amount', Input::post('amount', isset($payment_receipt) ? $payment_receipt->amount : (isset($bill) ? $bill->balance_due : '0.00')), 
                            array('class' => 'col-md-4 form-control text-right', 'readonly' => isset($payment_receipt) && 
                            $payment_receipt->invoice->booking->status == 'CO' ? true : false)); ?>
		</div>

		<div class="col-md-3">
			<?= Form::label('Vat', 'tax_id', array('class'=>'control-label')); ?>
            <?= Form::input('tax_id', Input::post('tax_id', isset($payment_receipt) ? $payment_receipt->tax_id : 0), 
                            array('class' => 'col-md-4 form-control text-right')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
            <?= Form::textarea('description', Input::post('description', isset($payment_receipt) ? $payment_receipt->description : 
                            (isset($bill) ? 'Accommodation for Unit no. ' . $bill->booking->unit->name : '')), 
                            array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
		</div>
	</div>

	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($payment_receipt) ? $payment_receipt->fdesk_user : $uid)); ?>
    
	<hr>
    
	<div class="form-group">
		<div class="col-md-3">
			<?= Form::submit('submit', isset($payment_receipt) ? 'Update' : 'Add payment', array('class' => 'btn btn-primary')); ?>
		</div>

		<div class="col-md-3">
			<?php if (isset($payment_receipt)): ?>
				<div class="pull-right btn-toolbar">
					<div class="btn-group">
						<a href="<?= Uri::create('accounts/payment/receipt/delete/'.$payment_receipt->id); ?>" class="btn btn-default" >Cancel</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?= Form::close(); ?>
