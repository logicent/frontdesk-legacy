<div class="row">
	<div class="col-md-6">
		&nbsp;
	</div>

	<div class="col-md-6">
		<?php if($ugroup->id == 6) : ?>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('report', '<i class="fa fa-list-alt fa-fw fa-lg"></i> Reports', array('class' => 'btn btn-warning')); ?>
			</div>
			<!-- <div class="btn-group"> -->
				<?php // echo Html::anchor('#report/period', 'Define Period', array('class' => 'btn btn-info')); ?>
			<!-- </div> -->
		</div>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<h4 class="panel-heading">Daily Reports</h4>
			<div class="panel-body">
				<div class="row">
					<?= Form::open(array("class"=>"form-horizontal", "method"=>"post", "action"=> Uri::create('reports/show-daily-report'), 'target'=>'_blank')); ?>
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-8">
								<label for="rpt_name" class='control-label'>Select a report: </label>
								<select class='form-control' id='rpt_name' name='rpt_name'>
								<!-- <div class="list-group"> -->
									<?php foreach ($reports as $report) : ?>
										<?php if ($report->type != 'd') continue; ?>
										<option value="<?= $report->slug; ?>"><?= $report->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<label for="rpt_date" class='control-label'>Date of: </label>
						<div class="input-group date" id="dp3" data-date="<?= date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
							<input class='form-control datepicker' id='rpt_date' name='rpt_date' value="<?= strftime('%Y-%m-%d', time()); ?>">
						  	<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
						</div>
					</div>

					<div class="col-md-4">
						<label class="control-label">&nbsp;</label>
						<button class="form-control btn btn-info">Generate</button>
						<!-- <a class="form-control btn btn-default" href="<?= Uri::create('reports/show'); ?>" target="_blank" >Generate</a> -->
					</div>
					<?= Form::close(); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<h4 class="panel-heading">Monthly Reports</h4>
			<div class="panel-body">
				<div class="row">
					<?= Form::open(array("class"=>"form-horizontal", "method"=>"post", "action"=> Uri::create('reports/show-monthly-report'), 'target'=>'_blank')); ?>
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-8">
								<label for="rpt_name" class='control-label'>Select a report: </label>
								<select class='form-control' id='rpt_name' name='rpt_name' value="">
								<!-- <div class="list-group"> -->
									<?php foreach ($reports as $report) : ?>
										<?php if ($report->type != 'm') continue; ?>
										<option value="<?= $report->slug; ?>"><?= $report->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<label for="rpt_period" class='control-label'>Month of: </label>
						<input class='form-control dateperiod' id='rpt_period' name='rpt_period' value="<?= strftime('%Y-%m', time()); ?>">
					</div>

					<div class="col-md-4">
						<label class="control-label">&nbsp;</label>
						<button class="form-control btn btn-info">Generate</button>
					</div>
					<?= Form::close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Date range picker for Booking
	var nowTemp = new Date();
	var today = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate());
	var month = new Date(nowTemp.getFullYear(), nowTemp.getMonth());

	$('.datepicker').datepicker({
		"format" : "yyyy-mm-dd",
		"viewMode" : "days",
		onRender: function(date) {
			return date.valueOf() > today.valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		$(this).datepicker('hide');
		// set focus back to datepicker control
	});

	$('.dateperiod').datepicker({
		"format" : "yyyy-mm",
		"viewMode" : "months",
		onRender: function(month) {
			return month.valueOf() > month.valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		$(this).datepicker('hide');
		// set focus back to datepicker control
	});
</script>
