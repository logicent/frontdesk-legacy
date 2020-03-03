<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FrontDesk &ndash; <?= $title; ?></title>
        <!--
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        -->
        <!-- CSS libraries/plugins -->
        <?= Asset::css(
            array(
                '//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
                '//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
                '//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',
                '//www.fuelcdn.com/fuelux/3.17.0/css/fuelux.min.css',
                '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
                '//cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css',
                'vendor/united.bootstrap.min.css',
                'vendor/datepicker.css',
                'vendor/fullcalendar.min.css',
                'sb-admin.css', // SB Admin Scripts
                'custom.css'
            )); ?>

        <!-- JavaScript libraries/plugins -->
        <?= Asset::js(
            array(
                // '//cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js',
                '//code.jquery.com/jquery-3.4.1.js',
                '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
                '//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
                '//www.fuelcdn.com/fuelux/3.17.0/js/fuelux.min.js',
                'vendor/jquery.slugify.js',
                'vendor/bootstrap-datepicker.js',
                'plugins/metisMenu/jquery.metisMenu.js',
                '//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
                '//cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js',
                'vendor/moment.js',
                'vendor/fullcalendar.min.js',
                'sb-admin.js', // SB Admin Scripts
                'custom.js',
            )); ?>
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="col-md-2">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= Uri::create('/'); ?>">FrontDesk</a><!-- SB Admin v2.0 -->
                    </div>  <!-- /.navbar-header -->
                </div>

                <div class="col-md-6">
                    <ul class="nav navbar-top-links">
                        <li><a class="<?= Uri::segment(1) == 'dashboard' ? 'active' : '' ?>" href="<?= Uri::create('dashboard'); ?>"><i class="fa fa-lg fa-trello fa-fw text-info"></i>&ensp;Dashboard</a></li>
                        <li><a class="<?= Uri::segment(1) == 'calendar' ? 'active' : '' ?>" href="<?= Uri::create('calendar'); ?>"><i class="fa fa-lg fa-calendar-check-o fa-fw text-success"></i>&ensp;Calendar</a></li>
                        <li><a class="<?= Uri::segment(1) == 'reports' ? 'active' : '' ?>" href="<?= Uri::create('reports'); ?>"><i class="fa fa-lg fa-pie-chart fa-fw text-warning"></i>&ensp;Reports</a></li>
                    </ul>   <!-- /.navbar-top-links -->
                </div>

                <div class="col-md-4">
                    <ul class="nav navbar-top-links navbar-right">
                        <li><a class="<?= Uri::segment(1) == 'forex' ? 'active' : '' ?>" href="<?= Uri::create('forex'); ?>"><i class="fa fa-lg fa-dollar fa-fw text-muted"></i></a></li>
                        <li><a class="<?= Uri::segment(1) == 'help' ? 'active' : '' ?>" href="<?= Uri::create('help'); ?>"><i class="fa fa-lg fa-question-circle fa-fw text-muted"></i></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $uname; ?>
                                <i class="fa fa-lg fa-user fa-fw text-muted"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="<?= Uri::create('users/edit/'.$uid) ?>"> My Account</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= Uri::create('logout') ?>"> Log out</a></li>
                            </ul>   <!-- /.dropdown-user -->
                        </li>   <!-- /.dropdown -->
                    </ul>   <!-- /.navbar-top-links -->
                </div>

                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <div id="sidebar-header" class="text-center">
                                    <?php if (!empty($business->business_logo)) : ?>
                                        <?= Html::anchor(Uri::create('/'),
                                            Html::img($business->business_logo, ['style' => 'max-width: 220px']), [])
                                        ?>
                                    <?php else : ?>
                                        <span class="lead"><?= isset($business) ? $business->trading_name : '' ?></span>
                                    <?php endif ?>
                                </div>
                            </li>
                            <li>
                                <!-- Wait(ing) List -->
                                <a href="#"><i class="fa fa-lg fa-book fa-fw text-default"></i>&emsp;Registers<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?= Uri::create('registers/reservation'); ?>"><i class=""></i>&emsp;Reservation</a></li>
                                    <li><a href="<?= Uri::create('registers/booking'); ?>"><i class=""></i>&emsp;Booking</a></li>
                                    <li><a href="<?= Uri::create('registers/lease'); ?>"><i class=""></i>&emsp;Lease</a></li>
                                    <li><a href="<?= Uri::create('registers/customer'); ?>"><i class=""></i>&emsp;Customer</a></li>
                                    <li><a href="<?= Uri::create('registers/partner'); ?>"><i class=""></i>&emsp;Partner</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-lg fa-money fa-fw text-success"></i>&emsp;Billing &amp; Payments<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?= Uri::create('accounts/sales-invoice'); ?>"><i class=""></i>&emsp;Sales Invoice</a></li>
                                    <li><a href="<?= Uri::create('accounts/sales-receipt'); ?>">&emsp;Sales Receipt</a></li>
                                    <li><a href="<?= Uri::create('accounts/expenses'); ?>">&emsp;Expenses</a></li>
                                    <li><a href="<?= Uri::create('accounts/bank-deposit'); ?>">&emsp;Bank Deposit</a></li>
                                    <!--<li><a href="<?= Uri::create('accounts/gift-voucher'); ?>">&emsp;Gift Vouchers</a></li>-->
                                </ul>
                            </li>
                            <?php
                                if ($ugroup->id == 6 || $ugroup->id == 5) : ?>
                            <li>
                                <a href="#"><i class="fa fa-lg fa-building fa-fw text-danger"></i>&emsp;Facilities<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?= Uri::create('facilities/rates'); ?>"><i class=""></i>&emsp;Rates</a></li>
                                    <li><a href="<?= Uri::create('facilities/rate-type'); ?>"><i class=""></i>&emsp;Rate Type</a></li>
                                    <li><a href="<?= Uri::create('facilities/units'); ?>"><i class=""></i>&emsp;Units</a></li>
                                    <li><a href="<?= Uri::create('facilities/unit-type'); ?>"><i class=""></i>&emsp;Unit Type</a></li>
                                    <li><a href="<?= Uri::create('facilities/property'); ?>"><i class=""></i>&emsp;Property</a></li>
                                    <li><a href="<?= Uri::create('facilities/services'); ?>"><i class=""></i>&emsp;Services</a></li>                                
                                </ul>
                            </li>
                            <li>
                                <a class="<?= Uri::segment(1) == 'users' ? 'active' : '' ?>" href="<?= Uri::create('users'); ?>">
                                    <i class="fa fa-lg fa-users fa-fw text-warning"></i>&emsp;Users</a>
                            </li>
                            <li>
                                <a class="<?= Uri::segment(1) == 'settings' ? 'active' : '' ?>" href="<?= Uri::create('settings'); ?>">
                                    <i class="fa fa-lg fa-cog fa-fw text-muted"></i>&emsp;Settings</a>
                            </li>
                            <?php
                                endif; ?>
                        </ul>   <!-- /#side-menu -->
                    </div>  <!-- /.sidebar-collapse -->
                </div>  <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
    <?php 
        if (Session::get_flash('success')): ?>
                <div class="alert alert-success alert-dismissable alert-popup">
                    <h4>Success:
                        <span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></span>
                    </h4>
                    <div class="alert-popup-detail">
                        <?= implode('<hr>', e( (array) Session::get_flash('success'))); ?>
                    </div>
                </div>
    <?php 
        endif; ?>
    <?php 
        if (Session::get_flash('error')): ?>
                <div class="alert alert-danger alert-dismissable alert-popup">
                    <h4>Some error(s) were ecountered:
                        <span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></span>
                    </h4>
                    <div class="alert-popup-detail">
                        <?= implode('<hr>', e( (array) Session::get_flash('error'))); ?>
                    </div>
                </div>
    <?php 
        endif; ?>
    <?php 
        if (Session::get_flash('warning')): ?>
                <div class="alert alert-warning alert-dismissable alert-popup">
                    <h4>Some warning(s) were ecountered:
                        <span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></span>
                    </h4>
                    <div class="alert-popup-detail">
                        <?= implode('<hr>', e( (array) Session::get_flash('warning'))); ?>
                    </div>
                </div>
    <?php 
        endif; ?>
    <?php 
        if (Session::get_flash('info')): ?>
                <div class="alert alert-info alert-dismissable alert-popup">
                    <h4>Some info for you:
                        <span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></span>
                    </h4>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <div class="alert-popup-detail">
                        <?= implode('<hr>', e( (array) Session::get_flash('info'))); ?>
                    </div>
                </div>
    <?php 
        endif; ?>
                <div id="content" class="row content-pane">
                    <div class="col-lg-12">
                <!-- Dashboard and Reports container -->
            <?php if (
                    Uri::segment(1) == '' ||
                    Uri::segment(1) == 'dashboard' ||
                    Uri::segment(1) == 'calendar' ||
                    Uri::segment(1) == 'reports' ||
                    Uri::segment(1) == 'settings'): ?>
                        <!-- List Grids and Forms container -->
                        <div class="panel">
                            <?= $content; ?>
                        </div>
            <?php else: ?>
                        <!--<h1 class="page-header"><?= $title; ?></h1>-->
                        <div class="panel"><!-- panel-default -->
                            <div class="panel-body">
                                <?= $content; ?>
                            </div>
                        </div>  <!-- /.panel -->
            <?php endif; ?>
                    </div>  <!-- /.col-lg-12  -->
                </div>  <!-- /.row -->

            </div>  <!-- /#page-wrapper -->

            <footer id="footer" class="text-center small">
                <a href="http://logicent.co/solutions/hotel-front-office.html" target="_blank">FrontDesk</a> &copy; 2014-<?= date('Y'); ?> All Rights Reserved.
            </footer>
        </div>  <!-- /#wrapper -->
        
    </body>
</html>
