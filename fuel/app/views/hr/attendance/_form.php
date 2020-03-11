<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Employee id', 'employee_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('employee_id', Input::post('employee_id', isset($hr_attendance) ? $hr_attendance->employee_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Employee id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Work day', 'work_day', array('class'=>'control-label')); ?>

				<?php echo Form::input('work_day', Input::post('work_day', isset($hr_attendance) ? $hr_attendance->work_day : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Work day')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($hr_attendance) ? $hr_attendance->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Fdesk user', 'fdesk_user', array('class'=>'control-label')); ?>

				<?php echo Form::input('fdesk_user', Input::post('fdesk_user', isset($hr_attendance) ? $hr_attendance->fdesk_user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fdesk user')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>