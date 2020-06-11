<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
            <?= Form::input('name', Input::post('name', isset($property_type) ? $property_type->name : ''), 
                            array('class' => 'col-md-6 form-control')); ?>
        </div>
        <div class="col-md-2">
            <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?= Form::input('code', Input::post('code', isset($property_type) ? $property_type->code : ''), 
                            array('class' => 'col-md-6 form-control')); ?>
        </div>        
    </div>
    
    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Group', 'group', array('class'=>'control-label')); ?>
            <?= Form::select('group', Input::post('group', isset($property_type) ? $property_type->group : ''),
                                    Model_Property_Type::listOptionsSystemDefined(),
                                    array('class' => 'form-control')); ?>
        </div>
        <div class="col-md-6">
            <?= Form::hidden('enabled', Input::post('enabled', isset($property_type) ? $property_type->enabled : '0')); ?>
            <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
            <?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
        </div>
    </div>
    
    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property_type) ? $property_type->fdesk_user : $uid)); ?>

    <hr>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::submit('submit', isset($property_type) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>

<?= Form::close(); ?>