<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-6">
		<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
		<?= Form::input('name', Input::post('name', isset($room_type) ? $room_type->name : ''),
							   array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
		<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
		<?= Form::input('description', Input::post('description', isset($room_type) ? $room_type->description : ''),
							   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<hr>

	<div class="form-group">
		<div class="col-md-3">
		<?= Form::submit('submit', isset($room_type) ? 'Update' : 'Add', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
