<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="col-md-6">
    <div class="form-group">
        <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
        <?= Form::input('name', Input::post('name', isset($property_type) ? $property_type->name : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    
    <div class="form-group">
        <div class="col-md-3">
            <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
            <?= Form::input('code', Input::post('code', isset($property_type) ? $property_type->code : ''), 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Form::hidden('enabled', Input::post('enabled', isset($property_type) ? $property_type->enabled : '0')); ?>
        <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
        <?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
    </div>
    
    <div class="form-group">
        <div class="col-md-3">
            <label class='control-label'>&nbsp;</label>
            <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		
        </div>
    </div>
</div>

<?= Form::close(); ?>