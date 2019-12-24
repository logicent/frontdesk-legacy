<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>

			<?= Form::input('name', Input::post('name', isset($rate_type) ? $rate_type->name : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>

			<?= Form::input('description', Input::post('description', isset($rate_type) ? $rate_type->description : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<hr>

	<div class="form-group">
		<div class="col-md-3">
		<?= Form::submit('submit', isset($rate_type) ? 'Update' : 'Add type', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
