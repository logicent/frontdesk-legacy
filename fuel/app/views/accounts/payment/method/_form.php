<?php echo Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-3">
            <?php echo Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?php echo Form::input('code', Input::post('code', isset($payment_method) ? $payment_method->code : ''), 
                                    array('class' => 'col-md-6 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>
            <?php echo Form::input('name', Input::post('name', isset($payment_method) ? $payment_method->name : ''), 
                                    array('class' => 'col-md-6 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?= Form::hidden('is_default', Input::post('is_default', isset($payment_method) ? $payment_method->is_default : '0')); ?>
            <?= Form::checkbox('cb_is_default', null, array('class' => 'cb-checked', 'data-input' => 'is_default')); ?>
            <?= Form::label('Is default', 'cb_is_default', array('class'=>'control-label')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?= Form::hidden('enabled', Input::post('enabled', isset($payment_method) ? $payment_method->enabled : '0')); ?>
            <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
            <?= Form::label('Enabled', 'cb_enabled', array('class'=>'control-label')); ?>
        </div>
    </div>

	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($payment_method) ? $payment_method->fdesk_user : $uid)); ?>
    
    <hr>

	<div class="form-group">
		<div class="col-md-3">
    		<?= Form::submit('submit', isset($payment_method) ? 'Update' : 'Add method', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?php echo Form::close(); ?>