<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Code', 'code', array('class'=>'control-label')); ?>

				<?php echo Form::input('code', Input::post('code', isset($hr_salary_component) ? $hr_salary_component->code : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Code')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($hr_salary_component) ? $hr_salary_component->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Description', 'description', array('class'=>'control-label')); ?>

				<?php echo Form::input('description', Input::post('description', isset($hr_salary_component) ? $hr_salary_component->description : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Description')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Enabled', 'enabled', array('class'=>'control-label')); ?>

				<?php echo Form::input('enabled', Input::post('enabled', isset($hr_salary_component) ? $hr_salary_component->enabled : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Enabled')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Is payable', 'is_payable', array('class'=>'control-label')); ?>

				<?php echo Form::input('is_payable', Input::post('is_payable', isset($hr_salary_component) ? $hr_salary_component->is_payable : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Is payable')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Is tax applicable', 'is_tax_applicable', array('class'=>'control-label')); ?>

				<?php echo Form::input('is_tax_applicable', Input::post('is_tax_applicable', isset($hr_salary_component) ? $hr_salary_component->is_tax_applicable : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Is tax applicable')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Depends on payment days', 'depends_on_payment_days', array('class'=>'control-label')); ?>

				<?php echo Form::input('depends_on_payment_days', Input::post('depends_on_payment_days', isset($hr_salary_component) ? $hr_salary_component->depends_on_payment_days : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Depends on payment days')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type', 'type', array('class'=>'control-label')); ?>

				<?php echo Form::input('type', Input::post('type', isset($hr_salary_component) ? $hr_salary_component->type : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Fdesk user', 'fdesk_user', array('class'=>'control-label')); ?>

				<?php echo Form::input('fdesk_user', Input::post('fdesk_user', isset($hr_salary_component) ? $hr_salary_component->fdesk_user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fdesk user')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>