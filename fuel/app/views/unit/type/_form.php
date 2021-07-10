<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <div class="col-md-8">
                <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
                <?= Form::input('name', Input::post('name', isset($unit_type) ? $unit_type->name : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
                <?= Form::input('code', Input::post('code', isset($unit_type) ? $unit_type->code : ''),
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
                <?= Form::textarea('description', Input::post('description', isset($unit_type) ? $unit_type->description : ''),
                                    array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <?= Form::label('Alias', 'alias', array('class'=>'control-label')); ?>
                <?= Form::input('alias', Input::post('alias', isset($unit_type) ? $unit_type->alias : ''),
                                array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Base rate', 'base_rate', array('class'=>'control-label')); ?>
                <?= Form::input('base_rate', Input::post('base_rate', isset($unit_type) ? $unit_type->base_rate : ''),
                                array('class' => 'col-md-4 form-control text-right')); ?>    
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-8">
                <?= Form::label('Property', 'property_id', array('class'=>'control-label')); ?>
                <?= Form::select('property_id', Input::post('property_id', isset($unit_type) ? $unit_type->property_id : ''),
                                Model_Property::listOptionsProperty(),
                                array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-4">
                <?= Form::label('Used for', 'used_for', array('class'=>'control-label')); ?>
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
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Default pax', 'default_pax', array('class'=>'control-label')); ?>
                <?= Form::input('default_pax', Input::post('default_pax', isset($unit_type) ? $unit_type->default_pax : ''),
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
            
            <div class="col-md-6">
                <?= Form::label('Max persons', 'max_persons', array('class'=>'control-label')); ?>
                <?= Form::input('max_persons', Input::post('max_persons', isset($unit_type) ? $unit_type->max_persons : ''),
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Form::file('uploaded_file', array('class' => 'col-md-12', 'style' => 'display: none;')); ?>
            <div class="col-md-12">
                <?= Form::label('Image preview', 'upload_img', array('class'=>'control-label')); ?>
                <br>
                <div class="img-thumbnail">
                    <?= Html::img(!empty($unit_type->image_path) ? $unit_type->image_path : 'http://placehold.it/290x110', 
                                array('class'=>'upload-img', 'style' => 'max-width: 290px;')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Image path', 'image_path', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('image_path', Input::post('image_path', isset($unit_type) ? $unit_type->image_path : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                <?php 
                    if (isset($unit_type)) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o text-info"></i>', array('id' => 'add_img')) ?>
                    </span>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('unit/type/remove_img/' . $unit_type->id), '<i class="fa fa-trash-o text-red"></i>',
                                        array('id' => 'del_img', 'data-ph' => 'http://placehold.it/240x120')) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>
        </div>        
    </div>
</div>

<hr>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($unit_type) ? $unit_type->fdesk_user : $uid)); ?>

<div class="form-group">
    <div class="col-md-3">
    <?= Form::submit('submit', isset($unit_type) ? 'Update' : 'Add', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?= Form::close(); ?>
