<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($room) ? $room->name : ''),
								   array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>

		<div class="col-md-3">
			<?= Form::label('Alias', 'alias', array('class'=>'control-label')); ?>
			<?= Form::input('alias', Input::post('alias', isset($room) ? $room->alias : ''),
								   array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Room type', 'room_type', array('class'=>'control-label')); ?>
			<?= Form::select('room_type', Input::post('room_type', isset($room) ? $room->room_type : ''),
									Model_Room_Type::listOptions(), array('class' => 'col-md-4 form-control')); ?>
		</div>

		<!--<div class="col-md-3">-->
		<!--	<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>-->
		<!--	<?= Form::select('rate_type', Input::post('rate_type', isset($guest_register) ? $guest_register->rate_type : ''), Model_Rate::listOptions(), array('class' => 'col-md-4 form-control')); ?>-->
		<!--</div>-->
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::select('status', Input::post('status', isset($room) ? $room->status : Model_Room::ROOM_STATUS_VACANT), Model_Room::$room_status, array('class' => 'col-md-4 form-control', 'readonly'=>isset($room) ? true : false)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('HK status', 'hk_status', array('class'=>'control-label')); ?>
			<?= Form::select('hk_status', Input::post('hk_status', isset($room) ? $room->hk_status : Model_Room::HK_STATUS_CLEAN),
			Model_Room::$hk_status, array('class' => 'col-md-4 form-control', 'readonly'=>isset($room) ? true : false)); ?>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<div class='col-md-6'>
			<?= Form::submit('submit', isset($room) ? 'Update' : 'Add room', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
