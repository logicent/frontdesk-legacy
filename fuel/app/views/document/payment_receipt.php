<div class="text-center">
    <?php if (!empty($business->business_logo)) : ?>
        <?= Html::img($business->business_logo) ?>
    <?php else : ?>
        <h1><?= $business->trading_name ?></h1>
    <?php endif ?>
</div>
<p class="text-center"><?= $business->address; ?></p>
<!-- <br> -->
<p class="text-center"><span class="badge label-default">Payment Receipt</span></p>
<hr>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div><strong>No. :&emsp;</strong><span class="receipt-ID"><?= $receipt->reference; ?><span></div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="text-right"><strong>Date:&emsp;</strong><?= date('d-M-Y', strtotime($receipt->date)); ?></div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p><strong>Guest:&emsp;</strong><?= strtoupper($receipt->payer); ?></p>
        <!-- <br> -->
        <p><strong>Description:&emsp;</strong><?= $receipt->description; ?></p>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p class="text-right"><strong>Amount:&emsp;</strong><?= $business->currency_symbol .'&nbsp;'. number_format($receipt->amount, 2); ?></p>
    </div>
</div>
<!-- <br> -->

<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-3">
        <p><strong>Check-in:&emsp;</strong><?= date('d-M-Y H:i', strtotime($receipt->invoice->guest->checkin)); ?><span></p>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3">
        <p><strong>Check-out:&emsp;</strong><?= date('d-M-Y H:i', strtotime($receipt->invoice->guest->checkout)); ?></p>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3">
        <p class="text-right"><strong>Unit:&emsp;</strong><?= $receipt->invoice->guest->unit->name; ?><span></p>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3">
        <p class="text-right"><strong>Rate / night:&emsp;</strong><?= number_format($receipt->invoice->guest->rate_amount, 2); ?></p>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p class="small"><strong>Served by:</strong>&emsp;<?= $uname ?></p>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p class="small"><strong>Authorized by:</strong></p>
    </div>
</div>
