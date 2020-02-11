<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($partner) ? $partner->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type', 'type', array('class'=>'control-label')); ?>

				<?php echo Form::input('type', Input::post('type', isset($partner) ? $partner->type : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Inactive', 'inactive', array('class'=>'control-label')); ?>

				<?php echo Form::input('inactive', Input::post('inactive', isset($partner) ? $partner->inactive : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Inactive')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Credit limit', 'credit_limit', array('class'=>'control-label')); ?>

				<?php echo Form::input('credit_limit', Input::post('credit_limit', isset($partner) ? $partner->credit_limit : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Credit limit')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>