<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
			<?= Form::input('code', Input::post('code', isset($hr_designation) ? $hr_designation->code : ''), 
							array('class' => 'col-md-4 form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($hr_designation) ? $hr_designation->name : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::textarea('description', Input::post('description', isset($hr_designation) ? $hr_designation->description : ''), 
								array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Reports to', 'reports_to', array('class'=>'control-label')); ?>
			<?= Form::select('reports_to', Input::post('reports_to', isset($hr_designation) ? $hr_designation->reports_to : ''),
									Model_Hr_Designation::listOptionsReportsTo($hr_designation->id),
									array('class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('enabled', Input::post('enabled', isset($hr_designation) ? $hr_designation->enabled : '0')); ?>
			<?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
			<?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
		</div>
	</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($hr_designation) ? $hr_designation->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($hr_designation) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>
