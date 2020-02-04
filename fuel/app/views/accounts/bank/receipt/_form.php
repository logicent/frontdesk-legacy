<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($bank_receipt) ? $bank_receipt->reference : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
			<?= Form::input('date', Input::post('date', isset($bank_receipt) ? $bank_receipt->date : ''), array('class' => 'col-md-4 form-control datepicker')); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
			<?= Form::input('amount', Input::post('amount', isset($bank_receipt) ? $bank_receipt->amount : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>
			<?= Form::input('payer', Input::post('payer', isset($bank_receipt) ? $bank_receipt->payer : 'Manager'), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<!-- <div class="form-group">
		<?= Form::label('GL account', 'gl_account_id', array('class'=>'control-label')); ?>
		<?= Form::input('gl_account_id', Input::post('gl_account_id', isset($bank_receipt) ? $bank_receipt->gl_account_id : ''), array('class' => 'col-md-4 form-control')); ?>
	</div> -->

	<!-- <div class="form-group">
		<?= Form::label('Tax id', 'tax_id', array('class'=>'control-label')); ?>
		<?= Form::input('tax_id', Input::post('tax_id', isset($bank_receipt) ? $bank_receipt->tax_id : ''), array('class' => 'col-md-4 form-control')); ?>
	</div> -->

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Bank account', 'bank_account_id', array('class'=>'control-label')); ?>
			<?= Form::select('bank_account_id', Input::post('bank_account_id', isset($bank_receipt) ? $bank_receipt->bank_account_id : ''), Model_Bank_Account::listOptions(), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($bank_receipt) ? $bank_receipt->description : 'Cash to bank'), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<hr>
	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($bank_receipt) ? $bank_receipt->fdesk_user : $uid)); ?>
	<div class="form-group">
		<div class="col-md-3">
			<?= Form::submit('submit', isset($bank_receipt) ? 'Update' : 'Add deposit', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
