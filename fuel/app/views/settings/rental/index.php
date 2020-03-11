<h2 class="page-header">Settings <span class='text-muted'>Rental</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>


    <div class="form-group">
        <div class="col-md-4">
            <?= Form::hidden('require_deposit_pmt', Input::post('require_deposit_pmt', isset($rental_setting) ? $rental_setting->require_deposit_pmt : '0')); ?>
            <?= Form::checkbox('cb_require_deposit_pmt', null, array('class' => 'cb-checked', 'data-input' => 'require_deposit_pmt')); ?>
            <?= Form::label('Require deposit payment', 'cb_require_deposit_pmt', array('class'=>'control-label')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('No. of deposit to pay', 'no_of_deposit_to_pay', array('class'=>'control-label')); ?>
            <?= Form::select('no_of_deposit_to_pay', Input::post('no_of_deposit_to_pay', isset($rental_setting) ? $rental_setting->no_of_deposit_to_pay : ''), 
                            array('0', '1', '2', '3', '4', '5', '6'), 
                            array('class' => 'col-md-4 form-control require-deposit-pmt')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Rent due by', 'rent_due_by', array('class'=>'control-label')); ?>
            <?= Form::input('rent_due_by', Input::post('rent_due_by', isset($rental_setting) ? $rental_setting->rent_due_by : ''), 
                                    array('class' => 'col-md-4 form-control datepicker')); ?>
        </div>            
    </div>

    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($rental_setting) ? $rental_setting->fdesk_user : $uid)); ?>

    <hr>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>

<?= Form::close(); ?>

<script>
    $('#form_cb_require_deposit_pmt').on('change', function (e)
    {
        checked = $('#form_require_deposit_pmt').val();
        
        $('.require-deposit-pmt').each(function () {
            $(this).attr('disabled', checked == 1 ? false : true);
        });
    });

    if ($('#form_require_deposit_pmt').val() == '1')
    {
        $('.require-deposit-pmt').each(function () {
            $(this).attr('disabled', false);
        });
    } else {
        $('.require-deposit-pmt').each(function () {
            $(this).attr('disabled', true);
        });
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
