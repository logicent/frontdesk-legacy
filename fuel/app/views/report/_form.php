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
                <input id="published" name="published" type="hidden" value="<?= isset($report) ? $report->published : null; ?>">
                <?= Form::checkbox('published_chk', Input::post('published',
                                        isset($report) ? $report->published : null),
                                        isset($report) && $report->published == 1 ? true : false,
                                        array('class'=>'published')
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
	$('.published').click(function() {
	    if ($(this).is(':checked')) // Boolean true
	        $('#published').val(1);
	    else $('#published').val(0);
	});
</script>
