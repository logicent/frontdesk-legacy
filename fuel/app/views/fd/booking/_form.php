<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-4">
				<?= Form::label('Registration no.', 'reg_no', array('class'=>'control-label')); ?>
				<?= Form::input('reg_no', Input::post('reg_no', isset($fd_booking) ? $fd_booking->reg_no : Model_Fd_Booking::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>

			<div class="col-md-offset-2 col-md-4">
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
				<?= Form::input('res_no', Input::post('res_no', isset($fd_booking) ? $fd_booking->res_no : 0), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4">
				<?= Form::label('Folio no.', 'folio_no', array('class'=>'control-label')); ?>
				<?= Form::label(Html::anchor(Uri::create(isset($fd_booking) ? 'sales/invoice/edit/'.  $fd_booking->bill->id : ''), Input::post('folio_no', isset($fd_booking) ? $fd_booking->bill->invoice_num : 0)), 'folio_no', array('class'=>'form-control')); ?>
				<?= Form::hidden('folio_no', Input::post('folio_no', isset($fd_booking) ? $fd_booking->bill->invoice_num : 0)); ?>
			</div>

			<div class="col-md-offset-2 col-md-4">
				<?= Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>
				<?= Form::input('voucher_no', Input::post('voucher_no', isset($fd_booking) ? $fd_booking->voucher_no : 0), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<fieldset>
			<!--<legend>Guest Information</legend>-->
			<div class="form-group">
				<div class="col-md-6">
					<?= Form::label('First name', 'first_name', array('class'=>'control-label')); ?>
					<?= Form::input('first_name', Input::post('first_name', isset($fd_booking) ? $fd_booking->first_name : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Last name', 'last_name', array('class'=>'control-label')); ?>
					<?= Form::input('last_name', Input::post('last_name', isset($fd_booking) ? $fd_booking->last_name : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
					<?= Form::select('sex', Input::post('sex', isset($fd_booking) ? $fd_booking->sex : ''), Model_Fd_Booking::$sex, array('class' => 'col-md-4 form-control')); ?>
				</div>

				<div class=" col-md-offset-2 col-md-6">
					<?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
					<?= Form::input('phone', Input::post('phone', isset($fd_booking) ? $fd_booking->phone : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>

			<!-- <div class="form-group">
				<div class="col-md-6">
					<?php //= Form::label('City', 'city', array('class'=>'control-label')); ?>
					<?php //= Form::input('city', Input::post('city', isset($fd_booking) ? $fd_booking->city : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>

				<div class="col-md-6">
					<?php //= Form::label('Country', 'country', array('class'=>'control-label')); ?>
					<?php //= Form::select('country', Input::post('country', isset($fd_booking) ? $fd_booking->country : Model_Country::getDefaultCountry()), Model_Country::listOptions(false, ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div> -->

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
					<?= Form::select('id_type', Input::post('id_type', isset($fd_booking) ? $fd_booking->id_type : ''), Model_Fd_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
				</div>

				<div class="col-md-offset-2 col-md-6">
			<?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
			<?= Form::input('email', Input::post('email', isset($fd_booking) ? $fd_booking->email : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6">
					<?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
					<?= Form::input('id_number', Input::post('id_number', isset($fd_booking) ? $fd_booking->id_number : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
					<?= Form::select('id_country', Input::post('id_country', isset($fd_booking) ? $fd_booking->id_country : ''), Model_Country::listOptions(true, ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>
		</fieldset>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
				<?= Form::select('rate_type', Input::post('rate_type', isset($fd_booking) ? $fd_booking->rate_type : ''), Model_Rate::listOptions(isset($room) ? $room->room_type : $fd_booking->room->rm_type->id), array('class' => 'col-md-4 form-control', 'id' => 'rate_type')); ?>
			</div>

			<!-- <div class="col-md-4">
				<label class='control-label'>&nbsp;</label><br>
				<a href="<?= Uri::create('#room/transfer'); ?>" class="btn btn-xs btn-default disabled">
					<i class="glyphicon glyphicon-link"></i> Change ...
				</a>
			</div> -->

			<div class="col-md-4">
				<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
				<?= Form::hidden('status', Input::post('status', isset($fd_booking) ? $fd_booking->status : Model_Fd_Booking::GUEST_STATUS_CHECKED_IN)); ?>
				<?= Form::select('status', Input::post('status', isset($fd_booking) ? $fd_booking->status : Model_Fd_Booking::GUEST_STATUS_CHECKED_IN), isset($fd_booking) ? Model_Fd_Booking::$guest_status : array(Model_Fd_Booking::GUEST_STATUS_CHECKED_IN => 'Checking In'), array('class' => 'col-md-4 form-control', 'disabled' => isset($fd_booking) ? true : false)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Room no.', 'room_id', array('class'=>'control-label')); ?>
				<?= Form::select('room_id', Input::post('room_id', isset($fd_booking) ? $fd_booking->room_id : ''), Model_Room::listOptions(isset($fd_booking) ? $fd_booking->room_id : $room->id), array('class' => 'col-md-4 form-control', 'id' => 'room_id')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
				<?= Form::input('duration', Input::post('duration', isset($fd_booking) ? $fd_booking->duration : Model_Fd_Booking::getColumnDefault('duration')), array('class' => 'col-md-4 form-control', 'id' => 'duration', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
				<?= Form::input('checkin', Input::post('checkin', isset($fd_booking) ? strftime('%Y-%m-%d', strtotime($fd_booking->checkin)) : date('Y-m-d H:i')), array('class' => 'col-md-4 form-control', 'id' => 'checkin')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
				<?= Form::input('pax_adults', Input::post('pax_adults', isset($fd_booking) ? $fd_booking->pax_adults : Model_Fd_Booking::getColumnDefault('pax_adults')), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
				<?= Form::input('pax_children', Input::post('pax_children', isset($fd_booking) ? $fd_booking->pax_children : Model_Fd_Booking::getColumnDefault('pax_children')), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-4">
			<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
				<?= Form::input('checkout', Input::post('checkout', isset($fd_booking) ? strftime('%Y-%m-%d', strtotime($fd_booking->checkout)) : date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'id' => 'checkout')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
			<?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?= Form::textarea('address', Input::post('address', isset($fd_booking) ? $fd_booking->address : ''), array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
			</div>
			<div class="col-md-6">
			<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
			<?= Form::textarea('remarks', Input::post('remarks', isset($fd_booking) ? $fd_booking->remarks : ''), array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::hidden('rate_amount', Input::post('rate_amount', isset($fd_booking) ? $fd_booking->rate_amount : 0), array('class' => 'col-md-4 form-control')); ?>
				<?= Form::hidden('vat_amount', Input::post('vat_amount', isset($fd_booking) ? $fd_booking->vat_amount : 0), array('class' => 'col-md-4 form-control')); ?>
				<?= Form::label('Total amount', 'total_amount', array('class'=>'control-label')); ?>
				<?= Form::input('total_amount', Input::post('total_amount', isset($fd_booking) ? $fd_booking->total_amount : 0), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
				<!--<div class="input-group">-->
				<!--	<span class="input-group-addon">Kshs.</span>-->
				<?= Form::hidden('total_charge', Input::post('total_charge', isset($fd_booking) ? $fd_booking->total_charge : 0), array('class' => 'col-md-4 form-control')); ?>
				<!--	<span class="input-group-addon">.00</span>-->
				<!--</div>-->
			</div>

			<div class="col-md-6">
				<?= Form::label('Total payment', 'total_payment', array('class'=>'control-label')); ?>
				<?= Form::input('total_payment', Input::post('total_payment', isset($fd_booking) ? $fd_booking->total_payment : 0), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<fieldset>
			<!--<legend>Payment Options</legend>-->
			<div class="form-group">
				<!-- <div class="col-md-4">
					<?= Form::label('Payment type', 'payment_type', array('class'=>'control-label')); ?>
					<?= Form::select('payment_type', Input::post('payment_type', isset($fd_booking) ? $fd_booking->payment_type : ''), Model_Cash_Receipt::$payment_type, array('class' => 'col-md-4 form-control')); ?>
				</div> -->

<!--				<div class="col-md-offset-2 col-md-6">
					<?php //echo Form::label('Verify Code', 'verify_code', array('class'=>'control-label')); ?>
					<?php //echo Form::input('verify_code', Input::post('verify_code', isset($fd_booking) ? $fd_booking->verify_code : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>-->
			</div>

			<div class="form-group">
				<!-- <div class="col-md-4">
					<?= Form::label('Card type', 'card_type', array('class'=>'control-label')); ?>
					<?= Form::select('card_type', Input::post('card_type', isset($fd_booking) ? $fd_booking->card_type : ''), Model_Cash_Receipt::$card_type, array('class' => 'col-md-4 form-control')); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
					<?= Form::label('Card expire', 'card_expire', array('class'=>'control-label')); ?>
					<?= Form::input('card_expire', Input::post('card_expire', isset($fd_booking) ? $fd_booking->card_expire : ''), array('class' => 'col-md-4 form-control')); ?>
				</div>
				<div class="col-md-offset-2 col-md-6">
					<?= Form::label('Card no.', 'card_no', array('class'=>'control-label')); ?>
					<?= Form::input('card_no', Input::post('card_no', isset($fd_booking) ? $fd_booking->card_no : ''), array('class' => 'col-md-4 form-control')); ?>
				</div> -->
				<div class="col-md-6">
					<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($fd_booking) ? $fd_booking->fdesk_user : $uid)); ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($fd_booking) ? 'Update' : 'Register', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
		<?php if (isset($fd_booking)): ?>
		<div class="pull-right btn-toolbar">
			<?php if (!empty($fd_booking->bill)): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('cash/receipt/create/'.$fd_booking->id); ?>" class="btn btn-warning">Receive money</a>
				</div>
				<div class="btn-group">
					<a href="<?= Uri::create('fd/booking/checkout/'.$fd_booking->id); ?>" class="btn btn-warning">Check out</a>
				</div>
			<?php endif; ?>

			<?php if (!$fd_booking->bill): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/create/'.$fd_booking->id); ?>" class="btn btn-warning" >Create folio</a>
				</div>
			<?php else: ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/edit/'.$fd_booking->bill->id); ?>" class="btn btn-warning" >Edit folio</a>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</div>

<?= Form::close(); ?>

<script>
	$(function(){
		$('#room_id').on('change', function(e) {
			$.get("<?= Uri::create('fd/booking/rate_list_options'); ?>",
				{id:$(e.target).val()},
				function(data){
					if(data) // true
						console.log(data);
						//$('#rate_type').html(data);
				}
			);
		});
	});
	// Clear default date values 0000-00-00
	var cardExpDate = $('#form_card_expire').val();
	if (cardExpDate == '0000-00-00')
		$('#form_card_expire').val('');

	// Date range picker for Booking
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate() - 2, 0, 0, 0, 0);

    var checkin = $('#checkin').datepicker({
			"format": "yyyy-mm-dd",
		    onRender: function(date) {
		    	return date.valueOf() < now.valueOf() ? 'disabled' : '';
		    }
	    }).on('changeDate', function(ev) {
		    if (ev.date.valueOf() > checkout.date.valueOf()) {
			    var newDate = new Date(ev.date)
			    newDate.setDate(newDate.getDate() - 2);
			    checkout.setValue(newDate);
		    }
		    checkin.hide();

		    $('#checkout')[0].focus();
	    }).data('datepicker');

    var checkout = $('#checkout').datepicker({
			"format": "yyyy-mm-dd",
	    	onRender: function(date) {
	    		return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
	    }
	    }).on('changeDate', function(ev) {
	    	checkout.hide();
    }).data('datepicker');
</script>
