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
    <div class="col-md-12">
        <div id="dashboard_tabs" class="btn-group btn-group-justified">
        <?php if ($business->service_accommodation) : ?>
            <a id="accommodation-tab" data-toggle="tab" href="#accommodation" class="btn btn-default"><?= strtoupper('Accommodation') ?></a>
        <?php endif ?>
        <?php if ($business->service_rental) : ?>
            <a id="rental-tab" data-toggle="tab" href="#rental" class="btn btn-default"><?= strtoupper('Rental') ?></a>
        <?php endif ?>
        <?php if ($business->service_hire) : ?>
            <a id="hire-tab" data-toggle="tab" href="#hire" class="btn btn-default"><?= strtoupper('Hire') ?></a>
        <?php endif ?>
        <?php if ($business->service_sale) : ?>
            <a id="hire-tab" data-toggle="tab" href="#sale" class="btn btn-default"><?= strtoupper('Sale') ?></a>
        <?php endif ?>
        </div>
    </div>
</div>

<div id="dashboard_tab_panels" class="tab-content">
    <?php if ($business->service_accommodation) : ?>
        <div id="accommodation" class="tab-pane fade">
            <?= render('dashboard_accommodation', $accommodation); ?>
        </div>
    <?php endif ?>
    <?php if ($business->service_rental) : ?>
        <div id="rental" class="tab-pane fade">
            <?= render('dashboard_rental', $rental); ?>
        </div>
    <?php endif ?>
    <?php if ($business->service_hire) : ?>
        <div id="hire" class="tab-pane fade">
            <?= render('dashboard_hire', $hire); ?>
        </div>
    <?php endif ?>
    <?php if ($business->service_sale) : ?>
        <div id="sale" class="tab-pane fade">
            <?= render('dashboard_sale', $sale); ?>
        </div>
    <?php endif ?>
</div>

<script>
	$('#dashboard_tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        // remove active class
        $('#dashboard_tabs a').not('active').removeClass('active text-muted');
	});

	$('#dashboard_tabs a:first').tab('show').addClass('active text-muted');

// on change of selected stats_period dropdown list option fetch and refresh the stats values
</script>