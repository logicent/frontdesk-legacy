<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Tenant Movement
            </div>
            <div class="panel-body">
                <div class="col-md-4 text-center">
                    <div class="text-center">
                        <p class="text-muted">IN</p>
                        <p class="text-center lead">
                            <?= $new_leases[0]['total_new'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">ON</p>
                        <p class="text-center lead">
                            <?= $active_leases[0]['total_active'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">OUT</p>
                        <p class="text-center lead">
                            <?= $expiring_leases[0]['total_ending'] ?>
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
                Units Availability
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">OCC</p>
                        <p class="text-center lead">
                            <?= $units_occupied[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">VAC</p>
                        <p class="text-center lead">
                            <?= $units_vacant[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted">BLO</p>
                        <p class="text-center lead">
                            <?= $units_blocked[0]['count'] ?>
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

<!-- Units Board -->
<div class="row">
    <div class="col-md-12">
    <?php 
        if ($audit_required && $ugroup->id == 5) : ?>
            <a class="btn btn-danger" href="<?= Uri::create("dashboard/monthaudit/".date('Y-m-d', time())); ?>">Run Monthly Audit</a>
    <?php 
        endif;
        // if ($rollover_required && $ugroup->id == 5) : ?>
            <!--<a class="btn btn-danger" href="<?= Uri::create("registers/lease/ongoing/".date('Y-m-d', time())); ?>">Run Monthly Invoices</a>-->
    <?php 
        // endif; ?>
    </div>
</div>

<?php 
    foreach($unit_types as $rt) :
        $occupied_count = $vacant_count = $blocked_count = 0; ?>

    <div class="panel panel-default dash-panel text-center">

    <?php 
        $rate_amount = DB::select('charges')->from('rate')->where('type_id', $rt->id)->execute()->as_array(); ?>

        <h3 class="panel-heading"><?= $rt->name . '<span class="small">&nbsp;@&nbsp;'. $business->currency_symbol . '&nbsp;' . $rate_amount[0]['charges']. '</span>'; ?></h3>
        <!-- <br> -->
        <div class="panel-body">
    
    <?php 
        foreach($rt->units as $unit) :
            // check if unit has reservations
            $resMarker = '';
            if (count($unit->reservations) > 0) :
                $resMarker = Html::anchor(Uri::create('registers/reservation/list_by/?unit=' . $unit->id), count($unit->reservations), ['class' => 'label floating grow']);
            endif ?>

            <div class="btn-group dash-btn-group">
            <?php 
                if ($unit->status == Model_Unit::UNIT_STATUS_OCCUPIED) :
                    $occupied_count += 1;
                    foreach($customer_list as $customer) :
                        if ($customer->unit_id != $unit->id) continue; ?>
                        <?= $resMarker ?>
                        <button type="button" class="btn btn-warning dropdown-toggle dash-btn" data-toggle="dropdown">
                            <?= $unit->name ?>
                        </button>

                        <?php // if ($ugroup->id == 6) continue; ?>

                        <ul class="dropdown-menu dash-dd-menu" role="menu">
                    <?php 
                        if (!is_null($customer->bill)) : ?>
                            <li><a href="<?= Uri::create("accounts/payment/receipt/create/{$customer->bill->id}"); ?>">Receive Money</a></li>
                            <li><a onclick="return confirm('Are you sure?')" href="<?= Uri::create('registers/lease/vacate/'.$customer->id); ?>">Vacate</a></li>
                    <?php 
                        endif ?>
                        <li class="divider"></li>
                        <li><a href="<?= Uri::create("registers/lease/edit/$customer->id"); ?>">Lease - <?= $customer->reg_no ?></a></li>
                    <?php 
                        if (!is_null($customer->bill)) : ?>
                            <li><a href="<?= Uri::create("sales/invoice/edit/{$customer->bill->id}"); ?>">Invoice - <?= $customer->bill->invoice_num ?></a></li>
                    <?php 
                        endif ?>
                        </ul>
                <?php 
                    endforeach;
                endif; ?>
            <?php 
                if ($unit->status == Model_Unit::UNIT_STATUS_VACANT) :
                    $vacant_count += 1; ?>
                    <?= $resMarker ?>
                    <button type="button" class="btn btn-success dropdown-toggle dash-btn" data-toggle="dropdown">
                        <?= $unit->name ?>
                    </button>

                <?php // if ($ugroup->id == 6) continue; ?>

                <ul class="dropdown-menu dash-dd-menu" role="menu">
                    <li><a href="<?= Uri::create("registers/lease/create/$unit->id"); ?>">New Lease</a></li>
                    <li><a href="<?= Uri::create("registers/reservation/create/$unit->id"); ?>">New Reservation</a></li>
                <?php 
                    // if ($ugroup->id == 5) : ?>
                    <!-- <li class="divider"></li>
                    <li><a href="<?php //= Uri::create("unit/block/$unit->id"); ?>">Block Unit</a></li> -->
                <?php 
                    // endif ?>
                </ul>
            <?php 
                endif; ?>
            <?php 
                if ($unit->status == Model_Unit::UNIT_STATUS_BLOCKED) :
                    $blocked_count += 1; ?>
                    <button type="button" class="btn btn-default dropdown-toggle dash-btn" data-toggle="dropdown">
                        <?= $unit->name ?>
                    </button>
            <?php 
                if ($ugroup->id == 5) : ?>
                    <ul class="dropdown-menu dash-dd-menu" role="menu">
                        <li><a href="<?= Uri::create("unit/unblock/$unit->id"); ?>">Unblock Unit</a></li>
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
                Total: <span><?= count($rt->units) ?></span>
            </div>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
<?php 
    endforeach; ?>

<script>
// on change of selected stats_period dropdown list option fetch and refresh the stats values
</script>