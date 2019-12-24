<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('First name', '', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->first_name : '', '', array('class' => 'form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Last name', 'last_name', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->last_name : '', '', array('class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->email : '', '',
array('class' => 'form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->phone : '', '',
array('class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('City', 'city', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->city : '', '',
										array('class' => 'form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Country', 'country', array('class'=>'control-label')); ?>
				<?= Form::select('country', Input::post('country', isset($fd_reservation) ? $fd_reservation->country : Model_Country::getDefaultCountry()), Model_Country::listOptions(false, ''), array('class' => 'form-control', 'disabled' => true)); ?>
			</div>
		</div>


		<div class="form-group">
			<div class="col-md-12">
			<?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?= Form::label(isset($fd_reservation) ? $fd_reservation->address : '', '',
array('class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
				<?= Form::select('id_type', Input::post('id_type', isset($fd_reservation) ? $fd_reservation->id_type : ''),
Model_Fd_Booking::$ID_type, array('class' => 'form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
				<?= Form::label(isset($fd_reservation) ? $fd_reservation->id_number : '', '', array('class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
				<?= Form::select('id_country', Input::post('id_country', isset($fd_reservation) ? $fd_reservation->id_country : ''), Model_Country::listOptions(true, ''), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Room no.', 'room_id', array('class'=>'control-label')); ?>
				<?= Form::select('room_id', Input::post('room_id', isset($fd_reservation) ? $fd_reservation->room_id : ''), Model_Room::listOptions(isset($fd_reservation) ? $fd_reservation->room_id : $room->id), array('class' => 'col-md-4 form-control', 'id' => 'room_id')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($fd_reservation) ? $fd_reservation->fdesk_user : $uid), array('class' => 'col-md-4 form-control')); ?>
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
				<?= Form::input('res_no', Input::post('res_no', isset($fd_reservation) ? $fd_reservation->res_no : Model_Fd_Reservation::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-5">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
				<?= Form::select('rate_type', Input::post('rate_type', isset($fd_reservation) ? $fd_reservation->rate_type : ''), Model_Rate::listOptions(isset($room) ? $room->room_type : $fd_reservation->room->rm_type->id), array('class' => 'col-md-4 form-control', 'id' => 'rate_type')); ?>
			</div>

			<!--<div class="col-md-offset-3 col-md-4">-->
			<!--	<?= Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>-->
			<!--	<?= Form::input('voucher_no', Input::post('voucher_no', isset($fd_reservation) ? $fd_reservation->voucher_no : ''), array('class' => 'col-md-4 form-control')); ?>-->
			<!--</div>-->
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
				<?= Form::input('duration', Input::post('duration', isset($fd_reservation) ? $fd_reservation->duration : Model_Fd_Booking::getColumnDefault('duration')), array('class' => 'col-md-4 form-control', 'id' => 'duration', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
				<?= Form::input('checkin', Input::post('checkin', isset($fd_reservation) ? strftime('%Y-%m-%d', strtotime($fd_reservation->checkin)) : date('Y-m-d')), array('class' => 'col-md-4 form-control', 'id' => 'checkin')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
				<?= Form::input('checkout', Input::post('checkout', isset($fd_reservation) ? strftime('%Y-%m-%d', strtotime($fd_reservation->checkout)) : date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'id' => 'checkout')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
				<?= Form::input('pax_adults', Input::post('pax_adults', isset($fd_reservation) ?
$fd_reservation->pax_adults : Model_Fd_Booking::getColumnDefault('pax_adults')), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
				<?= Form::input('pax_children', Input::post('pax_children', isset($fd_reservation) ?
$fd_reservation->pax_children : Model_Fd_Booking::getColumnDefault('pax_children')), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-offset-1 col-md-4">
				<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
				<?= Form::hidden('status', Input::post('status', isset($fd_reservation) ? $fd_reservation->status : Model_Fd_Booking::GUEST_STATUS_CHECKED_IN)); ?>
				<?= Form::select('status', Input::post('status', isset($fd_reservation) ? $fd_reservation->status : Model_Fd_Booking::GUEST_STATUS_CHECKED_IN), isset($fd_reservation) ? Model_Fd_Reservation::$guest_status : array(Model_Fd_Reservation::RESERVATION_STATUS_OPEN => 'Open'), array('class' => 'col-md-4 form-control', 'disabled' => isset($fd_reservation) ? true : false)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
			<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
			<?= Form::textarea('remarks', Input::post('remarks', isset($fd_reservation) ? $fd_reservation->remarks : ''), array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
			</div>
		</div>
	</div>
</div>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($fd_reservation) ? 'Update' : 'Reserve', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
		<?php if (isset($fd_reservation)): ?>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<a href="<?= Uri::create('fd/reservation/confirm/'.$fd_reservation->id); ?>" class="btn btn-warning">Confirm booking</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?= Form::close(); ?>
