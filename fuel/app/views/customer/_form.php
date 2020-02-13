<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Full name', 'customer_name', array('class'=>'control-label')); ?>
                <?= Form::input('customer_name', Input::post('customer_name', isset($customer) ? $customer->customer_name : ''), 
                                                            array('class' => 'col-md-4 form-control')); ?>
			</div>
            
			<div class="col-md-6">
				<?= Form::label('Account manager', 'account_manager', array('class'=>'control-label')); ?>
                <?= Form::select('account_manager', Input::post('account_manager', isset($customer) ? $customer->account_manager : ''), 
                                                                Model_User::listOptions(), 
                                                                array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
			</div>
		</div>
    
		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Type', 'customer_type', array('class'=>'control-label')); ?>
                <?= Form::select('customer_type', Input::post('customer_type', isset($customer) ? $customer->customer_type : ''), 
                                                                Model_Customer::listOptionsCustomerType(), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
<!--
            <div class="col-md-6">
				<?php // Form::label('Customer group', 'customer_group', array('class'=>'control-label')); ?>
                <?php // Form::select('customer_group', Input::post('customer_group', isset($customer) ? $customer->customer_group : ''), 
                        //                                        Model_Customer::listOptionsCustomerGroup(), 
                        //                                        array('class' => 'col-md-4 form-control')); ?>
			</div>
-->
            <div class="col-md-6">
				<?= Form::label('Tax ID', 'tax_ID', array('class'=>'control-label')); ?>
                <?= Form::input('tax_ID', Input::post('tax_ID', isset($customer) ? $customer->tax_ID : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>        
        </div>

		<div class="form-group">
            <div class="col-md-6">
                <?php echo Form::checkbox('inactive', Input::post('inactive', isset($customer) ? $customer->inactive : '0'), 
                                        array('class' => 'cb-checked')); ?>
                <?php echo Form::label('Inactive', 'inactive', array('class'=>'control-label')); ?>
			</div>
            
            <div class="col-md-6">
                <?php echo Form::checkbox('is_internal_customer', Input::post('is_internal_customer', isset($customer) ? $customer->is_internal_customer : '0'), 
                                        array('class' => 'cb-checked')); ?>
                <?php echo Form::label('Is internal customer', 'is_internal_customer', array('class'=>'control-label')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Email address', 'email_address', array('class'=>'control-label')); ?>
                <?= Form::input('email_address', Input::post('email_address', isset($customer) ? $customer->email_address : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>        

            <div class="col-md-6">
				<?= Form::label('Mobile phone', 'mobile_phone', array('class'=>'control-label')); ?>
                <?= Form::input('mobile_phone', Input::post('mobile_phone', isset($customer) ? $customer->mobile_phone : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID type', 'ID_type', array('class'=>'control-label')); ?>
                <?= Form::select('ID_type', Input::post('ID_type', isset($customer) ? $customer->ID_type : ''), 
                                Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('ID no.', 'ID_no', array('class'=>'control-label')); ?>
                <?= Form::input('ID_no', Input::post('ID_no', isset($customer) ? $customer->ID_no : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID country', 'ID_country', array('class'=>'control-label')); ?>
                <?= Form::select('ID_country', Input::post('ID_country', isset($customer) ? $customer->ID_country : ''), 
                                Model_Country::listOptions(true), array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
	</div><!--/.col-md-6-->

    <!-- Right Side -->
	<div class="col-md-6">

    </div><!--/.col-md-6-->
</div><!--/.row-->

<div class="row">
    <div class="col-md-6">
    </div>

    <div class="col-md-6">
    </div>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($customer) ? $customer->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($customer) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>

<script>
    $('.cb-checked').click(
        function() {
            if ($(this).is(':checked')) // true
                $($(this)).val(1);
            else $($(this)).val(0);
        });
    
    cbEl = $('.cb-checked');
    cbEl.each(function() {
        if ($(this).val() == '1') {
            $(this).prop('checked', true);
        }
    });
</script>
