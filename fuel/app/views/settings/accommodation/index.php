<h2 class="page-header">Settings <span class='text-muted'>Accommodation</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?php echo Form::label('Check out time', 'checkout_time', array('class'=>'control-label')); ?>
                <?php echo Form::input('checkout_time', Input::post('checkout_time', isset($email_setting) ? $email_setting->checkout_time : ''), 
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