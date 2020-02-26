<?= Form::open(array("class"=>"form-horizontal")); ?>

    <div class="form-group">
        <?= Form::label('Property id', 'property_id', array('class'=>'control-label')); ?>
        <?= Form::input('property_id', Input::post('property_id', isset($property_setting) ? $property_setting->property_id : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    <div class="form-group">
        <?= Form::label('Key', 'key', array('class'=>'control-label')); ?>
        <?= Form::input('key', Input::post('key', isset($property_setting) ? $property_setting->key : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    <div class="form-group">
        <?= Form::label('Value', 'value', array('class'=>'control-label')); ?>
        <?= Form::input('value', Input::post('value', isset($property_setting) ? $property_setting->value : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		
    </div>
    
<?= Form::close(); ?>