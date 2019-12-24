<?= Form::open(array("class"=>"form-horizontal")); ?>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Full name', 'fullname', array('class'=>'control-label')); ?>
				<?= Form::input('fullname', Input::post('fullname', isset($user->fullname) ? $user->fullname : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Group', 'group_id', array('class'=>'control-label')); ?>
				<?php
					if (isset($user) && $ugroup->id < 5) {
						echo Form::hidden('group_id', Input::post('group_id', $user->group_id));
						echo Form::input('group_name', Input::post('group_name', $user->group->name), array('class' => 'col-md-4 form-control', 'readonly' => true));
					}
					else
						echo Form::select('group_id', Input::post('group_id', isset($user) ? $user->group_id : ''), Model_User::getUserGroupList($ugroup->id == 6),	array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Username', 'username', array('class'=>'control-label')); ?>
				<?= Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'readonly'=>isset($user) ? true : false)); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('New Password', 'password', array('class'=>'control-label')); ?>
				<?= Form::password('password', Input::post('password', ''), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<?php if (isset($user)) : ?>
			<div class="col-md-3">
				<?= Form::label('Old Password', 'old_password', array('class'=>'control-label')); ?>
				<?= Form::password('old_password', Input::post('old_password', ''), array('class' => 'col-md-4 form-control')); ?>
			</div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Email', 'email', array('class'=>'control-label')); ?>
				<?= Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Mobile', 'mobile', array('class'=>'control-label')); ?>
				<?= Form::input('mobile', Input::post('mobile', isset($user->mobile) ? $user->mobile : ''), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<!-- <div class="form-group">
			<div class="col-md-3">
	            <label>
	                <input id="inactive" name="inactive" type="hidden" value="<?php //= isset($user) ? $user->inactive : '0'; ?>">
	                <?php /* Form::checkbox('activated_chk', Input::post('inactive',
	                                        isset($user) ? $user->inactive : null),
	                                        isset($user) && $user->inactive == 0 ? true : false,
	                                        array('class'=>'activated')
										); */ ?>
	                &ensp;Inactive
	            </label>
			</div>
		</div> -->

		<div class="form-group">
			<div class="col-md-3">
				<?= Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>
				<?= Form::input('last_login', Input::post('last_login', isset($user) ? date('d-M-Y H:m:s', $user->last_login) : ''), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>

			<div class="col-md-3">
				<?= Form::label('Previous login', 'previous_login', array('class'=>'control-label')); ?>
				<?= Form::input('previous_login', Input::post('previous_login', isset($user) ? date('d-M-Y H:m:s', $user->previous_login) : ''), array('class' => 'col-md-4 form-control', 'readonly'=>true)); ?>
			</div>
		</div>

		<hr>

		<div class="form-group">
			<div class="col-md-6">
				<?= Form::submit('submit', isset($user) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>

<?= Form::close(); ?>
