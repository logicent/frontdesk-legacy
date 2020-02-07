<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($payment_receipt) ? $payment_receipt->reference : Model_Accounts_Payment_Receipt::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
			<?= Form::hidden('bill_id', Input::post('bill_id', isset($payment_receipt) ? $payment_receipt->bill_id : $bill->id)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
			<?= Form::input('date', Input::post('date', isset($payment_receipt) ? $payment_receipt->date : date('Y-m-d')), array('class' => 'col-md-4 form-control datepicker')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>
			<?= Form::input('payer', Input::post('payer', isset($payment_receipt) ? $payment_receipt->payer : $bill->guest->first_name .' '. $bill->guest->last_name), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
			<?= Form::input('amount', Input::post('amount', isset($payment_receipt) ? $payment_receipt->amount : $bill->balance_due), array('class' => 'col-md-4 form-control', 'readonly' => isset($payment_receipt) && $payment_receipt->invoice->guest->status == 'CO' ? true : false, 'autofocus' => true)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Vat', 'tax_id', array('class'=>'control-label')); ?>
			<?= Form::input('tax_id', Input::post('tax_id', isset($payment_receipt) ? $payment_receipt->tax_id : 0), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($payment_receipt) ? $payment_receipt->description : 'Accommodation for Room no. '.$bill->guest->room->name), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($payment_receipt) ? $payment_receipt->fdesk_user : $uid)); ?>
	<hr>
	<div class="form-group">
		<div class="col-md-2">
			<?= Form::submit('submit', isset($payment_receipt) ? 'Update' : 'Receive money', array('class' => 'btn btn-primary')); ?>
		</div>

		<div class="col-md-2">
			<?php if (isset($payment_receipt)): ?>
				<div class="pull-right btn-toolbar">
					<div class="btn-group">
						<a href="<?= Uri::create('accounts/payment/receipt/delete/'.$payment_receipt->id); ?>" class="btn btn-danger" >Cancel payment</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?= Form::close(); ?>
