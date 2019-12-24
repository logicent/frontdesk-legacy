<?= Form::open(array("class"=>"form-horizontal", "enctype"=>"multipart/form-data")); ?>
	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Business name', 'business_name', array('class'=>'control-label')); ?>
			<?= Form::input('business_name', Input::post('business_name', isset($business) ? $business->business_name : ''),
														array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>
		<div class="col-md-6">
			<?= Form::label('Trading name', 'trading_name', array('class'=>'control-label')); ?>
			<?= Form::input('trading_name', Input::post('trading_name', isset($business) ? $business->trading_name : ''),
														array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Address', 'address', array('class'=>'control-label')); ?>
			<?= Form::textarea('address', Input::post('address', isset($business) ? $business->address : ''),
																array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Tax rate', 'tax_rate', array('class'=>'control-label')); ?>
			<div class="input-group">
				<?= Form::input('tax_rate', Input::post('tax_rate', isset($business) ? $business->tax_rate : ''),
				array('class' => 'col-md-4 form-control')); ?>
				<span class="input-group-addon">%</span>
			</div>
			<?= Form::label('Currency symbol', 'currency_symbol', array('class'=>'control-label')); ?>
			<?= Form::input('currency_symbol', Input::post('currency_symbol', isset($business) ? $business->currency_symbol : ''),
			array('class' => 'col-md-4 form-control', 'placeholder'=>'KES')); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Tax identifier', 'tax_identifier', array('class'=>'control-label')); ?>
			<?= Form::input('tax_identifier', Input::post('tax_identifier', isset($business) ? $business->tax_identifier : ''),
														array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<!-- <div class="form-group"> -->
		<div class="col-md-6">
			<div class="form-group">
				<?= Form::label('Email address', 'email_address', array('class'=>'control-label')); ?>
				<?= Form::input('email_address', Input::post('email_address', isset($business) ? $business->email_address : ''),
															array('class' => 'col-md-4 form-control', 'placeholder'=>'no-reply@e1-frontdesk.co.ke')); ?>
			</div>

			<div class="form-group">
				<?= Form::label('Business logo', 'business_logo', array('class'=>'control-label')); ?>
				<div class="input-group">
					<?= Form::input('business_logo', Input::post('business_logo', isset($business) ? $business->business_logo : ''),
					array('id' => 'logo_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
					<span id="rm_img" class="input-group-addon">
						<?= Html::anchor(Uri::create('business/remove_img/' . $business->id), '<i class="fa fa-trash-o text-red"></i>') ?>
					</span>
				</div>
			</div>
			<?= Form::file('uploaded_file', array('class' => 'col-md-12')); ?>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<div class="img-thumbnail">
					<?= Html::img(!empty($business->business_logo) ? $business->business_logo : 'http://placehold.it/225x140', array('class'=>'logo-img')); ?>
				</div>
			</div>
		</div>
	<!-- </div> -->
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
