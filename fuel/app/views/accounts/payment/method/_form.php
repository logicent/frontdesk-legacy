<?php echo Form::open(array("class"=>"form-horizontal")); ?>

    <div class="form-group">
        <div class="col-md-3">
            <?php echo Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?php echo Form::input('code', Input::post('code', isset($payment_method) ? $payment_method->code : ''), array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>
            <?php echo Form::input('name', Input::post('name', isset($payment_method) ? $payment_method->name : ''), array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?php echo Form::checkbox('is_default', Input::post('is_default', isset($payment_method) ? $payment_method->is_default : '0'), array('class' => 'cb-checked')); ?>
            <?php echo Form::label('Is default', 'is_default', array('class'=>'control-label')); ?>
        </div>
    </div>

	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($payment_method) ? $payment_method->fdesk_user : $uid)); ?>
    
    <hr>

	<div class="form-group">
		<div class="col-md-2">
    		<?= Form::submit('submit', isset($payment_method) ? 'Update' : 'Add method', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?php echo Form::close(); ?>