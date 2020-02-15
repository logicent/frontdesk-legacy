<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('First name', 'first_name', array('class'=>'control-label')); ?>
                <?= Form::input('first_name', Input::post('first_name', isset($reservation) ? $reservation->first_name : ''), 
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Last name', 'last_name', array('class'=>'control-label')); ?>
                <?= Form::input('last_name', Input::post('last_name', isset($reservation) ? $reservation->last_name : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
				<?= Form::input('email', Input::post('email', isset($reservation) ? $reservation->email : ''),
                                array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
				<?= Form::input('phone', Input::post('phone', isset($reservation) ? $reservation->phone : ''),
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('City', 'city', array('class'=>'control-label')); ?>
				<?= Form::input('city', Input::post('city', isset($reservation) ? $reservation->city : ''),
										array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Country', 'country', array('class'=>'control-label')); ?>
                <?= Form::select('country', Input::post('country', isset($reservation) ? $reservation->country : 
                                Model_Country::getDefaultCountry()), Model_Country::listOptions(false), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
			<?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?= Form::textarea('address', Input::post('address', isset($reservation) ? $reservation->address : ''),
                                array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
				<?= Form::select('id_type', Input::post('id_type', isset($reservation) ? $reservation->id_type : ''),
Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
                <?= Form::input('id_number', Input::post('id_number', isset($reservation) ? $reservation->id_number : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
                <?= Form::select('id_country', Input::post('id_country', isset($reservation) ? $reservation->id_country : ''), 
                                Model_Country::listOptions(true), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Unit no.', 'unit_id', array('class'=>'control-label')); ?>
                <?= Form::select('unit_id', Input::post('unit_id', isset($reservation) ? $reservation->unit_id : ''), 
                                Model_Unit::listOptions(isset($reservation) ? $reservation->unit_id : $unit->id), 
                                array('class' => 'col-md-4 form-control', 'id' => 'unit_id')); ?>
			</div>

			<div class="col-md-4">
                <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($reservation) ? $reservation->fdesk_user : $uid), 
                                array('class' => 'col-md-4 form-control')); ?>
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
                <?= Form::input('res_no', Input::post('res_no', isset($reservation) ? $reservation->res_no : 
                                Model_Facility_Reservation::getNextSerialNumber()), 
                                array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-5">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
                <?= Form::select('rate_type', Input::post('rate_type', isset($reservation) ? $reservation->rate_type : ''), 
                                Model_Rate::listOptions(isset($unit) ? $unit->unit_type : $reservation->unit->rm_type->id), 
                                array('class' => 'col-md-4 form-control', 'id' => 'rate_type')); ?>
			</div>

			<!--<div class="col-md-offset-3 col-md-4">-->
			<!--	<?php // Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>-->
            <!--	<?php // Form::input('voucher_no', Input::post('voucher_no', isset($reservation) ? $reservation->voucher_no : ''), 
                                        // array('class' => 'col-md-4 form-control')); ?>-->
			<!--</div>-->
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
                <?= Form::input('duration', Input::post('duration', isset($reservation) ? $reservation->duration : 
                                Model_Facility_Booking::getColumnDefault('duration')), 
                                array('class' => 'col-md-4 form-control', 'id' => 'duration', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
                <?= Form::input('checkin', Input::post('checkin', isset($reservation) ? strftime('%Y-%m-%d', strtotime($reservation->checkin)) : 
                                date('Y-m-d')), array('class' => 'col-md-4 form-control', 'id' => 'checkin')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
                <?= Form::input('checkout', Input::post('checkout', isset($reservation) ? strftime('%Y-%m-%d', strtotime($reservation->checkout)) : 
                                date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'id' => 'checkout')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
				<?= Form::input('pax_adults', Input::post('pax_adults', isset($reservation) ?
                                $reservation->pax_adults : Model_Facility_Booking::getColumnDefault('pax_adults')), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
				<?= Form::input('pax_children', Input::post('pax_children', isset($reservation) ?
                                $reservation->pax_children : Model_Facility_Booking::getColumnDefault('pax_children')), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-offset-1 col-md-4">
				<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
				<?= Form::hidden('status', Input::post('status', isset($reservation) ? $reservation->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)); ?>
                <?= Form::select('status', Input::post('status', isset($reservation) ? $reservation->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN), 
                                isset($reservation) ? Model_Facility_Reservation::$guest_status : array(Model_Facility_Reservation::RESERVATION_STATUS_OPEN => 'Open'), 
                                array('class' => 'col-md-4 form-control', 'disabled' => isset($reservation) ? true : false)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
                <?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($reservation) ? $reservation->remarks : ''), 
                                array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
			</div>
		</div>
	</div>
</div>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($reservation) ? 'Update' : 'Reserve', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
		<?php if (isset($reservation)): ?>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<!-- <a href="<?php // echo Uri::create('facility/reservation/confirm/'.$reservation->id); ?>" class="btn btn-default">Confirm booking</a> -->
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?= Form::close(); ?>

<script>
	$(function() {
		$('#unit_id').on('change', function(e) {
			$.get("<?= Uri::create('guest/register/rate_list_options'); ?>",
				{id:$(e.target).val()},
				function(data){
					if(data) // true
						console.log(data);
						//$('#rate_type').html(data);
				}
			);
		});
	});

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	var checkin = $('#checkin').datepicker({
			"format": "yyyy-mm-dd",
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			if (ev.date.valueOf() > checkout.date.valueOf()) {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
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
