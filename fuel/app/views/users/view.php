<h2>Viewing <span class='text-muted'>User</span></span>&nbsp;
<span><?= Html::anchor('users', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span></h2>

<hr>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Full name', 'fullname', array('class'=>'control-label')); ?>
			<?= Form::input('fullname', $user->fullname, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>

        <div class="col-md-4">
            <?= Form::label('Group', 'group_id', array('class'=>'control-label')); ?>
            <?= Form::input('group_name', $user->group->name, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Username', 'username', array('class'=>'control-label')); ?>
			<?= Form::input('username', $user->username, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>

        <div class="col-md-4">
			<br>
            <?= Html::anchor('users/change-pwd/' . $user->id, 'Change Password', array('method' => 'post', 'class' => 'btn btn-sm btn-default')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
            <?= Form::input('email', $user->email, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>

        <div class="col-md-4">
            <?= Form::label('Mobile', 'mobile', array('class'=>'control-label')); ?>
            <?= Form::input('mobile', $user->mobile, array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>
            <?= Form::input('last_login', date('d-M-Y H:m:s', $user->last_login), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>

        <div class="col-md-4">
            <?= Form::label('Previous login', 'previous_login', array('class'=>'control-label')); ?>
            <?= Form::input('previous_login', date('d-M-Y H:m:s', $user->previous_login), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
    
    <?php if ($ugroup->id == 5 || $ugroup->id == 6) : ?>
        <div class="col-md-6">
            <?= Html::anchor('users/edit/' . $user->id, 'Edit', array('class' => 'btn btn-primary')); ?>
        </div>
    <?php endif ?>
    </div>

<?= Form::close(); ?>
