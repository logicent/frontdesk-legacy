<?php echo Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row form-group">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Description', 'name', array('class'=>'control-label')); ?>
                <?= Form::input('name', Input::post('name', isset($tax_charge) ? $tax_charge->name : ''),
                                array('class' => 'col-md-6 form-control', 'autofocus' => true)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
                <?= Form::input('code', Input::post('code', isset($tax_charge) ? $tax_charge->code : ''),
                                array('class' => 'col-md-6 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('enabled', Input::post('enabled', isset($tax_charge) ? $tax_charge->enabled : '0')); ?>
                <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
                <?= Form::label('Enabled', 'cb_enabled', array('class'=>'control-label')); ?>
            </div>
        </div>                
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Type', 'type', array('class'=>'control-label')); ?>
                <?= Form::select('type', Input::post('type', isset($tax_charge) ? $tax_charge->type : Model_Accounts_Tax::TAX_TYPE_NORMAL),
                                Model_Accounts_Tax::listOptionsTaxType(),
                                array('class' => 'col-md-6 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Rate', 'rate', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('rate', Input::post('rate', isset($tax_charge) ? $tax_charge->rate : ''),
                                    array('class' => 'col-md-6 form-control')); ?>
                    <span class="input-group-addon">%</span>
                </div>
            </div>
        </div>
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
</script>