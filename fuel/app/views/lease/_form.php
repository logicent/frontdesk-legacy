<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
            <div class="col-md-8">
                <?= Form::label('Title', 'title', array('class'=>'control-label')); ?>
                <?= Form::input('title', Input::post('title', isset($lease) ? $lease->title : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
                <?= Form::input('reference', Input::post('reference', isset($lease) ? $lease->reference : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-8">
                <?= Form::label('Premise use', 'premise_use', array('class'=>'control-label')); ?>
                <?= Form::input('premise_use', Input::post('premise_use', isset($lease) ? $lease->premise_use : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Unit', 'unit_id', array('class'=>'control-label')); ?>
                <?= Form::select('unit_id', Input::post('unit_id', isset($lease) ? $lease->unit_id : ''), 
                                isset($lease) ? Model_Unit::listOptions($lease->unit_id) : array(), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Start date', 'start_date', array('class'=>'control-label')); ?>
                <?= Form::input('start_date', Input::post('start_date', isset($lease) ? $lease->start_date : ''), 
                                array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('End date', 'end_date', array('class'=>'control-label')); ?>
                <?= Form::input('end_date', Input::post('end_date', isset($lease) ? $lease->end_date : ''), 
                                array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Billed period', 'billed_period', array('class'=>'control-label')); ?>
                <?= Form::select('billed_period', Input::post('billed_period', isset($lease) ? $lease->billed_period : ''),
                                        Model_Lease::listOptionsBilledPeriod(),
                                        array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Billed amount', 'billed_amount', array('class'=>'control-label')); ?>
                <?= Form::input('billed_amount', Input::post('billed_amount', isset($lease) ? $lease->billed_amount : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('require_deposit', Input::post('require_deposit', isset($lease) ? $lease->require_deposit : '0')); ?>
                <?= Form::checkbox('cb_require_deposit', null, array('class' => 'cb-checked', 'data-input' => 'require_deposit')); ?>
                <?= Form::label('Require deposit', 'cb_require_deposit', array('class'=>'control-label')); ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Deposit amount', 'deposit_amount', array('class'=>'control-label')); ?>
                <?= Form::input('deposit_amount', Input::post('deposit_amount', isset($lease) ? $lease->deposit_amount : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Deposit includes', 'deposit_includes', array('class'=>'control-label')); ?>
                <?= Form::textarea('deposit_includes', Input::post('deposit_includes', isset($lease) ? $lease->deposit_includes : ''), 
                                array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Owner', 'owner_id', array('class'=>'control-label')); ?>
                <?= Form::select('owner_id', Input::post('owner_id', isset($lease) ? $lease->owner_id : ''),
                                        Model_Property::listOptionsPropertyOwner(),
                                        array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Property', 'property_id', array('class'=>'control-label')); ?>
                <?= Form::select('property_id', Input::post('property_id', isset($lease) ? $lease->property_id : ''),
                                        isset($lease) ? Model_Property::listOptionsProperty($lease->owner_id) : array(),
                                        array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Customer', 'customer_id', array('class'=>'control-label')); ?>
                <?= Form::select('customer_id', Input::post('customer_id', isset($lease) ? $lease->customer_id : ''),
                                        Model_Customer::listOptions(['Tenant']),
                                        array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
                <?= Form::input('status', Input::post('status', isset($lease) ? $lease->status : ''), 
                                array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Date leased', 'date_leased', array('class'=>'control-label')); ?>
                <?= Form::input('date_leased', Input::post('date_leased', isset($lease) ? $lease->date_leased : ''), 
                                array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Lease period (months)', 'lease_period', array('class'=>'control-label')); ?>
                <?= Form::input('lease_period', Input::post('lease_period', isset($lease) ? $lease->lease_period : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Lease Agreement', 'attachments', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('attachments', Input::post('attachments', isset($lease) ? $lease->attachments : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                <?php 
                    if ($lease) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o text-info"></i>', 
                                        array('id' => 'add_img')) ?>
                    </span>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('unit/type/remove_img/' . $lease->id), '<i class="fa fa-trash-o text-red"></i>',
                                        array('id' => 'del_img', 'data-ph' => 'http://placehold.it/360x110')) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('on_hold', Input::post('on_hold', isset($lease) ? $lease->on_hold : '0')); ?>
                <?= Form::checkbox('cb_on_hold', null, array('class' => 'cb-checked', 'data-input' => 'on_hold')); ?>
                <?= Form::label('On hold', 'cb_on_hold', array('class'=>'control-label')); ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('On hold from', 'on_hold_from', array('class'=>'control-label')); ?>
                <?= Form::input('on_hold_from', Input::post('on_hold_from', isset($lease) ? $lease->on_hold_from : ''), 
                                array('class' => 'col-md-4 form-control on-hold datepicker')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('On hold to', 'on_hold_to', array('class'=>'control-label')); ?>
                <?= Form::input('on_hold_to', Input::post('on_hold_to', isset($lease) ? $lease->on_hold_to : ''), 
                                array('class' => 'col-md-4 form-control on-hold datepicker')); ?>
            </div>
        </div>
        
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($lease) ? $lease->remarks : ''), 
                                array('class' => 'col-md-8 form-control', 'rows' => 4)); ?>
            </div>
        </div>        
    </div>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($lease) ? $lease->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($lease) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>

<script>
    $(function() {
    // On hold should toggle readonly for on hold dates
        
        $('#form_cb_on_hold').on('change', function (e)
        {
            checked = $('#form_on_hold').val();
            
            $('.on-hold').each(function () {
                $(this).attr('disabled', checked == 1 ? false : true);
            });
        });

        if ($('#form_on_hold').val() == '1')
        {
            $('.on-hold').each(function () {
                $(this).attr('disabled', false);
            });
        } else {
            $('.on-hold').each(function () {
                $(this).attr('disabled', true);
            });
        }

	// Date picker validations

    // Fetch dependent drop down list options
        $('#form_owner_id').on('change', function() { 
            $.ajax({
                type: 'post',
                url: '/lease/get-property-list-options',
                // dataType: 'json',
                data: {
                    // console.log($(this).val());
                    'owner': $(this).val(),
                },
                success: function(listOptions) 
                {
                    var selectOptions = '<option value="" selected></option>';
                    $.each(JSON.parse(listOptions), function(index, listOption)               
                    {
                        selectOptions += '<option value="' + index + '">' + listOption + '</option>';
                    });
                    $('#form_property_id').html(selectOptions);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
        });

        $('#form_property_id').on('change', function() { 
            $.ajax({
                type: 'post',
                url: '/lease/get-unit-list-options',
                // dataType: 'json',
                data: {
                    'property': $(this).val(),
                },
                success: function(listOptions) 
                {
                    var selectOptions = '<option value="" selected></option>';
                    $.each(JSON.parse(listOptions), function(index, listOption)               
                    {
                        selectOptions += '<option value="' + index + '">' + listOption + '</option>';
                    });
                    $('#form_unit_id').html(selectOptions);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
        });
    });
</script>