<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>
	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
			<?= Form::input('code', Input::post('code', isset($hr_salary_component) ? $hr_salary_component->code : ''), 
							array('class' => 'col-md-4 form-control')) ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($hr_salary_component) ? $hr_salary_component->name : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($hr_salary_component) ? $hr_salary_component->description : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Type', 'type', array('class'=>'control-label')); ?>
			<?= Form::input('type', Input::post('type', isset($hr_salary_component) ? $hr_salary_component->type : ''), 
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('enabled', Input::post('enabled', isset($hr_salary_component) ? $hr_salary_component->enabled : '0')); ?>
			<?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
			<?= Form::label('Enabled', 'cb_enabled', array('class'=>'control-label')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('is_payable', Input::post('is_payable', isset($hr_salary_component) ? $hr_salary_component->is_payable : '0')); ?>
			<?= Form::checkbox('cb_is_payable', null, array('class' => 'cb-checked', 'data-input' => 'is_payable')); ?>
			<?= Form::label('Is payable', 'cb_is_payable', array('class'=>'control-label')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('is_tax_applicable', Input::post('is_tax_applicable', isset($hr_salary_component) ? $hr_salary_component->is_tax_applicable : '0')); ?>
			<?= Form::checkbox('cb_is_tax_applicable', null, array('class' => 'cb-checked', 'data-input' => 'is_tax_applicable')); ?>
			<?= Form::label('Is tax applicable', 'cb_is_tax_applicable', array('class'=>'control-label')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::hidden('depends_on_payment_days', Input::post('depends_on_payment_days', isset($hr_salary_component) ? $hr_salary_component->depends_on_payment_days : '0')); ?>
			<?= Form::checkbox('cb_depends_on_payment_days', null, array('class' => 'cb-checked', 'data-input' => 'depends_on_payment_days')); ?>
			<?= Form::label('Depends on payment days', 'cb_depends_on_payment_days', array('class'=>'control-label')); ?>
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