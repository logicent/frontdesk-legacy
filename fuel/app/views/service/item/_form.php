<?= Form::open(array("class"=>"form-horizontal")); ?>

		<div class="form-group">
			<div class="col-md-2">
				<?= Form::label('Item', 'item', array('class'=>'control-label')); ?>
				<?= Form::input('item', Input::post('item', isset($service_item) ? $service_item->item : ''), array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4">
				<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
				<?= Form::input('description', Input::post('description', isset($service_item) ? $service_item->description : ''), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-2">
				<?= Form::label('Qty', 'qty', array('class'=>'control-label')); ?>
				<?= Form::input('qty', Input::post('qty', isset($service_item) ? $service_item->qty : Model_Service_Item::getColumnDefault('qty')), array('class' => 'col-md-4 form-control')); ?>
			</div>

			<div class="col-md-2">
				<?= Form::label('Unit price', 'unit_price', array('class'=>'control-label')); ?>
				<?= Form::input('unit_price', Input::post('unit_price', isset($service_item) ? $service_item->unit_price : ''), array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<hr>

		<div class="form-group">
			<div class="col-md-6">
			<?= Form::submit('submit', isset($service_item) ? 'Update item' : 'Add item', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
<?= Form::close(); ?>
