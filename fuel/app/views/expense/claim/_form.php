<?= Form::open(array("class"=>"form-horizontal")); ?>

	<!--<div class="form-group">-->
	<!--	<div class="col-md-4">-->
	<!--		<?= Form::label('Credit account', 'credit_account_id', array('class'=>'control-label')); ?>-->
	<!---->
	<!--		<?= Form::select('credit_account_id', Input::post('credit_account_id', isset($expense_claim) ? $expense_claim->credit_account_id : ''),
									array(),
									array('class' => 'col-md-4 form-control')); ?>-->
	<!--	</div>-->
	<!--</div>-->
	
	<div class="form-group">
		<div class="col-md-2">
		<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($expense_claim) ? $expense_claim->reference : ''),
									   array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
			</div>
		</div>
	
		<div class="col-md-2">
		<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>

		<?= Form::input('date', Input::post('date', isset($expense_claim) ? $expense_claim->date : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-4">
		<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>

		<?= Form::input('payer', Input::post('payer', isset($expense_claim) ? $expense_claim->payer : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-4">
		<?= Form::label('Payee', 'payee', array('class'=>'control-label')); ?>

		<?= Form::input('payee', Input::post('payee', isset($expense_claim) ? $expense_claim->payee : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	
	<!--<div class="form-group">-->
	<!--	<div class="col-md-4">-->
	<!--	<?= Form::label('GL account', 'gl_account_id', array('class'=>'control-label')); ?>-->
	<!---->
	<!--	<?= Form::input('gl_account_id', Input::post('gl_account_id', isset($expense_claim) ? $expense_claim->gl_account_id : ''),
							   array('class' => 'col-md-4 form-control')); ?>-->
	<!--	</div>-->
	<!--</div>-->
	
	<div class="form-group">
		<div class="col-md-3">
		<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>

		<?= Form::input('amount', Input::post('amount', isset($expense_claim) ? $expense_claim->amount : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	
		<div class="col-md-2">
		<?= Form::label('Vat', 'tax_id', array('class'=>'control-label')); ?>

		<?= Form::input('tax_id', Input::post('tax_id', isset($expense_claim) ? $expense_claim->tax_id : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-6">
		<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>

		<?= Form::input('description', Input::post('description', isset($expense_claim) ? $expense_claim->description : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	
	<hr>
		
	<div class="form-group">
		<div class="col-md-3">
		<?= Form::submit('submit', 'Save', array('class' => 'btn btn-success')); ?>
		</div>
	</div>
	
<?= Form::close(); ?>