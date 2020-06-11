<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($unit) ? $unit->name : ''),
							array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>

		<div class="col-md-3">
			<?= Form::label('Prefix', 'prefix', array('class'=>'control-label')); ?>
			<?= Form::input('prefix', Input::post('prefix', isset($unit) ? $unit->prefix : ''),
							array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Unit type', 'unit_type', array('class'=>'control-label')); ?>
			<?= Form::select('unit_type', Input::post('unit_type', isset($unit) ? $unit->unit_type : ''),
                            Model_Unit_Type::listOptions(), array('class' => 'col-md-4 form-control')); ?>
		</div>

		<!--<div class="col-md-3">-->
		<!--	<?= Form::label('Rate type', 'rate_type', array('class'=>'control-label')); ?>-->
		<!--	<?= Form::select('rate_type', Input::post('rate_type', isset($guest_register) ? $guest_register->rate_type : ''), Model_Rate::listOptions(), array('class' => 'col-md-4 form-control')); ?>-->
		<!--</div>-->
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::select('status', Input::post('status', isset($unit) ? $unit->status : Model_Unit::UNIT_STATUS_VACANT), Model_Unit::$unit_status, array('class' => 'col-md-4 form-control', 'readonly' => isset($unit) ? true : false)); ?>
		</div>
	</div>
	<?php if ($business->service_accommodation) : ?>
	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('HK status', 'hk_status', array('class'=>'control-label')); ?>
			<?= Form::select('hk_status', Input::post('hk_status', isset($unit) ? $unit->hk_status : Model_Unit::HK_STATUS_CLEAN),
							Model_Unit::$hk_status, 
							array('class' => 'col-md-4 form-control', 'readonly'=>isset($unit) ? true : false)); ?>
		</div>
    </div>
	<?php endif ?>
    <hr>
    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property) ? $property->fdesk_user : $uid)); ?>

	<div class="form-group">
		<div class='col-md-6'>
			<?= Form::submit('submit', isset($unit) ? 'Update' : 'Add unit', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>

<?= Form::close(); ?>
