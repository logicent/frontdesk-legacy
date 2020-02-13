<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-4">
				<?= Form::label('Registration no.', 'reg_no', array('class'=>'control-label')); ?>
				<?= Form::input('reg_no', Input::post('reg_no', isset($booking) ? $booking->reg_no : Model_Facility_Booking::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>

			<div class="col-md-offset-2 col-md-4">
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
				<?= Form::input('res_no', Input::post('res_no', isset($booking) ? $booking->res_no : ''), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4">
				<?= Form::label('Folio no.', 'folio_no', array('class'=>'control-label')); ?>
				<?= Form::input('folio_no', Input::post('folio_no', isset($booking) ? $booking->bill->invoice_num : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>

			<div class="col-md-offset-2 col-md-4">
				<?= Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>
				<?= Form::input('voucher_no', Input::post('voucher_no', isset($booking) ? $booking->voucher_no : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
		</div>

		<fieldset>
			<!--<legend>Guest Information</legend>-->
			<div class="form-group">
				<div class="col-md-6">
					<?= Form::label('First name', 'first_name', array('class'=>'control-label')); ?>
					<?= Form::input('first_name', Input::post('first_name', isset($booking) ? $booking->first_name : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Last name', 'last_name', array('class'=>'control-label')); ?>
					<?= Form::input('last_name', Input::post('last_name', isset($booking) ? $booking->last_name : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>
			</div>

			<!-- <div class="form-group">
				<div class="col-md-4">
				</div>
			</div> -->

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
					<?= Form::select('sex', Input::post('sex', isset($booking) ? $booking->sex : ''), Model_Facility_Booking::$sex, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>

				<div class=" col-md-offset-2 col-md-6">
					<?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
					<?= Form::input('phone', Input::post('phone', isset($booking) ? $booking->phone : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>
			</div>

			<!-- <div class="form-group">
				<div class="col-md-6">
					<?= Form::label('City', 'city', array('class'=>'control-label')); ?>
					<?= Form::input('city', Input::post('city', isset($booking) ? $booking->city : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Country', 'country', array('class'=>'control-label')); ?>
					<?= Form::select('country', Input::post('country', isset($booking) ? $booking->country : Model_Country::getDefaultCountry()), Model_Country::listOptions(false, ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div> -->

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
					<?= Form::select('id_type', Input::post('id_type', isset($booking) ? $booking->id_type : ''), Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>

				<div class="col-md-offset-2 col-md-6">
			<?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
			<?= Form::input('email', Input::post('email', isset($booking) ? $booking->email : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6">
					<?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
					<?= Form::input('id_number', Input::post('id_number', isset($booking) ? $booking->id_number : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
					<?= Form::select('id_country', Input::post('id_country', isset($booking) ? $booking->id_country : ''), Model_Country::listOptions(true, ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
				</div>
			</div>
		</fieldset>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
				<?= Form::select('rate_type', Input::post('rate_type', isset($booking) ? $booking->rate_type : ''), Model_Rate::listOptions(isset($room) ? $room->room_type : $booking->room->rm_type->id), array('class' => 'col-md-4 form-control', 'id' => 'rate_type', 'readonly' => true)); ?>
			</div>

			<!-- <div class="col-md-4">
				<label class='control-label'>&nbsp;</label><br>
				<a href="<?= Uri::create('#room/transfer'); ?>" class="btn btn-default btn-xs btn-default disabled">
					<i class="glyphicon glyphicon-link"></i> Change ...
				</a>
			</div> -->

			<div class="col-md-4">
				<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
				<?= Form::hidden('status', Input::post('status', isset($booking) ? $booking->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)); ?>
				<?= Form::select('status', Input::post('status', isset($booking) ? $booking->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN), isset($booking) ? Model_Facility_Booking::$guest_status : array(Model_Facility_Booking::GUEST_STATUS_CHECKED_IN => 'Checking In'), array('class' => 'col-md-4 form-control', 'disabled' => isset($booking) ? true : false)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Room no.', 'room_id', array('class'=>'control-label')); ?>
				<?= Form::select('room_id', Input::post('room_id', isset($booking) ? $booking->room_id : ''), Model_Room::listOptions(isset($booking) ? $booking->room_id : $room->id), array('class' => 'col-md-4 form-control', 'id' => 'room_id')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
				<?= Form::input('duration', Input::post('duration', isset($booking) ? $booking->duration : Model_Facility_Booking::getColumnDefault('duration')), array('class' => 'col-md-4 form-control', 'id' => 'duration', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
				<?= Form::input('checkin', Input::post('checkin', isset($booking) ? strftime('%Y-%m-%d', strtotime($booking->checkin)) : date('Y-m-d')), array('class' => 'col-md-4 form-control', 'readonly' => true, 'id' => 'checkin')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
				<?= Form::input('pax_adults', Input::post('pax_adults', isset($booking) ? $booking->pax_adults : Model_Facility_Booking::getColumnDefault('pax_adults')), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
				<?= Form::input('pax_children', Input::post('pax_children', isset($booking) ? $booking->pax_children : Model_Facility_Booking::getColumnDefault('pax_children')), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>

			<div class="col-md-4">
			<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
				<?= Form::input('checkout', Input::post('checkout', isset($booking) ? strftime('%Y-%m-%d', strtotime($booking->checkout)) : date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'readonly' => true, 'id' => 'checkout')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
			<?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?= Form::textarea('address', Input::post('address', isset($booking) ? $booking->address : ''), array('class' => 'col-md-4 form-control', 'readonly' => true, 'rows' => 4)); ?>
			</div>
			<div class="col-md-6">
			<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
			<?= Form::textarea('remarks', Input::post('remarks', isset($booking) ? $booking->remarks : ''), array('class' => 'col-md-8 form-control', 'readonly' => true, 'rows' => 4)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::hidden('rate_amount', Input::post('rate_amount', isset($booking) ? $booking->rate_amount : ''), array('class' => 'col-md-4 form-control')); ?>
				<?= Form::hidden('vat_amount', Input::post('vat_amount', isset($booking) ? $booking->vat_amount : ''), array('class' => 'col-md-4 form-control')); ?>
				<?= Form::label('Total amount', 'total_amount', array('class'=>'control-label')); ?>
				<?= Form::input('total_amount', Input::post('total_amount', isset($booking) ? $booking->total_amount : ''), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
				<!--<div class="input-group">-->
				<!--	<span class="input-group-addon">Kshs.</span>-->
				<?= Form::hidden('total_charge', Input::post('total_charge', isset($booking) ? $booking->total_charge : ''), array('class' => 'col-md-4 form-control')); ?>
				<!--	<span class="input-group-addon">.00</span>-->
				<!--</div>-->
			</div>

			<div class="col-md-6">
				<?= Form::label('Total payment', 'total_payment', array('class'=>'control-label')); ?>
				<?= Form::input('total_payment', Input::post('total_payment', isset($booking) ? $booking->total_payment : ''), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<fieldset>
			<!--<legend>Payment Options</legend>-->
			<div class="form-group">
				<!-- <div class="col-md-4">
					<?= Form::label('Payment type', 'payment_type', array('class'=>'control-label')); ?>
					<?= Form::select('payment_type', Input::post('payment_type', isset($booking) ? $booking->payment_type : ''), Model_Accounts_Payment_Receipt::$payment_type, array('class' => 'col-md-4 form-control')); ?>
				</div> -->

<!--				<div class="col-md-offset-2 col-md-6">
					<?php //echo Form::label('Verify Code', 'verify_code', array('class'=>'control-label')); ?>
					<?php //echo Form::input('verify_code', Input::post('verify_code', isset($booking) ? $booking->verify_code : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>-->
			</div>

			<div class="form-group">
				<!-- <div class="col-md-4">
					<?= Form::label('Card type', 'card_type', array('class'=>'control-label')); ?>
					<?= Form::select('card_type', Input::post('card_type', isset($booking) ? $booking->card_type : ''), Model_Accounts_Payment_Receipt::$card_type, array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('Card expire', 'card_expire', array('class'=>'control-label')); ?>
					<?= Form::input('card_expire', Input::post('card_expire', isset($booking) ? $booking->card_expire : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
				<div class="col-md-offset-2 col-md-6">
					<?= Form::label('Card no.', 'card_no', array('class'=>'control-label')); ?>
					<?= Form::input('card_no', Input::post('card_no', isset($booking) ? $booking->card_no : ''), array('class' => 'col-md-4 form-control')); ?>
				</div> -->
				<div class="col-md-6">
					<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($booking) ? $booking->fdesk_user : $uid)); ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?php if ($booking->status == 'CI') : ?>
			<a href="<?= Uri::create('facility/booking/edit/'.$booking->id); ?>" class="btn btn-primary" >Edit booking</a>
		<?php endif ?>
		<a href="<?= Uri::create('registers/bookings'); ?>" class="btn btn-primary">Close</a>
	</div>

	<div class="col-md-6">
		<?php if (isset($booking)): ?>
		<div class="pull-right btn-toolbar">
			<?php if (!$booking->bill): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/create/'.$booking->id); ?>" class="btn btn-default" >Create invoice</a>
				</div>
			<?php endif; ?>

			<?php if ($booking->status == 'CI') : ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/edit/'.$booking->id); ?>" class="btn btn-default" >Edit invoice</a>
				</div>
			<?php endif; ?>

			<?php if ($booking->status == 'CI') : ?>
				<div class="btn-group">
					<a href="<?= Uri::create('cash/receipt/create/'.$booking->id); ?>" class="btn btn-default">Receive money</a>
				</div>
				<div class="btn-group">
					<a href="<?= Uri::create('facility/booking/checkout/'.$booking->id); ?>" class="btn btn-default">Check out</a>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</div>

<?= Form::close(); ?>
