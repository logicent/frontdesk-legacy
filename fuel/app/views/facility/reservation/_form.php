<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Registration no.', 'reg_no', array('class'=>'control-label')); ?>
                <?= Form::input('reg_no', Input::post('reg_no', isset($reservation) ? $reservation->reg_no : 
                                Model_Facility_Booking::getNextSerialNumber()), 
                                array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
            
			<div class="col-md-6">
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
                <?= Form::input('res_no', Input::post('res_no', isset($reservation) ? $reservation->res_no : 0), 
                                array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Folio no.', 'folio_no', array('class'=>'control-label')); ?>
                <?= Form::label(Html::anchor(Uri::create(isset($reservation->bill) ? 'sales/invoice/edit/'.  $reservation->bill->id : null), 
                    Input::post('folio_no', isset($reservation->bill) ? $reservation->bill->invoice_num : 0)), 'folio_no', array('class'=>'form-control')); ?>
				<?= Form::hidden('folio_no', Input::post('folio_no', isset($reservation->bill) ? $reservation->bill->invoice_num : 0)); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>
				<?= Form::input('voucher_no', Input::post('voucher_no', isset($reservation) ? $reservation->voucher_no : 0), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div><!--/.col-md-6-->

    <!-- Right Side -->
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-8">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
                <?= Form::select('rate_type', Input::post('rate_type', isset($reservation) ? $reservation->rate_type : ''), 
                                Model_Rate::listOptions(isset($unit) ? $unit->unit_type : $reservation->unit->type->id), 
                                array('class' => 'col-md-4 form-control', 'id' => 'rate_type')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Unit no.', 'unit_id', array('class'=>'control-label')); ?>
                <?= Form::select('unit_id', Input::post('unit_id', isset($reservation) ? $reservation->unit_id : ''), 
                                Model_Unit::listOptions(isset($reservation) ? $reservation->unit_id : $unit->id), 
                                array('class' => 'col-md-4 form-control', 'id' => 'unit_id')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
                <?= Form::input('checkin', Input::post('checkin', isset($reservation) ? 
                                strftime('%Y-%m-%d', strtotime($reservation->checkin)) : 
                                date('Y-m-d H:i')), array('class' => 'col-md-4 form-control', 'id' => 'checkin')); ?>
			</div>

			<div class="col-md-4">
    			<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
                <?= Form::input('checkout', Input::post('checkout', isset($reservation) ? 
                                strftime('%Y-%m-%d', strtotime($reservation->checkout)) : 
                                date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'id' => 'checkout')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
                <?= Form::input('duration', Input::post('duration', isset($reservation) ? $reservation->duration : 
                                Model_Facility_Booking::getColumnDefault('duration')), 
                                array('class' => 'col-md-4 form-control', 'id' => 'duration', 'readonly'=>true)); ?>
			</div>
		</div>
    </div><!--/.col-md-6-->
</div><!--/.row-->

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
            <div class="col-md-4">
                <?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
                <?= Form::select('sex', Input::post('sex', isset($reservation) ? $reservation->sex : ''), 
                                Model_Facility_Booking::$sex, array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class=" col-md-offset-2 col-md-6">
                <?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
                <?= Form::input('phone', Input::post('phone', isset($reservation) ? $reservation->phone : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
                <?= Form::select('id_type', Input::post('id_type', isset($reservation) ? $reservation->id_type : ''), 
                                Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-offset-2 col-md-6">
                <?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
                <?= Form::input('email', Input::post('email', isset($reservation) ? $reservation->email : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
                <?= Form::input('id_number', Input::post('id_number', isset($reservation) ? $reservation->id_number : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
                <?= Form::select('id_country', Input::post('id_country', isset($reservation) ? $reservation->id_country : ''), 
                                Model_Country::listOptions(true, ''), array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4">
                <?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
                <?= Form::input('pax_adults', Input::post('pax_adults', isset($reservation) ? $reservation->pax_adults : 
                                Model_Facility_Booking::getColumnDefault('pax_adults')), array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
                <?= Form::input('pax_children', Input::post('pax_children', isset($reservation) ? $reservation->pax_children : 
                                Model_Facility_Booking::getColumnDefault('pax_children')), array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
                <?= Form::select('status', Input::post('status', isset($reservation) ? $reservation->status : 
                                Model_Facility_Booking::GUEST_STATUS_CHECKED_IN), isset($reservation) ? 
                                Model_Facility_Booking::$guest_status : 
                                array(Model_Facility_Booking::GUEST_STATUS_CHECKED_IN => 'Checking In'), 
                                array('class' => 'col-md-4 form-control', 'disabled' => isset($reservation) ? true : false)); ?>
                <?= Form::hidden('status', Input::post('status', isset($reservation) ? $reservation->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('rate_amount', Input::post('rate_amount', isset($reservation) ? $reservation->rate_amount : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
                <?= Form::hidden('vat_amount', Input::post('vat_amount', isset($reservation) ? $reservation->vat_amount : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
                <?= Form::label('Total amount', 'total_amount', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <span class="input-group-addon">Kshs.</span>
                    <?= Form::input('total_amount', Input::post('total_amount', isset($reservation) ? $reservation->total_amount : 0), 
                                array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                    <!--<span class="input-group-addon">.00</span>-->
                </div>
                <?= Form::hidden('total_charge', Input::post('total_charge', isset($reservation) ? $reservation->total_charge : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Total payment', 'total_payment', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <span class="input-group-addon">Kshs.</span>                
                    <?= Form::input('total_payment', Input::post('total_payment', isset($reservation) ? $reservation->total_payment : 0), 
                                array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
                <?= Form::textarea('address', Input::post('address', isset($reservation) ? $reservation->address : ''), 
                                array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($reservation) ? $reservation->remarks : ''), 
                                array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
            </div>
        </div>
    </div>
</div>

    <div class="col-md-6">
        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($reservation) ? $reservation->fdesk_user : $uid)); ?>
    </div>

<hr>

<div class="form-group">
	<div class="col-md-3">
		<?= Form::submit('submit', isset($reservation) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

    <div class="col-md-3">
        <a href="<?= Uri::create('#unit/transfer'); ?>" class="btn btn-default">
            <i class="glyphicon glyphicon-random"></i>&ensp;Switch unit
        </a>
    </div>

	<div class="col-md-6">
		<?php if (isset($reservation)): ?>
		<div class="pull-right btn-toolbar">
			<?php if (!empty($reservation->bill)): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('cash/receipt/create/'.$reservation->id); ?>" class="btn btn-default">Receive money</a>
                </div>
                
				<div class="btn-group">
					<a href="<?= Uri::create('facility/reservation/checkout/'.$reservation->id); ?>" class="btn btn-default">Check out</a>
				</div>
			<?php endif ?>

			<?php if (!$reservation->bill): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/create/'.$reservation->id); ?>" class="btn btn-default" >Create folio</a>
				</div>
			<?php else: ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/edit/'.$reservation->bill->id); ?>" class="btn btn-default" >Edit folio</a>
				</div>
			<?php endif ?>
		</div>
		<?php endif ?>
	</div>
</div>

<?= Form::close(); ?>

<script>
	$(function(){
		$('#unit_id').on('change', function(e) {
			$.get("<?= Uri::create('facility/reservation/rate_list_options'); ?>",
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
