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

<!-- Activity Stats Current/Selected Day only -->
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Guests Movement
            </div>
            <div class="panel-body">
                <div class="col-md-4 text-center">
                    <div class="text-center">
                        <p class="text-muted">CI</p>
                        <p class="text-center lead">
                            <?= $checkins[0]['total_ci'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">SO</p>
                        <p class="text-center lead">
                            <?= $stayovers[0]['total_so'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">CO</p>
                        <p class="text-center lead">
                            <?= $checkouts[0]['total_co'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Payments Made
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">Rec</p>
                        <p class="text-center lead">
                            <?= $receipts[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">Exp</p>
                        <p class="text-center lead">
                            <?= $expenses[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">Dep</p>
                        <p class="text-center lead">
                            <?= $deposits[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Rooms Availability
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">OCC</p>
                        <p class="text-center lead">
                            <?= $rooms_occupied[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">VAC</p>
                        <p class="text-center lead">
                            <?= $rooms_vacant[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">BLO</p>
                        <p class="text-center lead">
                            <?= $rooms_blocked[0]['count'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
</div>

<!-- Rooms Board -->
<div class="row">
    <div class="col-md-12">
    <?php 
        if ($audit_required && $ugroup->id == 5) : ?>
            <a class="btn btn-danger" href="<?= Uri::create("dashboard/nightaudit/".date('Y-m-d', time())); ?>">Run Nightly Audit</a>
    <?php 
        endif;
        if ($rollover_required && $ugroup->id == 5) : ?>
            <a class="btn btn-danger" href="<?= Uri::create("facility/bookings/stayover/".date('Y-m-d', time())); ?>">Run Stay Over</a>
    <?php 
        endif; ?>
    </div>
</div>

<?php 
    foreach($room_types as $rt) :
        $occupied_count = $vacant_count = $blocked_count = 0; ?>

    <div class="panel panel-default dash-panel text-center">

    <?php 
        $rate_amount = DB::select('charges')->from('rate')->where('type_id', $rt->id)->execute()->as_array(); ?>

        <h3 class="panel-heading"><?= $rt->name . '<span class="small">&nbsp;@&nbsp;'. $business->currency_symbol . '&nbsp;' . $rate_amount[0]['charges']. '</span>'; ?></h3>
        <!-- <br> -->
        <div class="panel-body">
    
    <?php 
        foreach($rt->rooms as $room) :
            // check if room has reservations
            $resMarker = '';
            if (count($room->reservations) > 0) :
                $resMarker = Html::anchor(Uri::create('facility/reservation/list_by/?room=' . $room->id), count($room->reservations), ['class' => 'label floating grow']);
            endif ?>

            <div class="btn-group dash-btn-group">
            <?php 
                if ($room->status == Model_Room::ROOM_STATUS_OCCUPIED) :
                    $occupied_count += 1;
                    foreach($guest_list as $guest) :
                        if ($guest->room_id != $room->id) continue; ?>
                        <?= $resMarker ?>
                        <button type="button" class="btn btn-warning dropdown-toggle dash-btn" data-toggle="dropdown">
                            <?= $room->name ?>
                        </button>

                        <?php // if ($ugroup->id == 6) continue; ?>

                        <ul class="dropdown-menu dash-dd-menu" role="menu">
                    <?php 
                        if (!is_null($guest->bill)) : ?>
                            <li><a href="<?= Uri::create("accounts/payment/receipt/create/{$guest->bill->id}"); ?>">Receive Money</a></li>
                            <li><a onclick="return confirm('Are you sure?')" href="<?= Uri::create('facility/booking/checkout/'.$guest->id); ?>">Check Out</a></li>
                    <?php 
                        endif ?>
                        <li class="divider"></li>
                        <li><a href="<?= Uri::create("facility/booking/edit/$guest->id"); ?>">Booking - <?= $guest->reg_no ?></a></li>
                    <?php 
                        if (!is_null($guest->bill)) : ?>
                            <li><a href="<?= Uri::create("accounts/salesinvoice/edit/{$guest->bill->id}"); ?>">Invoice - <?= $guest->bill->invoice_num ?></a></li>
                    <?php 
                        endif ?>
                        </ul>
                <?php 
                    endforeach;
                endif; ?>

            <?php 
                if ($room->status == Model_Room::ROOM_STATUS_VACANT) :
                    $vacant_count += 1; ?>
                    <?= $resMarker ?>
                    <button type="button" class="btn btn-success dropdown-toggle dash-btn" data-toggle="dropdown">
                        <?= $room->name ?>
                    </button>

                <?php // if ($ugroup->id == 6) continue; ?>

                <ul class="dropdown-menu dash-dd-menu" role="menu">
                    <li><a href="<?= Uri::create("facility/booking/create/$room->id"); ?>">New Booking</a></li>
                    <li><a href="<?= Uri::create("facility/reservation/create/$room->id"); ?>">New Reservation</a></li>
                <?php 
                    // if ($ugroup->id == 5) : ?>
                    <!-- <li class="divider"></li>
                    <li><a href="<?php //= Uri::create("room/block/$room->id"); ?>">Block Room</a></li> -->
                <?php 
                    // endif ?>
                </ul>
            <?php 
                endif; ?>

            <?php 
                if ($room->status == Model_Room::ROOM_STATUS_BLOCKED) :
                    $blocked_count += 1; ?>
                    <button type="button" class="btn btn-default dropdown-toggle dash-btn" data-toggle="dropdown">
                        <?= $room->name ?>
                    </button>
            <?php 
                if ($ugroup->id == 5) : ?>
                    <ul class="dropdown-menu dash-dd-menu" role="menu">
                        <li><a href="<?= Uri::create("room/unblock/$room->id"); ?>">Unblock Room</a></li>
                    </ul>
            <?php 
                endif; ?>
        <?php 
            endif; ?>

            </div><!-- /.btn-group -->
        <?php endforeach; ?>
        </div><!-- /.panel-body -->
        <div class="panel-footer">
            <div class="text-muted">
                <i class="fa fa-circle fa-fw text-success"></i> Vacant: <span><?= $vacant_count ?></span>&emsp; | &ensp;
                <i class="fa fa-circle fa-fw text-warning"></i> Occupied: <span><?= $occupied_count ?></span>&emsp; | &ensp;
                <i class="fa fa-circle fa-fw text-default"></i> Blocked: <span><?= $blocked_count ?></span>&emsp; | &ensp;
                Total: <span><?= count($rt->rooms) ?></span>
            </div>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
<?php 
    endforeach; ?>

<script>
// on change of selected stats_period dropdown list option fetch and refresh the stats values
</script>