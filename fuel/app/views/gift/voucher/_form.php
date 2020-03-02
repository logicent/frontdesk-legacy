<?=Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-3">
            <?=Form::label('Name', 'name', array('class'=>'control-label')); ?>
            <?=Form::input('name', Input::post('name', isset($gift_voucher) ? $gift_voucher->name : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>

        <div class="col-md-3">
            <?=Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?=Form::input('code', Input::post('code', isset($gift_voucher) ? $gift_voucher->code : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>        
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?=Form::label('Type', 'type', array('class'=>'control-label')); ?>
            <?= Form::select('type', Input::post('type', isset($gift_voucher) ? $gift_voucher->type : ''), 
                            [], // Model_Gift_Voucher::listOptions(), 
                            array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?=Form::label('Valid from', 'valid_from', array('class'=>'control-label')); ?>
            <?=Form::input('valid_from', Input::post('valid_from', isset($gift_voucher) ? $gift_voucher->valid_from : ''), 
                            array('class' => 'col-md-4 form-control datepicker')); ?>
        </div>
        <div class="col-md-3">
            <?=Form::label('Valid to', 'valid_to', array('class'=>'control-label')); ?>
            <?=Form::input('valid_to', Input::post('valid_to', isset($gift_voucher) ? $gift_voucher->valid_to : ''), 
                            array('class' => 'col-md-4 form-control datepicker')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?=Form::label('Value', 'value', array('class'=>'control-label')); ?>
            <?=Form::input('value', Input::post('value', isset($gift_voucher) ? $gift_voucher->value : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <?= Form::hidden('is_redeemed', Input::post('is_redeemed', isset($gift_voucher) ? $gift_voucher->is_redeemed : '0')); ?>
            <?= Form::checkbox('cb_is_redeemed', null, array('class' => 'cb-checked', 'data-input' => 'is_redeemed')); ?>
            <?= Form::label('Is redeemed', 'cb_is_redeemed', array('class'=>'control-label')); ?>
        </div>
    </div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($gift_voucher) ? $gift_voucher->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($gift_voucher) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?=Form::close(); ?>