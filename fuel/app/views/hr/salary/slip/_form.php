<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
				<?= Form::input('code', Input::post('code', isset($hr_salary_slip) ? $hr_salary_slip->code : ''), 
								array('class' => 'col-md-4 form-control')) ?>
			</div>
		</div><!--
		<div class="form-group">
			<div class="col-md-12">
				<?php // Form::label('Name', 'name', array('class'=>'control-label')); ?>
				<?php /* Form::input('name', Input::post('name', isset($hr_salary_slip) ? $hr_salary_slip->name : ''), 
								array('class' => 'col-md-4 form-control')); */ ?>
			</div>
		</div>-->
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Employee', 'employee_id', array('class'=>'control-label')); ?>
				<?= Form::select('employee_id', Input::post('employee_id', isset($hr_salary_slip) ? $hr_salary_slip->employee_id : ''),
								Model_Employee::listOptions(),
								array('class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Designation', 'designation', array('class'=>'control-label')); ?>
				<?= Form::select('designation', Input::post('designation', isset($hr_salary_slip) ? $hr_salary_slip->designation : ''),
								Model_Employee::listOptions(),
								array('class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Payroll period', 'payroll_period', array('class'=>'control-label')); ?>
				<?= Form::select('payroll_period', Input::post('payroll_period', isset($hr_salary_slip) ? $hr_salary_slip->payroll_period : ''),
										array(),
										array('class' => 'form-control')); ?>
			</div>
		</div>		
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Start date', 'start_date', array('class'=>'control-label')); ?>
				<?= Form::input('start_date', Input::post('start_date', isset($employee) ? $employee->start_date : ''),
								array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
			</div>
			<div class="col-md-6">
				<?= Form::label('End date', 'end_date', array('class'=>'control-label')); ?>
				<?= Form::input('end_date', Input::post('end_date', isset($employee) ? $employee->end_date : ''),
								array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
				<?= Form::select('status', Input::post('status', isset($hr_salary_slip) ? $hr_salary_slip->status : ''),
										array(),
										array('class' => 'form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Date posted', 'date_posted', array('class'=>'control-label')); ?>
				<?= Form::input('date_posted', Input::post('date_posted', isset($hr_salary_slip) ? $hr_salary_slip->date_posted : ''),
								array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
			</div>
			<div class="col-md-6">
				<?= Form::label('Date due', 'date_due', array('class'=>'control-label')); ?>
				<?= Form::input('date_due', Input::post('date_due', isset($hr_salary_slip) ? $hr_salary_slip->date_due : ''),
								array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Total earnings', 'total_earnings', array('class'=>'control-label')); ?>
				<?= Form::input('total_earnings', Input::post('total_earnings', isset($hr_salary_slip) ? $hr_salary_slip->total_earnings : ''), 
								array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Total gross', 'total_gross', array('class'=>'control-label')); ?>
				<?= Form::input('total_gross', Input::post('total_gross', isset($hr_salary_slip) ? $hr_salary_slip->total_gross : ''), 
								array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?= Form::label('Net amount', 'net_amount', array('class'=>'control-label')); ?>
				<?= Form::input('net_amount', Input::post('net_amount', isset($hr_salary_slip) ? $hr_salary_slip->net_amount : ''), 
								array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div>
</div>
	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($hr_salary_slip) ? $hr_salary_slip->fdesk_user : $uid)); ?>
<hr>
<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($hr_salary_slip) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>
	<div class="col-md-6">
	</div>
</div>
<?= Form::close(); ?>