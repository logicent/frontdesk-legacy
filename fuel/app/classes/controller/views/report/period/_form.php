<?= Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?= Form::label('From date', 'from_date', array('class'=>'control-label')); ?>

				<?= Form::input('from_date', Input::post('from_date', isset($report_period) ? $report_period->from_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'From date')); ?>

		</div>
		<div class="form-group">
			<?= Form::label('To date', 'to_date', array('class'=>'control-label')); ?>

				<?= Form::input('to_date', Input::post('to_date', isset($report_period) ? $report_period->to_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'To date')); ?>

		</div>
		<div class="form-group">
			<?= Form::label('Acctg method', 'acctg_method', array('class'=>'control-label')); ?>

				<?= Form::input('acctg_method', Input::post('acctg_method', isset($report_period) ? $report_period->acctg_method : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Acctg method')); ?>

		</div>
		<div class="form-group">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>

				<?= Form::input('description', Input::post('description', isset($report_period) ? $report_period->description : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Description')); ?>

		</div>
		<div class="form-group">
			<?= Form::label('Report type', 'report_type', array('class'=>'control-label')); ?>

				<?= Form::input('report_type', Input::post('report_type', isset($report_period) ? $report_period->report_type : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Report type')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?= Form::close(); ?>