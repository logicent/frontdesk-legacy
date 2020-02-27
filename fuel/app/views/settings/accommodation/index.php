<h2 class="page-header">Settings <span class='text-muted'>Accommodation</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <div class="col-md-6">
                <?= Form::label('Check in time', 'checkin_time', array('class'=>'control-label')); ?>
                <?= Form::input('checkin_time', Input::post('checkin_time', isset($accommodation) ? $accommodation->checkin_time : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Check out time', 'checkout_time', array('class'=>'control-label')); ?>
                <?= Form::input('checkout_time', Input::post('checkout_time', isset($accommodation) ? $accommodation->checkout_time : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Breakfast from', 'breakfast_from', array('class'=>'control-label')); ?>
                <?= Form::input('breakfast_from', Input::post('breakfast_from', isset($accommodation) ? $accommodation->breakfast_from : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Breakfast to', 'breakfast_to', array('class'=>'control-label')); ?>
                <?= Form::input('breakfast_to', Input::post('breakfast_to', isset($accommodation) ? $accommodation->breakfast_to : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Lunch from', 'lunch_from', array('class'=>'control-label')); ?>
                <?= Form::input('lunch_from', Input::post('lunch_from', isset($accommodation) ? $accommodation->lunch_from : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Lunch to', 'lunch_to', array('class'=>'control-label')); ?>
                <?= Form::input('lunch_to', Input::post('lunch_to', isset($accommodation) ? $accommodation->lunch_to : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Dinner from', 'dinner_from', array('class'=>'control-label')); ?>
                <?= Form::input('dinner_from', Input::post('dinner_from', isset($accommodation) ? $accommodation->dinner_from : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
                <?= Form::label('Dinner to', 'dinner_to', array('class'=>'control-label')); ?>
                <?= Form::input('dinner_to', Input::post('dinner_to', isset($accommodation) ? $accommodation->dinner_to : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property) ? $property->fdesk_user : $uid)); ?>

        <hr>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>

<?= Form::close(); ?>