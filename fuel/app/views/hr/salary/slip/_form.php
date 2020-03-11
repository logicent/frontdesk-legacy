<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Code', 'code', array('class'=>'control-label')); ?>

				<?php echo Form::input('code', Input::post('code', isset($hr_salary_slip) ? $hr_salary_slip->code : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Code')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($hr_salary_slip) ? $hr_salary_slip->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Employee id', 'employee_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('employee_id', Input::post('employee_id', isset($hr_salary_slip) ? $hr_salary_slip->employee_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Employee id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Designation', 'designation', array('class'=>'control-label')); ?>

				<?php echo Form::input('designation', Input::post('designation', isset($hr_salary_slip) ? $hr_salary_slip->designation : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Designation')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Start date', 'start_date', array('class'=>'control-label')); ?>

				<?php echo Form::input('start_date', Input::post('start_date', isset($hr_salary_slip) ? $hr_salary_slip->start_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Start date')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('End date', 'end_date', array('class'=>'control-label')); ?>

				<?php echo Form::input('end_date', Input::post('end_date', isset($hr_salary_slip) ? $hr_salary_slip->end_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'End date')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($hr_salary_slip) ? $hr_salary_slip->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Date posted', 'date_posted', array('class'=>'control-label')); ?>

				<?php echo Form::input('date_posted', Input::post('date_posted', isset($hr_salary_slip) ? $hr_salary_slip->date_posted : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Date posted')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Date due', 'date_due', array('class'=>'control-label')); ?>

				<?php echo Form::input('date_due', Input::post('date_due', isset($hr_salary_slip) ? $hr_salary_slip->date_due : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Date due')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Payroll period', 'payroll_period', array('class'=>'control-label')); ?>

				<?php echo Form::input('payroll_period', Input::post('payroll_period', isset($hr_salary_slip) ? $hr_salary_slip->payroll_period : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Payroll period')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Total deductions', 'total_deductions', array('class'=>'control-label')); ?>

				<?php echo Form::input('total_deductions', Input::post('total_deductions', isset($hr_salary_slip) ? $hr_salary_slip->total_deductions : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Total deductions')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Total earnings', 'total_earnings', array('class'=>'control-label')); ?>

				<?php echo Form::input('total_earnings', Input::post('total_earnings', isset($hr_salary_slip) ? $hr_salary_slip->total_earnings : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Total earnings')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Total gross', 'total_gross', array('class'=>'control-label')); ?>

				<?php echo Form::input('total_gross', Input::post('total_gross', isset($hr_salary_slip) ? $hr_salary_slip->total_gross : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Total gross')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Net amount', 'net_amount', array('class'=>'control-label')); ?>

				<?php echo Form::input('net_amount', Input::post('net_amount', isset($hr_salary_slip) ? $hr_salary_slip->net_amount : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Net amount')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Fdesk user', 'fdesk_user', array('class'=>'control-label')); ?>

				<?php echo Form::input('fdesk_user', Input::post('fdesk_user', isset($hr_salary_slip) ? $hr_salary_slip->fdesk_user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fdesk user')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>