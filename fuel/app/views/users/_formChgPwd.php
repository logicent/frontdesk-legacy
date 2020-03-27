<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Full name', 'fullname', array('class'=>'control-label')); ?>
            <?= Form::input('fullname', Input::post('fullname', $user->fullname), 
                            array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Username', 'username', array('class'=>'control-label')); ?>
            <?= Form::input('username', Input::post('username', $user->username), 
                            array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('New Password', 'password', array('class'=>'control-label')); ?>
            <?= Form::password('password', Input::post('password', ''), array('class' => 'col-md-4 form-control')); ?>
        </div>

        <div class="col-md-4">
            <?= Form::label('Old Password', 'old_password', array('class'=>'control-label')); ?>
            <?= Form::password('old_password', Input::post('old_password', ''), array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>
            <?= Form::input('last_login', Input::post('last_login', isset($user) ? date('d-M-Y H:m:s', $user->last_login) : ''), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
        </div>

        <div class="col-md-4">
            <?= Form::label('Previous login', 'previous_login', array('class'=>'control-label')); ?>
            <?= Form::input('previous_login', Input::post('previous_login', isset($user) ? date('d-M-Y H:m:s', $user->previous_login) : ''), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::submit('submit', 'Update', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>

<?= Form::close(); ?>
