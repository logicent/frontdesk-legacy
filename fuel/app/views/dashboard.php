<!-- Select Stats By Period to display -->
<!-- 
<div class="row">
    <div class="col-md-12">
        <?php // echo Form::open(array("class"=>"form-horizontal")); ?>
        <div class="form-group">
            <div class="col-md-12">
                <?php // echo Form::select('stats_period', array('class' => 'col-md-4 form-control'), 
                // array(
                    // 'today' => 'Today', 
                    // 'yesterday' => 'Yesterday', 
                    // 'this-week' => 'This week', 
                    // 'last-week' => 'Last week')
                    // 'this-month' => 'This month')
                    // 'last-month' => 'Last month')
                // ); ?>
            </div>
        </div>
        <?php // echo Form::close(); ?>
    </div>
</div>
-->
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div id="dashboard_tabs" class="btn-group btn-group-justified">
            <a id="accommodation-tab" data-toggle="tab" href="#accommodation" class="btn btn-default">Accommodation</a>
            <a id="rental-tab" data-toggle="tab" href="#rental" class="btn btn-default">Rental</a>
            <a id="hire-tab" data-toggle="tab" href="#hire" class="btn btn-default">Hire</a>
        </div>
    </div>
</div>

<div id="dashboard_tab_panels" class="tab-content">
    <div id="accommodation" class="tab-pane fade">
        <?= render('dashboard_a', $accommodation); ?>
    </div>
    <div id="rental" class="tab-pane fade">
        <?= render('dashboard_r', $rental); ?>
    </div>
    <div id="hire" class="tab-pane fade">
        <?= render('dashboard_a', $hire); ?>
    </div>
</div>

<script>
	$('#dashboard_tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        // remove active class
        $('#dashboard_tabs a').not('active').removeClass('active');
	});

	$('#dashboard_tabs a:first').tab('show').addClass('active');

// on change of selected stats_period dropdown list option fetch and refresh the stats values
</script>