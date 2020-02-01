<!-- Activity Stats Current Day only -->
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Guests
            </div>
            <div class="panel-body">
                <div class="col-md-4 text-center">
                    <div class="text-center">
                        <p class="text-muted small">CI</p>
                        <p class="text-center lead">
                            <?= $checkins[0]['total_ci'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">SO</p>
                        <p class="text-center lead">
                            <?= $stayovers[0]['total_so'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">CO</p>
                        <p class="text-center lead">
                            <?= $checkouts[0]['total_co'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted small">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Payments
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">Rec.</p>
                        <p class="text-center lead">
                            <?= $receipts[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">Exp.</p>
                        <p class="text-center lead">
                            <?= $expenses[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">Dep.</p>
                        <p class="text-center lead">
                            <?= $deposits[0]['total_amount'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted small">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Rooms
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">OCC</p>
                        <p class="text-center lead">
                            <?= $rooms_occupied[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">VAC</p>
                        <p class="text-center lead">
                            <?= $rooms_vacant[0]['count'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <p class="text-muted small">BLO</p>
                        <p class="text-center lead">
                            <?= $rooms_blocked[0]['count'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="panel-footer text-center ">
                <span class="text-muted small">TODAY</span>
            </div> -->
        </div>
    </div>
    <!-- /.col-lg-4 -->
</div>

<!-- Rooms Board -->
<div class="row">
    <div class="col-md-12">
        <?php if ($audit_required && $ugroup->id == 5) : ?>
            <a class="btn btn-danger" href="<?= Uri::create("dashboard/nightaudit/".date('Y-m-d', time())); ?>">Run Nightly Audit</a>
        <?php endif; ?>
        <?php if ($rollover_required && $ugroup->id == 5) : ?>
            <a class="btn btn-danger" href="<?= Uri::create("front-desk/bookings/stayover/".date('Y-m-d', time())); ?>">Run Stay Over</a>
        <?php endif; ?>
    </div>
</div>

<?php foreach($room_types as $rt) : ?>
    <?php $occupied_count = $vacant_count = $blocked_count = 0; ?>
    <div class="panel panel-default dash-panel text-center">
        <?php $rate_amount = DB::select('charges')->from('rate')->where('type_id', $rt->id)->execute()->as_array(); ?>
        <h3 class="panel-heading"><?= $rt->name . '<span class="small">&nbsp;@&nbsp;'. $business->currency_symbol . '&nbsp;' . $rate_amount[0]['charges']. '</span>'; ?></h3>
        <!-- <br> -->
        <div class="panel-body">
        <?php foreach($rt->rooms as $room) : ?>
          <div class="btn-group dash-btn-group">
              <?php if ($room->status == Model_Room::ROOM_STATUS_OCCUPIED) : ?>
                  <?php $occupied_count += 1 ?>
                  <?php foreach($guest_list as $guest) : ?>
                      <?php if ($guest->room_id != $room->id) continue; ?>
                <!--<button type="button" class="btn btn-warning"><?= $room->name;?></button>-->
                <button type="button" class="btn btn-warning dropdown-toggle dash-btn" data-toggle="dropdown">
                  <?= $room->name;?>
                  <!-- <span class="caret"></span> -->
                </button>

                <?php // if ($ugroup->id == 6) continue; ?>

                <ul class="dropdown-menu dash-dd-menu" role="menu">
                <?php 
                    if (!is_null($guest->bill)) : ?>
                    <li><a href="<?= Uri::create("cash/receipt/create/{$guest->bill->id}"); ?>">Receive Money</a></li>
                    <li><a onclick="return confirm('Are you sure?')" href="<?= Uri::create('fd/booking/checkout/'.$guest->id); ?>">Check Out</a></li>
                <?php 
                    endif ?>
                  <li class="divider"></li>
                  <li><a href="<?= Uri::create("fd/booking/edit/$guest->id"); ?>">Edit Booking</a></li>
                  <?php 
                    if (!is_null($guest->bill)) : ?>                  
                    <li><a href="<?= Uri::create("sales/invoice/edit/{$guest->bill->id}"); ?>">Guest Folio</a></li>
                  <?php 
                    endif ?>
                </ul>

                <?php endforeach; ?>
              <?php endif; ?>

              <?php if ($room->status == Model_Room::ROOM_STATUS_VACANT) : ?>
                  <?php $vacant_count += 1 ?>
                  <button type="button" class="btn btn-success dropdown-toggle dash-btn" data-toggle="dropdown">
                    <?= $room->name; ?>
                    <!-- <span class="caret"></span> -->
                  </button>

                  <?php // if ($ugroup->id == 6) continue; ?>

                  <ul class="dropdown-menu dash-dd-menu" role="menu">
                    <li><a href="<?= Uri::create("fd/booking/create/$room->id"); ?>">New Booking</a></li>
                    <li><a href="<?= Uri::create("fd/reservation/create/$room->id"); ?>">New Reservation</a></li>
                    <?php if ($ugroup->id == 5) : ?>
                        <!-- <li class="divider"></li>
                        <li><a href="<?php //= Uri::create("room/block/$room->id"); ?>">Block Room</a></li> -->
                    <?php endif ?>
                  </ul>
              <?php endif; ?>

              <?php if ($room->status == Model_Room::ROOM_STATUS_BLOCKED) : ?>
                  <?php $blocked_count += 1 ?>
                  <button type="button" class="btn btn-default dropdown-toggle dash-btn" data-toggle="dropdown">
                    <?= $room->name ?>
                    <!-- <span class="caret"></span> -->
                  </button>
                  <?php if ($ugroup->id == 5) : ?>
                      <ul class="dropdown-menu dash-dd-menu" role="menu">
                        <li><a href="<?= Uri::create("room/unblock/$room->id"); ?>">Unblock Room</a></li>
                      </ul>
                  <?php endif; ?>
              <?php endif; ?>

          </div><!-- /.btn-group -->
        <?php endforeach; ?>
        </div><!-- /.panel-body -->
        <div class="panel-footer">
            <div class="text-muted">
                <i class="fa fa-circle fa-fw text-success"></i> Vacant: <span class="label label-default"><?= $vacant_count ?></span>&ensp;|&nbsp;
                <i class="fa fa-circle fa-fw text-warning"></i> Occupied: <span class="label label-default"><?= $occupied_count ?></span>&ensp;|&nbsp;
                <i class="fa fa-circle fa-fw text-default"></i> Blocked: <span class="label label-default"><?= $blocked_count ?></span>&ensp;|&nbsp;
                Total: <span class="label label-default"><?= count($rt->rooms) ?></span>
            </div>
        </div><!-- /.panel-body -->
      </div><!-- /.panel -->
<?php endforeach; ?>
