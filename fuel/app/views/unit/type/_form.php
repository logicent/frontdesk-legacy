<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
                <?= Form::input('name', Input::post('name', isset($unit_type) ? $unit_type->name : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
                <?= Form::input('code', Input::post('code', isset($unit_type) ? $unit_type->code : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
                <?= Form::textarea('description', Input::post('description', isset($unit_type) ? $unit_type->description : ''),
                                    array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>        
            </div>

            <div class="col-md-6">
                <?= Form::label('Alias', 'alias', array('class'=>'control-label')); ?>
                <?= Form::input('alias', Input::post('alias', isset($unit_type) ? $unit_type->alias : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>    
        </div>

        <div class="form-group">
            <div class="col-md-6">
            <?= Form::label('Base Rate', 'base_rate', array('class'=>'control-label')); ?>
                <?= Form::input('base_rate', Input::post('base_rate', isset($unit_type) ? $unit_type->base_rate : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>    
            </div>

            <div class="col-md-3">
                <?= Form::label('Default Pax', 'default_pax', array('class'=>'control-label')); ?>
                <?= Form::input('default_pax', Input::post('default_pax', isset($unit_type) ? $unit_type->default_pax : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>
            
            <div class="col-md-3">
                <?= Form::label('Max Persons', 'max_persons', array('class'=>'control-label')); ?>
                <?= Form::input('max_persons', Input::post('max_persons', isset($unit_type) ? $unit_type->max_persons : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Property', 'property_id', array('class'=>'control-label')); ?>
                <?= Form::select('property_id', Input::post('property_id', isset($unit_type) ? $unit_type->property_id : ''),
                                Model_Property::listOptionsProperty(),
                                array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Used For', 'used_for', array('class'=>'control-label')); ?>
                <?= Form::select('used_for', Input::post('used_for', isset($unit_type) ? $unit_type->used_for : ''),
                                Model_Unit_Type::listOptionsUsedFor(),
                                array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($unit_type) ? $unit_type->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
            </div>            
        </div>

        <hr>

        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($unit_type) ? $unit_type->fdesk_user : $uid)); ?>

        <div class="form-group">
            <div class="col-md-3">
            <?= Form::submit('submit', isset($unit_type) ? 'Update' : 'Add', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>

<?= Form::close(); ?>
