<?php echo Form::open(array("class"=>"form-horizontal")); ?>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
        <?= Form::input('code', Input::post('code', isset($tax_charge) ? $tax_charge->code : ''),
                                                    array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::label('Description', 'name', array('class'=>'control-label')); ?>
        <?= Form::input('name', Input::post('name', isset($tax_charge) ? $tax_charge->name : ''),
                                                    array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::label('Rate', 'rate', array('class'=>'control-label')); ?>
        <div class="input-group">
            <?= Form::input('rate', Input::post('rate', isset($tax_charge) ? $tax_charge->rate : ''),
            array('class' => 'col-md-4 form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::checkbox('enabled', Input::post('enabled', isset($tax_charge) ? $tax_charge->enabled : '0'), 
                            array('class' => 'cb-checked')); ?>
        <?= Form::label('Enabled', 'enabled', array('class'=>'control-label')); ?>
    </div>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($tax_charge) ? $tax_charge->fdesk_user : $uid)); ?>
    
<hr>

<div class="form-group">
    <div class="col-md-2">
        <?= Form::submit('submit', isset($tax_charge) ? 'Update' : 'Add tax', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php echo Form::close(); ?>

<script>
	$('.cb-checked').click(function() 
    {
        cbName = '#form_' + $(this).attr('name');

	    if ($(this).is(':checked')) // true
	        $(cbName).val(1);
	    else $(cbName).val(0);
    });

    if ($('.cb-checked').val() == '1') {

        cbName = '#form_enabled';

        $(cbName).attr('checked', true);
	}
</script>