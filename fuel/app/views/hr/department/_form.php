<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
			<?= Form::input('code', Input::post('code', isset($hr_department) ? $hr_department->code : ''), 
							array('class' => 'col-md-4 form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($hr_department) ? $hr_department->name : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Parent department', 'parent_id', array('class'=>'control-label')); ?>
			<?= Form::select('parent_id', Input::post('parent_id', isset($hr_department) ? $hr_department->parent_id : ''),
									Model_Hr_Department::listOptionsParentDepartment($hr_department->id),
									array('class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('enabled', Input::post('enabled', isset($hr_department) ? $hr_department->enabled : '0')); ?>
			<?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
			<?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
		</div>
	</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($hr_department) ? $hr_department->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($hr_department) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>
