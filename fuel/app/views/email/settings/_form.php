<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::label('Host', 'smtp_host', array('class'=>'control-label')); ?>
        <?= Form::input('smtp_host', Input::post('smtp_host', isset($email_setting) ? $email_setting->smtp_host : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>

    <div class="col-md-6">
        <?= Form::label('From Address', 'from_address', array('class'=>'control-label')); ?>
        <?= Form::input('from_address', Input::post('from_address', isset($email_setting) ? $email_setting->from_address : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::label('Username', 'smtp_username', array('class'=>'control-label')); ?>
        <?= Form::input('smtp_username', Input::post('smtp_username', isset($email_setting) ? $email_setting->smtp_username : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>

    <div class="col-md-6">
        <?= Form::label('From Name', 'from_name', array('class'=>'control-label')); ?>
        <?= Form::input('from_name', Input::post('from_name', isset($email_setting) ? $email_setting->from_name : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::label('Password', 'smtp_password', array('class'=>'control-label')); ?>
        <?= Form::input('smtp_password', Input::post('smtp_password', isset($email_setting) ? $email_setting->smtp_password : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::label('Port', 'smtp_port', array('class'=>'control-label')); ?>
        <?= Form::input('smtp_port', Input::post('smtp_port', isset($email_setting) ? $email_setting->smtp_port : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>

    <div class="col-md-6">
        <?= Form::label('Timeout', 'smtp_timeout', array('class'=>'control-label')); ?>
        <?= Form::input('smtp_timeout', Input::post('smtp_timeout', isset($email_setting) ? $email_setting->smtp_timeout : ''), array('class' => 'col-md-4 form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::hidden('smtp_starttls', Input::post('smtp_starttls', isset($email_setting) ? $email_setting->smtp_starttls : '0')); ?>
        <?= Form::checkbox('cb_smtp_starttls', null, array('class' => 'cb-checked', 'data-input' => 'smtp_starttls')); ?>
        <?= Form::label('StartTLS', 'cb_smtp_starttls', array('class'=>'control-label')); ?>
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?= Form::close(); ?>

<script>

</script>
