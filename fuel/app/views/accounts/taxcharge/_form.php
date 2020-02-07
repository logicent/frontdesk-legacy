<?php echo Form::open(array("class"=>"form-horizontal")); ?>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::label('Tax identifier', 'tax_identifier', array('class'=>'control-label')); ?>
        <?= Form::input('tax_identifier', Input::post('tax_identifier', isset($tax_charge) ? $tax_charge->tax_identifier : ''),
                                                    array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::label('Tax rate', 'tax_rate', array('class'=>'control-label')); ?>
        <div class="input-group">
            <?= Form::input('tax_rate', Input::post('tax_rate', isset($tax_charge) ? $tax_charge->tax_rate : ''),
            array('class' => 'col-md-4 form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
    </div>
</div>

<?php // Form::hidden('fdesk_user', Input::post('fdesk_user', isset($tax_charge) ? $tax_charge->fdesk_user : $uid)); ?>
    
<hr>

<div class="form-group">
    <div class="col-md-2">
        <?= Form::submit('submit', isset($tax_charge) ? 'Update' : 'Add tax', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php echo Form::close(); ?>