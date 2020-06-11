<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Source', 'source', array('class'=>'control-label')); ?>
				<?= Form::select('source', Input::post('source', isset($payment_receipt) ? $payment_receipt->source : ''),
								Model_Accounts_Payment_Receipt::getSourceName($business, isset($payment_receipt) ? $payment_receipt->type : 'Settlement'), 
								array('class' => 'col-md-4 form-control')); ?>
			</div>
			<div class="col-md-6">
				<?= Form::label('Type', 'type', array('class'=>'control-label')); ?>
				<?= Form::select('type', Input::post('type', isset($payment_receipt) ? $payment_receipt->type : 'Settlement'), 
								array(
									'Settlement' => 'Settlement',
									'Advance' => 'Advance',
								),
								array('class' => 'col-md-4 form-control')) ?>
			</div>
			<?= Form::hidden('status', Input::post('status', isset($payment_receipt) ? $payment_receipt->status : 'Received')) ?>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Source ref.', 'source_id', array('class'=>'control-label')); ?>
				<?= Form::select('source_id', Input::post('source_id', isset($payment_receipt) ? $payment_receipt->source_id : ''), 
								isset($payment_receipt) ? Model_Accounts_Payment_Receipt::listSourceOptions() : Model_Sales_Invoice::listOptions(), 
								array('class' => 'col-md-4 form-control select-from-list')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
				<?= Form::textarea('description', Input::post('description', isset($payment_receipt) ? $payment_receipt->description : ''), 
								array('class' => 'col-md-4 form-control', 'rows' => 5)) ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Receipt Number', 'receipt_number', array('class'=>'control-label')); ?>
				<div class="input-group">
					<span class="input-group-addon">#</span>
					<?= Form::input('receipt_number', Input::post('receipt_number', isset($payment_receipt) ? 
									$payment_receipt->receipt_number : Model_Accounts_Payment_Receipt::getNextSerialNumber()), 
									array('class' => 'col-md-4 form-control', 'readonly' => true)) ?>
				</div>
			</div>
			<div class="col-md-6">
				<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
				<?= Form::input('date', Input::post('date', isset($payment_receipt) ? $payment_receipt->date : date('Y-m-d')), 
								array('class' => 'col-md-4 form-control datepicker')) ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Payment Method', 'payment_method', array('class'=>'control-label')); ?>
				<!-- Model_Accounts_Payment_Method::loadDefaultValue() -->
				<?= Form::select('payment_method', Input::post('payment_method', isset($payment_receipt) ? $payment_receipt->payment_method : ''), 
								Model_Accounts_Payment_Method::listOptions(), 
								array('class' => 'col-md-4 form-control')) ?>
			</div>
			<div class="col-md-6">
				<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
				<?= Form::input('reference', Input::post('reference', isset($payment_receipt) ? $payment_receipt->reference : ''), 
								array('class' => 'col-md-4 form-control')) ?>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
				<?= Form::input('amount', Input::post('amount', isset($payment_receipt) ? $payment_receipt->amount : '0.00'), 
								array('class' => 'col-md-4 form-control text-right', 'readonly' => false)) ?>
			</div>
			<div class="col-md-6">
				<?= Form::label('Vat', 'tax_id', array('class'=>'control-label')); ?>
				<?= Form::input('tax_id', Input::post('tax_id', isset($payment_receipt) ? $payment_receipt->tax_id : 0), 
								array('class' => 'col-md-4 form-control text-right')) ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>
				<?= Form::input('payer', Input::post('payer', isset($payment_receipt) ? $payment_receipt->payer : ''), 
								array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div>
</div>
<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($payment_receipt) ? $payment_receipt->fdesk_user : $uid)); ?>
<hr>
<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($payment_receipt) ? 'Update' : 'Add payment', array('class' => 'btn btn-primary')); ?>
	</div>
	<div class="col-md-6">
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