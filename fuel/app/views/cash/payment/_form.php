<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($cash_payment) ? $cash_payment->reference : Model_Cash_Payment::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
		</div>
		<div class="col-md-2">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
			<!-- <div class="input-group"> -->
				<?= Form::input('date', Input::post('date', isset($cash_payment) ? $cash_payment->date : date('Y-m-d')), array('class' => 'col-md-4 form-control datepicker')); ?>
				<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
			<!-- </div> -->
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Payee', 'payee', array('class'=>'control-label')); ?>
			<?= Form::input('payee', Input::post('payee', isset($cash_payment) ? $cash_payment->payee : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
			<?= Form::input('amount', Input::post('amount', isset($cash_payment) ? $cash_payment->amount : 0), array('class' => 'col-md-4 form-control text-right', 'autofocus' => true)); ?>
		</div>
	</div>

	<!-- <div class="form-group">
		<?= Form::label('GL account', 'gl_account_id', array('class'=>'control-label')); ?>
		<?= Form::input('gl_account_id', Input::post('gl_account_id', isset($cash_payment) ? $cash_payment->gl_account_id : ''), array('class' => 'col-md-4 form-control')); ?>
	</div> -->

	<!-- <div class="form-group">
		<?= Form::label('Tax id', 'tax_id', array('class'=>'control-label')); ?>
		<?= Form::input('tax_id', Input::post('tax_id', isset($cash_payment) ? $cash_payment->tax_id : 0), array('class' => 'col-md-4 form-control')); ?>
	</div> -->

	<!-- <div class="form-group">
		<?= Form::label('Bank account', 'bank_account_id', array('class'=>'control-label')); ?>
		<?= Form::input('bank_account_id', Input::post('bank_account_id', isset($cash_payment) ? $cash_payment->bank_account_id : ''), array('class' => 'col-md-4 form-control')); ?>
	</div> -->

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($cash_payment) ? $cash_payment->description : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($cash_payment) ? $cash_payment->fdesk_user : $uid)); ?>
	<hr>

	<div class="form-group">
		<div class="col-md-2">
		<?= Form::submit('submit', isset($cash_payment) ? 'Update' : 'Add expense', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="col-md-2">
			<?php if (isset($cash_payment)): ?>
				<div class="pull-right btn-toolbar">
					<div class="btn-group">
						<a href="<?= Uri::create('cash/receipt/delete/'.$cash_payment->id); ?>" class="btn btn-danger" >Cancel expense</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?= Form::close(); ?>
