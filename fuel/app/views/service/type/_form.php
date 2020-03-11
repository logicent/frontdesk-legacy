<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
            <?= Form::input('name', Input::post('name', isset($service_type) ? $service_type->name : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-3">
            <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?= Form::input('code', Input::post('code', isset($service_type) ? $service_type->code : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Parent', 'parent_id', array('class'=>'control-label')); ?>
            <?= Form::select('parent_id', Input::post('parent_id', isset($service_type) ? $service_type->parent_id : ''),
                                    Model_Service_Type::listOptionsParentServiceType(),
                                    array('class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Default Service Provider', 'default_service_provider', array('class'=>'control-label')); ?>
            <?= Form::select('default_service_provider', Input::post('default_service_provider', isset($service_type) ? $service_type->default_service_provider : ''),
                                    array(), // Model_Property::listOptionsServiceProvider(),
                                    array('class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::hidden('is_default', Input::post('is_default', isset($service_type) ? $service_type->is_default : '0')); ?>
            <?= Form::checkbox('cb_is_default', null, array('class' => 'cb-checked', 'data-input' => 'is_default')); ?>
            <?= Form::label('Is default', 'cb_is_default', array('class'=>'control-label')); ?>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-6">
            <?= Form::hidden('enabled', Input::post('enabled', isset($service_type) ? $service_type->enabled : '0')); ?>
            <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
            <?= Form::label('Enabled', 'cb_enabled', array('class'=>'control-label')); ?>
        </div>
    </div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($service_type) ? $service_type->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::submit('submit', isset($service_type) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?= Form::close(); ?>