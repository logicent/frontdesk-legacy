<?php 
    $img_ph = "images/camera.gif";
    $img_src = '';
    if (isset($tenant)) :
        if ($tenant->ID_attachment) :
            $img_src = $tenant->ID_attachment;
        else :
            $img_src = "https://avatars.dicebear.com/v2/initials/{$tenant->customer_name}.svg";
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
                <?= Form::input('customer_name', Input::post('customer_name', isset($tenant) ? $tenant->customer_name : ''), 
                                                            array('class' => 'col-md-4 form-control')); ?>
                <?= Form::hidden('customer_type', Input::post('customer_type', isset($tenant) ? $tenant->customer_type : Model_Customer::CUSTOMER_TYPE_TENANT)); ?>
			</div>
            
            <div class="col-md-3">
                <?= Form::label('Title of Courtesy', 'title_of_courtesy', array('class'=>'control-label')); ?>
                <?= Form::select('title_of_courtesy', Input::post('title_of_courtesy', isset($tenant) ? $tenant->title_of_courtesy : ''), 
                                Model_Facility_Booking::$toc, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-3">
                <?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
                <?= Form::select('sex', Input::post('sex', isset($tenant) ? $tenant->sex : ''), Model_Facility_Booking::$sex, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
		</div>
<!--
            <div class="col-md-6">
				<?php // Form::label('Customer group', 'customer_group', array('class'=>'control-label')); ?>
                <?php // Form::select('customer_group', Input::post('customer_group', isset($tenant) ? $tenant->customer_group : ''), 
                        //                                        Model_Customer::listOptionsCustomerGroup(), 
                        //                                        array('class' => 'col-md-4 form-control')); ?>
			</div>
-->      
		<div class="form-group">
        <div class="col-md-6">
				<?= Form::label('Mobile phone', 'mobile_phone', array('class'=>'control-label')); ?>
                <?= Form::input('mobile_phone', Input::post('mobile_phone', isset($tenant) ? $tenant->mobile_phone : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>        
            <div class="col-md-6">
				<?= Form::label('Email address', 'email_address', array('class'=>'control-label')); ?>
                <?= Form::input('email_address', Input::post('email_address', isset($tenant) ? $tenant->email_address : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID no.', 'ID_no', array('class'=>'control-label')); ?>
                <?= Form::input('ID_no', Input::post('ID_no', isset($tenant) ? $tenant->ID_no : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('ID type', 'ID_type', array('class'=>'control-label')); ?>
                <?= Form::select('ID_type', Input::post('ID_type', isset($tenant) ? $tenant->ID_type : ''), 
                                Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Date of Birth', 'birth_date', array('class'=>'control-label')); ?>
                <!--<div class="input-group">-->
                    <?= Form::input('birth_date', Input::post('birth_date', isset($tenant) ? $tenant->birth_date : ''),
                                    array('
                                        class' => 'col-md-4 form-control datepicker', 
                                        'readonly' => true,
                                        'data-age-limit' => '>18' // TODO: in JS calc starting date backwards
                                    )); ?>
                    <!--
                    <span class="input-group-addon">
                        <i class="fa fa-calendar text-default"></i>
                    </span>
                </div>-->
            </div>
            <div class="col-md-6">
                <?= Form::label('ID country', 'ID_country', array('class'=>'control-label')); ?>
                <?= Form::select('ID_country', Input::post('ID_country', isset($tenant) ? $tenant->ID_country : ''), 
                                Model_Country::listOptions(true), array('class' => 'col-md-4 form-control select-from-list')); ?>
            </div>            
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Occupation', 'occupation', array('class'=>'control-label')); ?>
                <?= Form::input('occupation', Input::post('occupation', isset($tenant) ? $tenant->occupation : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
				<?= Form::label('KRA PIN', 'tax_ID', array('class'=>'control-label')); ?>
                <?= Form::input('tax_ID', Input::post('tax_ID', isset($tenant) ? $tenant->tax_ID : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
                <?php Form::label('Billing currency', 'billing_currency', array('class'=>'control-label')); ?>
                <?php Form::select('billing_currency', Input::post('billing_currency', isset($tenant) ? $tenant->billing_currency : 'KES'), 
                                Model_Business::listOptionsCurrency(), 
                                array('class' => 'col-md-4 form-control')); ?>
                <?php Form::label('Account manager', 'account_manager', array('class'=>'control-label')); ?>
                <?php Form::select('account_manager', Input::post('account_manager', isset($tenant) ? $tenant->account_manager : $uid), 
                                Model_User::listOptions(), 
                                array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
				<?php Form::label('Bank account', 'bank_account', array('class'=>'control-label')); ?>
                <?php Form::input('bank_account', Input::post('bank_account', isset($tenant) ? $tenant->bank_account : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($tenant) ? $tenant->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
                <br>
                <?php // Form::hidden('is_internal_tenant', Input::post('is_internal_tenant', isset($tenant) ? $tenant->is_internal_tenant : '0')); ?>
                <?php // Form::checkbox('cb_is_internal_tenant', null, array('class' => 'cb-checked', 'data-input' => 'is_internal_tenant')); ?>
                <?php // Form::label('Is internal tenant', 'cb_is_internal_tenant', array('class'=>'control-label')); ?>                
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
                    <?= Form::input('ID_attachment', Input::post('ID_attachment', isset($tenant) ? $tenant->ID_attachment : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o"></i>', 
                                        array('id' => 'add_img', 'class' => 'text-info')) ?>
                    </span>
                <?php 
                    if (isset($tenant)) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('tenant/remove_img/' . $tenant->id), '<i class="fa fa-trash-o"></i>',
                                        array('id' => 'del_img', 'class' => ' text-primary', 'data-ph' => $img_ph)) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>
		</div>
            <?php Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
            <?php Form::textarea('remarks', Input::post('remarks', isset($tenant) ? $tenant->remarks : ''), 
                                array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
    </div><!--/.col-md-6-->
</div><!--/.row-->

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($tenant) ? $tenant->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($tenant) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
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
