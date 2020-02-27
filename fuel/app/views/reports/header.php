<!-- header -->
<div class="row">
    <div class="col-md-4">
        <?php if (!empty($business->business_logo)) : ?>
            <?= Html::img($business->business_logo, ['style' => 'max-width: 120px']) ?>
        <?php else : ?>
            <div>
                <span class="lead"><?= $business->trading_name ?></span>
                <br>
                <small><?= $business->address ?></small>
            </div>
        <?php endif ?>
    </div>

    <div class="col-md-4 text-center">
        <h1>FrontDesk</h1>
        <!-- <div class="report-header"> -->
        <h2><?= $report->name; ?></h2>
        <!-- </div> -->
    </div>

    <div class="col-md-4 text-right">
        <!-- <p class="report-pagination">Page : <?php // echo $pn; ?></p> -->
        <p><strong>Printed By</strong> : <?= $uname; ?></p>
        <p><strong>Printed Date</strong> : <?= date('d/m/Y h:i:s a'); ?></p>
    </div>
</div>

<hr>

<p>Report as on: <?= $report->date_of ?></p>

<hr>
