<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>

<div class="row">
    <div class="col-md-4">
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
    </div>

    <div class="col-md-4">
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
                                                            'placeholder'=>'020-345 7890, 0700 001 990'
                                                        )); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Logo path', 'business_logo', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('business_logo', Input::post('business_logo', isset($business) ? $business->business_logo : ''),
                            array('id' => 'logo_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                    <span id="rm_img" class="input-group-addon">
                        <?php 
                        if ($business) :
                            echo Html::anchor(Uri::create('business/remove_img/' . $business->id), '<i class="fa fa-trash-o text-red"></i>');
                        endif ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
        <!-- hide this in favor of input click to trigger file open dialog -->
            <?= Form::file('uploaded_file', array('class' => 'col-md-12')); ?>

            <div class="col-md-12">
                <?php // Form::label('Upload image', 'upload_img', array('class'=>'control-label')); ?>
                <br>
                <div class="img-thumbnail">
                    <?= Html::img(!empty($business->business_logo) ? $business->business_logo : 'http://placehold.it/240x120', array('class'=>'logo-img')); ?>
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

<script>
    $('input[type=file]').change(function() {
        //var filename = $(this).val().split('\\').pop();
        // remove C:\fakepath that is added for security reasons
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('#logo_path').val(filename);
    });
    $('#rm_img').click(function(e){
        $.post("<?= Uri::create(isset($business) ? '/business/remove_img/'.$business->id : '#'); ?>",
            function(data) {
                $('#logo_path').val('')
                $('.logo-img').attr("src", "http://placehold.it/225x140");

            });
        e.preventDefault();
    });
</script>
