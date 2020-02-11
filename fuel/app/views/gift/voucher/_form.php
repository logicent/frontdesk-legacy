<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Code', 'code', array('class'=>'control-label')); ?>

				<?php echo Form::input('code', Input::post('code', isset($gift_voucher) ? $gift_voucher->code : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Code')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($gift_voucher) ? $gift_voucher->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type', 'type', array('class'=>'control-label')); ?>

				<?php echo Form::input('type', Input::post('type', isset($gift_voucher) ? $gift_voucher->type : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Valid from', 'valid_from', array('class'=>'control-label')); ?>

				<?php echo Form::input('valid_from', Input::post('valid_from', isset($gift_voucher) ? $gift_voucher->valid_from : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Valid from')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Valid to', 'valid_to', array('class'=>'control-label')); ?>

				<?php echo Form::input('valid_to', Input::post('valid_to', isset($gift_voucher) ? $gift_voucher->valid_to : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Valid to')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Value', 'value', array('class'=>'control-label')); ?>

				<?php echo Form::input('value', Input::post('value', isset($gift_voucher) ? $gift_voucher->value : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Value')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Is redeemed', 'is_redeemed', array('class'=>'control-label')); ?>

				<?php echo Form::input('is_redeemed', Input::post('is_redeemed', isset($gift_voucher) ? $gift_voucher->is_redeemed : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Is redeemed')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>