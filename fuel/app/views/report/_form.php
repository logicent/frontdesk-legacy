<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="col-md-6">
		<div class="form-group">
			<?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?= Form::input('name', Input::post('name', isset($report) ? $report->name : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="form-group">
			<?= Form::label('Slug', 'slug', array('class'=>'control-label')); ?>
			<?= Form::input('slug', Input::post('slug', isset($report) ? $report->slug : ''), array('class' => 'col-md-4 form-control slug')); ?>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
		<?= Form::label('Type', 'type', array('class'=>'control-label')); ?>
		<?= Form::select('type', Input::post('type', isset($report) ? $report->type : ''),
								Model_Report_Builder::$report_type,
								array('class' => 'form-control')); ?>
				</div>
			</div>
		</div>

		<div class="form-group">
            <label>
                <input id="activated" name="activated" type="hidden" value="<?= isset($report) ? $report->activated : null; ?>">
                <?= Form::checkbox('activated_chk', Input::post('activated',
                                        isset($report) ? $report->activated : null),
                                        isset($report) && $report->activated == 1 ? true : false,
                                        array('class'=>'activated')
                                        ); ?>
                &nbsp;Activated
            </label>
		</div>
	</div>

	<div class="clearfix">
	</div>

	<hr>
	<div class="form-button">
		<?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
	</div>

<?= Form::close(); ?>

<script>
	$('.activated').click(function() {
	    if ($(this).is(':checked')) // Boolean true
	        $('#activated').val(1);
	    else $('#activated').val(0);
	});
</script>
