<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($bank_account) ? $bank_account->name : ''), array('class' => 'col-md-6 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Account number', 'account_number', array('class'=>'control-label')); ?>
			<?= Form::input('account_number', Input::post('account_number', isset($bank_account) ? $bank_account->account_number : ''), array('class' => 'col-md-6 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Financial institution', 'financial_institution', array('class'=>'control-label')); ?>
			<?= Form::input('financial_institution', Input::post('financial_institution', isset($bank_account) ? $bank_account->financial_institution : ''), array('class' => 'col-md-6 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
        <div class="col-md-3">
            <?= Form::label('Starting date', 'starting_date', array('class'=>'control-label')); ?>
            <?= Form::input('starting_date', Input::post('starting_date', isset($bank_account) ? $bank_account->starting_date : ''), array('class' => 'col-md-6 form-control datepicker')); ?>
        </div>

        <div class="col-md-3">
			<?= Form::label('Starting balance', 'starting_bal', array('class'=>'control-label')); ?>
			<?= Form::input('starting_bal', Input::post('starting_bal', isset($bank_account) ? $bank_account->starting_bal : ''), 
							array('class' => 'col-md-6 form-control text-right')); ?>
		</div>
	</div>

	<!-- <div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Internet banking N/A', 'i_banking_na', array('class'=>'control-label')); ?>
			<?= Form::checkbox('i_banking_na', Input::post('i_banking_na', isset($bank_account) ? $bank_account->i_banking_na : ''), array('class' => 'col-md-6 form-control')); ?>
		</div>
	</div> -->

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Last statement date', 'last_statement_date', array('class'=>'control-label')); ?>
			<?= Form::input('last_statement_date', Input::post('last_statement_date', isset($bank_account) ? $bank_account->last_statement_date : ''), array('class' => 'col-md-6 form-control datepicker')); ?>
		</div>
	</div>

	<hr>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::submit('submit', isset($bank_account) ? 'Update' : 'Add account', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>
<?= Form::close(); ?>
