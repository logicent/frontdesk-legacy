<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Business name', 'business_name', array('class'=>'control-label')); ?>
                <?= Form::input('business_name', Input::post('business_name', isset($business) ? $business->business_name : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
                <span id="helpBlock" class="help-block text-muted small">Registered name used in legal documents</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Physical address', 'address', array('class'=>'control-label')); ?>
                <?= Form::textarea('address', Input::post('address', isset($business) ? $business->address : ''),
                                    array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Business type', 'business_type', array('class'=>'control-label')); ?>
                <?= Form::select('business_type', Input::post('business_type', isset($business) ? $business->business_type : ''), 
                                Model_Business::listOptionsType(), 
                                array('class' => 'col-md-4 form-control')); ?>
    		</div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Tax identifier', 'tax_identifier', array('class'=>'control-label')); ?>
                <?= Form::input('tax_identifier', Input::post('tax_identifier', isset($business) ? $business->tax_identifier : ''),
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Currency symbol', 'currency_symbol', array('class'=>'control-label')); ?>
                <?= Form::select('currency_symbol', Input::post('currency_symbol', isset($business) ? $business->currency_symbol : ''), 
                                Model_Business::listOptionsCurrency(), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
		</div>
        <?php if ($ugroup->id == 6) : ?>
        <div class="form-group">
            <div class="col-md-12">
                <!-- <h5>Services</h5> -->
                <?= Form::label('Property services', '', array('class'=>'control-label')); ?>
            </div>
            <div class="col-md-12">
                <?= Form::hidden('service_accommodation', Input::post('service_accommodation', isset($business) ? $business->service_accommodation : '0')); ?>
                <?= Form::checkbox('cb_service_accommodation', null, array('class' => 'cb-checked', 'data-input' => 'service_accommodation')); ?>
                <?= Form::label('Accommodation facilities', 'cb_service_accommodation', array('class'=>'control-label')); ?>
            </div>
            <div class="col-md-12">
                <?= Form::hidden('service_rental', Input::post('service_rental', isset($business) ? $business->service_rental : '0')); ?>
                <?= Form::checkbox('cb_service_rental', null, array('class' => 'cb-checked', 'data-input' => 'service_rental')); ?>
                <?= Form::label('Rental property', 'cb_service_rental', array('class'=>'control-label')); ?>
            </div>
            <div class="col-md-12">
                <?= Form::hidden('service_hire', Input::post('service_hire', isset($business) ? $business->service_hire : '0')); ?>
                <?= Form::checkbox('cb_service_hire', null, array('class' => 'cb-checked', 'data-input' => 'service_hire')); ?>
                <?= Form::label('Hire facilities', 'cb_service_hire', array('class'=>'control-label')); ?>
            </div>
            <div class="col-md-12">
                <?= Form::hidden('service_sale', Input::post('service_sale', isset($business) ? $business->service_sale : '0')); ?>
                <?= Form::checkbox('cb_service_sale', null, array('class' => 'cb-checked', 'data-input' => 'service_sale')); ?>
                <?= Form::label('Sale of property', 'cb_service_sale', array('class'=>'control-label')); ?>
            </div>
        </div>
        <?php endif ?>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Trading name', 'trading_name', array('class'=>'control-label')); ?>
                <?= Form::input('trading_name', Input::post('trading_name', isset($business) ? $business->trading_name : ''),
                                array('class' => 'col-md-4 form-control')); ?>
                <span id="helpBlock" class="help-block text-muted small">Brand name used in marketing and promotions</span>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Email address(es)', 'email_address', array('class'=>'control-label')); ?>
                <?= Form::input('email_address', Input::post('email_address', isset($business) ? $business->email_address : ''),
                                array(
                                    'class' => 'col-md-4 form-control', 
                                    'placeholder'=>'info@example.com, sales@example.com'
                                )); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Phone number(s)', 'phone_number', array('class'=>'control-label')); ?>
                <?= Form::input('phone_number', Input::post('phone_number', isset($business) ? $business->phone_number : ''),
                                array(
                                    'class' => 'col-md-4 form-control', 
                                    'placeholder'=>'020-123 4567, 0712 345 678'
                                )) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Logo path', 'business_logo', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('business_logo', Input::post('business_logo', isset($business) ? $business->business_logo : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)) ?>
                <?php 
                    if ($business) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o text-info"></i>', array('id' => 'add_img')) ?>
                    </span>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('business/remove_img/' . $business->id), '<i class="fa fa-trash-o text-red"></i>',
                                        array('id' => 'del_img', 'data-ph' => 'http://placehold.it/240x120')) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Form::file('uploaded_file', array('class' => 'col-md-12', 'style' => 'display: none;')); ?>
            <div class="col-md-12">
                <?php // Form::label('Upload image', 'upload_img', array('class'=>'control-label')); ?>
                <br>
                <div class="img-thumbnail">
                    <?= Html::img(!empty($business->business_logo) ? $business->business_logo : 'http://placehold.it/240x120', 
                                array('class'=>'upload-img', 'style' => 'max-width: 370px;')); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<hr>
<div class="form-group">
    <div class="col-md-6">
    <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?= Form::close(); ?>