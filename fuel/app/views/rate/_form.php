<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Unit type', 'unit_type', array('class'=>'control-label')); ?>
			<?= Form::select('type_id', Input::post('type_id', isset($rate) ? $rate->type_id : ''),
									Model_Unit_Type::listOptions(), array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Rate', 'rate_id', array('class'=>'control-label')); ?>
			<?= Form::select('rate_id', Input::post('rate_id', isset($rate) ? $rate->rate_id : ''),
									Model_Rate_Type::listOptions(), array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-3">
			<?= Form::label('Charges', 'charges', array('class'=>'control-label')); ?>
			<?= Form::input('charges', Input::post('charges', isset($rate) ? $rate->charges : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::textarea('description', Input::post('description', isset($rate) ? $rate->description : ''),
                                array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<div class="col-md-3">
			<?= Form::submit('submit', isset($rate) ? 'Update' : 'Add rate', array('class' => 'btn btn-primary')); ?>
		</div>
	</div>
<?= Form::close(); ?>
