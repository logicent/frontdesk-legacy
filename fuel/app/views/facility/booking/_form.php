<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Registration no.', 'reg_no', array('class'=>'control-label')); ?>
                <?= Form::input('reg_no', Input::post('reg_no', isset($booking) ? $booking->reg_no : 
                                Model_Facility_Booking::getNextSerialNumber()), 
                                array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
            
			<div class="col-md-6">
				<?= Form::label('Reservation no.', 'res_no', array('class'=>'control-label')); ?>
                <?= Form::input('res_no', Input::post('res_no', isset($booking) ? $booking->res_no : 0), 
                                array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Folio no.', 'folio_no', array('class'=>'control-label')); ?>
                <?= Form::label(Html::anchor(Uri::create(isset($booking->bill) ? 'sales/invoice/edit/'.  $booking->bill->id : null), 
                    Input::post('folio_no', isset($booking->bill) ? $booking->bill->invoice_num : 0)), 'folio_no', array('class'=>'form-control')); ?>
				<?= Form::hidden('folio_no', Input::post('folio_no', isset($booking->bill) ? $booking->bill->invoice_num : 0)); ?>
			</div>

			<div class="col-md-6">
				<?= Form::label('Voucher no.', 'voucher_no', array('class'=>'control-label')); ?>
				<?= Form::input('voucher_no', Input::post('voucher_no', isset($booking) ? $booking->voucher_no : 0), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>
	</div><!--/.col-md-6-->

    <!-- Right Side -->
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-8">
				<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>
                <?= Form::select('rate_type', Input::post('rate_type', isset($booking) ? $booking->rate_type : ''), 
                                Model_Rate::listOptions(isset($booking) ? $booking->unit->type->id : ''), 
                                array('class' => 'col-md-4 form-control', 'id' => 'rate_type')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Unit no.', 'unit_id', array('class'=>'control-label')); ?>
                <?= Form::select('unit_id', Input::post('unit_id', isset($booking) ? $booking->unit_id : ''), 
                                Model_Unit::listOptions(isset($booking) ? $booking->unit_id : ''), 
                                array('class' => 'col-md-4 form-control', 'id' => 'unit_id')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-4">
				<?= Form::label('Check-in', 'checkin', array('class'=>'control-label')); ?>
                <?= Form::input('checkin', Input::post('checkin', isset($booking) ? 
                                strftime('%Y-%m-%d', strtotime($booking->checkin)) : 
                                date('Y-m-d H:i')), array('class' => 'col-md-4 form-control', 'id' => 'checkin')); ?>
			</div>

			<div class="col-md-4">
    			<?= Form::label('Check-out', 'checkout', array('class'=>'control-label')); ?>
                <?= Form::input('checkout', Input::post('checkout', isset($booking) ? 
                                strftime('%Y-%m-%d', strtotime($booking->checkout)) : 
                                date('Y-m-d', strtotime('+1 day'))), array('class' => 'col-md-4 form-control', 'id' => 'checkout')); ?>
			</div>

			<div class="col-md-4">
				<?= Form::label('Nights', 'duration', array('class'=>'control-label')); ?>
                <?= Form::input('duration', Input::post('duration', isset($booking) ? $booking->duration : 
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
                <?= Form::label('Customer name', 'customer_id', array('class'=>'control-label')); ?>
                <?= Form::hidden('customer_name', Input::post('customer_name', isset($booking) ? $booking->customer_name : '')) ?>
                <?= Form::select('customer_id', Input::post('customer_id', isset($booking) ? $booking->customer_id : ''), 
                        Model_Customer::listOptions([Model_Customer::CUSTOMER_TYPE_GUEST]), 
                        array('class' => 'col-md-4 form-control', 'autofocus' => true, 'id' => 'customer_id')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
                <?= Form::select('sex', Input::post('sex', isset($booking) ? $booking->sex : ''), 
                                Model_Facility_Booking::$sex, array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
                <?= Form::input('email', Input::post('email', isset($booking) ? $booking->email : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
                <?= Form::input('phone', Input::post('phone', isset($booking) ? $booking->phone : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID type', 'id_type', array('class'=>'control-label')); ?>
                <?= Form::select('id_type', Input::post('id_type', isset($booking) ? $booking->id_type : ''), 
                                Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID number', 'id_number', array('class'=>'control-label')); ?>
                <?= Form::input('id_number', Input::post('id_number', isset($booking) ? $booking->id_number : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('ID country', 'id_country', array('class'=>'control-label')); ?>
                <?= Form::select('id_country', Input::post('id_country', isset($booking) ? $booking->id_country : ''), 
                                Model_Country::listOptions(true, ''), array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4">
                <?= Form::label('Adults', 'pax_adults', array('class'=>'control-label')); ?>
                <?= Form::input('pax_adults', Input::post('pax_adults', isset($booking) ? $booking->pax_adults : 
                                Model_Facility_Booking::getColumnDefault('pax_adults')), array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Children', 'pax_children', array('class'=>'control-label')); ?>
                <?= Form::input('pax_children', Input::post('pax_children', isset($booking) ? $booking->pax_children : 
                                Model_Facility_Booking::getColumnDefault('pax_children')), array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
                <?= Form::select('status', Input::post('status', isset($booking) ? $booking->status : 
                                Model_Facility_Booking::GUEST_STATUS_CHECKED_IN), isset($booking) ? 
                                Model_Facility_Booking::$guest_status : 
                                array(Model_Facility_Booking::GUEST_STATUS_CHECKED_IN => 'Checking In'), 
                                array('class' => 'col-md-4 form-control', 'disabled' => isset($booking) ? true : false)); ?>
                <?= Form::hidden('status', Input::post('status', isset($booking) ? $booking->status : Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('rate_amount', Input::post('rate_amount', isset($booking) ? $booking->rate_amount : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
                <?= Form::hidden('vat_amount', Input::post('vat_amount', isset($booking) ? $booking->vat_amount : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
                <?= Form::label('Total amount', 'total_amount', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <span class="input-group-addon">Kshs.</span>
                    <?= Form::input('total_amount', Input::post('total_amount', isset($booking) ? $booking->total_amount : 0), 
                                array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                    <!--<span class="input-group-addon">.00</span>-->
                </div>
                <?= Form::hidden('total_charge', Input::post('total_charge', isset($booking) ? $booking->total_charge : 0), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Total payment', 'total_payment', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <span class="input-group-addon">Kshs.</span>                
                    <?= Form::input('total_payment', Input::post('total_payment', isset($booking) ? $booking->total_payment : 0), 
                                array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
                <?= Form::textarea('address', Input::post('address', isset($booking) ? $booking->address : ''), 
                                array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($booking) ? $booking->remarks : ''), 
                                array('class' => 'col-md-8 form-control', 'rows' => 5)); ?>
            </div>
        </div>
    </div>
</div>

    <div class="col-md-6">
        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($booking) ? $booking->fdesk_user : $uid)); ?>
    </div>

<hr>

<div class="form-group">
	<div class="col-md-3">
		<?= Form::submit('submit', isset($booking) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

    <div class="col-md-3">
<!--
        <a href="<?php // Uri::create('#unit/transfer'); ?>" class="btn btn-default">
            <i class="glyphicon glyphicon-random"></i>&ensp;Switch unit
        </a>
-->        
    </div>

	<div class="col-md-6">
		<?php if (isset($booking)): ?>
		<div class="pull-right btn-toolbar">
			<?php if (!empty($booking->bill)): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('accounts/payment/receipt/create/'.$booking->id); ?>" class="btn btn-default">Receive money</a>
                </div>
                
				<div class="btn-group">
					<a href="<?= Uri::create('facility/booking/checkout/'.$booking->id); ?>" class="btn btn-default">Check out</a>
				</div>
			<?php endif ?>

			<?php if (!$booking->bill): ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/create/'.$booking->id); ?>" class="btn btn-default" >Create folio</a>
				</div>
			<?php else: ?>
				<div class="btn-group">
					<a href="<?= Uri::create('sales/invoice/edit/'.$booking->bill->id); ?>" class="btn btn-default" >Edit folio</a>
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
			$.get("<?= Uri::create('facility/booking/rate_list_options'); ?>",
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
