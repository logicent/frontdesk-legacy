<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($rate_type) ? $rate_type->name : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::textarea('description', Input::post('description', isset($rate_type) ? $rate_type->description : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::hidden('enabled', Input::post('enabled', isset($rate_type) ? $rate_type->enabled : '0')); ?>
            <?= Form::checkbox('cb_enabled', null, array('class' => 'cb-checked', 'data-input' => 'enabled')); ?>
            <?= Form::label('Enabled', 'cb_enabled', array('class'=>'control-label')); ?>
        </div>
    </div>

    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($rate_type) ? $rate_type->fdesk_user : $uid)); ?>

	<hr>

	<div class="form-group">
		<div class="col-md-3">
		<?= Form::submit('submit', isset($rate_type) ? 'Update' : 'Add type', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
