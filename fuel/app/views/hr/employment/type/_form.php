<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
			<?= Form::input('code', Input::post('code', isset($employment_type) ? $employment_type->code : ''), 
							array('class' => 'col-md-4 form-control')) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($employment_type) ? $employment_type->description : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('enabled', Input::post('enabled', isset($employment_type) ? $employment_type->enabled : '0')); ?>
			<?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
			<?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
		</div>
	</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($employment_type) ? $employment_type->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($employment_type) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>
