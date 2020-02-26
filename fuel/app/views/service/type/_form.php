<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="col-md-6">
    <div class="form-group">
        <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
        <?= Form::input('name', Input::post('name', isset($service_type) ? $service_type->name : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    
    <div class="form-group">
        <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
        <?= Form::input('code', Input::post('code', isset($service_type) ? $service_type->code : ''), 
                        array('class' => 'col-md-4 form-control')); ?>
    </div>
    
    <div class="form-group">
        <?= Form::hidden('enabled', Input::post('enabled', isset($lease) ? $lease->enabled : '0')); ?>
        <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
        <?= Form::label('Visible', 'cb_enabled', array('class'=>'control-label')); ?>
    </div>
    
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		
    </div>
</div>

<?= Form::close(); ?>