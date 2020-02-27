<h2 class="page-header">Settings <span class='text-muted'>Rental</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::checkbox('require_deposit_pmt', Input::post('require_deposit_pmt', isset($rental_setting) ? $rental_setting->require_deposit_pmt : '0'), 
                                        array('class' => 'cb-checked')); ?>
                <?= Form::label('Require deposit payment', 'require_deposit_pmt', array('class'=>'control-label')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('No. of monthly deposit to pay', 'monthly_deposit_to_pay', array('class'=>'control-label')); ?>
                <?= Form::select('rate_type', Input::post('monthly_deposit_to_pay', isset($rental_setting) ? $rental_setting->monthly_deposit_to_pay : ''), 
                                array('0', '1', '2', '3', '4', '5', '6'), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Rent due by', 'rent_due_by', array('class'=>'control-label')); ?>
                <?= Form::input('rent_due_by', Input::post('rent_due_by', isset($rental_setting) ? $rental_setting->rent_due_by : ''), 
                                        array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>            
        </div>

        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property) ? $property->fdesk_user : $uid)); ?>

        <hr>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>

<?= Form::close(); ?>

<script>
	$('.cb-checked').click(function() {
	    if ($(this).is(':checked')) // true
	        $('#form_require_deposit_pmt').val(1);
	    else $('#form_require_deposit_pmt').val(0);
    });

    if ($('.cb-checked').val() == '1') {
        $('#form_require_deposit_pmt').attr('checked', true);
	}

	// Date range picker for Booking
	var nowTemp = new Date();
	var today = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate());

	$('.datepicker').datepicker({
		"format" : "yyyy-mm-dd",
		"viewMode" : "days",
	}).on('changeDate', function(ev) {
		$(this).datepicker('hide');
		// set focus back to datepicker control
	});
</script>
