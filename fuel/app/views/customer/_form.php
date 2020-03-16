<?php 
    $img_ph = "images/camera.gif";
    $img_src = '';
    if (isset($customer)) :
        if ($customer->ID_attachment) :
            $img_src = $customer->ID_attachment;
        else :
            $img_src = "https://avatars.dicebear.com/v2/initials/{$customer->customer_name}.svg";
        endif;
    else :
        $img_src = $img_ph;
    endif ?>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>

<div class="row">
	<div class="col-md-8">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Full name', 'customer_name', array('class'=>'control-label')); ?>
                <?= Form::input('customer_name', Input::post('customer_name', isset($customer) ? $customer->customer_name : ''), 
                                                            array('class' => 'col-md-4 form-control')); ?>
			</div>
            
            <div class="col-md-3">
                <?= Form::label('Title of Courtesy', 'title_of_courtesy', array('class'=>'control-label')); ?>
                <?= Form::select('title_of_courtesy', Input::post('title_of_courtesy', isset($customer) ? $customer->title_of_courtesy : ''), 
                                Model_Facility_Booking::$toc, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-3">
                <?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
                <?= Form::select('sex', Input::post('sex', isset($customer) ? $customer->sex : ''), Model_Facility_Booking::$sex, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>            
		</div>
<!--
            <div class="col-md-6">
				<?php // Form::label('Customer group', 'customer_group', array('class'=>'control-label')); ?>
                <?php // Form::select('customer_group', Input::post('customer_group', isset($customer) ? $customer->customer_group : ''), 
                        //                                        Model_Customer::listOptionsCustomerGroup(), 
                        //                                        array('class' => 'col-md-4 form-control')); ?>
			</div>
-->      
		<div class="form-group">
            <div class="col-md-6"> 
				<?= Form::label('Type', 'customer_type', array('class'=>'control-label')); ?>
                <?= Form::select('customer_type', Input::post('customer_type', isset($customer) ? $customer->customer_type : ''), 
                                Model_Customer::listOptionsCustomerType(), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>            
            <div class="col-md-6">
                <?= Form::label('Date of Birth', 'birth_date', array('class'=>'control-label')); ?>
                <!--<div class="input-group">-->
                    <?= Form::input('birth_date', Input::post('birth_date', isset($customer) ? $customer->birth_date : ''),
                                    array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
                    <!--
                    <span class="input-group-addon">
                        <i class="fa fa-calendar text-default"></i>
                    </span>
                </div>-->
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
                                Model_Country::listOptions(true), array('class' => 'col-md-4 form-control select-from-list')); ?>
            </div>
            <div class="col-md-6">
				<?= Form::label('Occupation', 'occupation', array('class'=>'control-label')); ?>
                <?= Form::input('occupation', Input::post('occupation', isset($customer) ? $customer->occupation : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>            
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Account manager', 'account_manager', array('class'=>'control-label')); ?>
                <?= Form::select('account_manager', Input::post('account_manager', isset($customer) ? $customer->account_manager : ''), 
                                Model_User::listOptions(), 
                                array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
            </div>
            
            <div class="col-md-6">
				<?= Form::label('Tax ID', 'tax_ID', array('class'=>'control-label')); ?>
                <?= Form::input('tax_ID', Input::post('tax_ID', isset($customer) ? $customer->tax_ID : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($customer) ? $customer->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
                <br>
                <?php // Form::hidden('is_internal_customer', Input::post('is_internal_customer', isset($customer) ? $customer->is_internal_customer : '0')); ?>
                <?php // Form::checkbox('cb_is_internal_customer', null, array('class' => 'cb-checked', 'data-input' => 'is_internal_customer')); ?>
                <?php // Form::label('Is internal customer', 'cb_is_internal_customer', array('class'=>'control-label')); ?>                
            </div>

            <div class="col-md-6">
				<?= Form::label('Bank account', 'bank_account', array('class'=>'control-label')); ?>
                <?= Form::input('bank_account', Input::post('bank_account', isset($customer) ? $customer->bank_account : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

	</div><!--/.col-md-6-->

    <!-- Right Side -->
	<div class="col-md-4">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('ID preview', 'upload_img', array('class'=>'control-label')); ?>
                <div class="well text-center">
                    <?= Form::file('uploaded_file', array('class' => '', 'style' => 'display: none;')); ?>
                    <div class="img-wrapper">
                        <?= Html::img($img_src, 
                                array(
                                    'class'=>'upload-img', 
                                    'style' => 'max-width: 360px; max-height: 270px;'
                                )
                            ); ?>
                    </div>
                </div>
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-12">
                <?= Form::label('ID path', 'ID_attachment', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('ID_attachment', Input::post('ID_attachment', isset($customer) ? $customer->ID_attachment : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o"></i>', 
                                        array('id' => 'add_img', 'class' => 'text-info')) ?>
                    </span>
                <?php 
                    if (isset($customer)) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('customer/remove_img/' . $customer->id), '<i class="fa fa-trash-o"></i>',
                                        array('id' => 'del_img', 'class' => ' text-primary', 'data-ph' => $img_ph)) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>

            <div class="col-md-12">
				<?php Form::label('Billing currency', 'billing_currency', array('class'=>'control-label')); ?>
                <?php Form::input('billing_currency', Input::post('billing_currency', isset($customer) ? $customer->billing_currency : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-12">
				<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($customer) ? $customer->remarks : ''), 
                                    array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
            </div>
		</div>
    </div><!--/.col-md-6-->
</div><!--/.row-->

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
    // see checkbox code in custom.js
	// Date range picker for birth_date
</script>
