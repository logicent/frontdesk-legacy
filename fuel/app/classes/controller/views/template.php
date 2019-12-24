<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E1 FrontDesk &ndash; <?= $title; ?></title>
    <!-- Core CSS -->
    <?= Asset::css(array(
                    'vendor/bootstrap.min.css',
                    'vendor/yeti.bootstrap.min.css',
                    // 'vendor/united.bootstrap.min.css',
                    'vendor/fuelux.min.css',
                    'vendor/datepicker.css',
                    '../font-awesome/css/font-awesome.min.css', // Glyphicons replacement
                    '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
                    'sb-admin.css', // SB Admin Scripts
                    'custom.css'
            )); ?>

    <!-- Page-Level Plugin CSS - Tables -->
    <?= Asset::css('plugins/dataTables/dataTables.bootstrap.css'); ?>

    <!-- Core Scripts -->
    <?= Asset::js(array('vendor/jquery-1.11.1.min.js',
                                'vendor/bootstrap.min.js',
                                'vendor/fuelux.min.js',
                                'vendor/knockout-3.2.0.js',
                                'vendor/jquery.slugify.js',
                                'vendor/bootstrap-datepicker.js',
                                'plugins/metisMenu/jquery.metisMenu.js',
                                'plugins/dataTables/jquery.dataTables.js',
                                'plugins/dataTables/dataTables.bootstrap.js',
                                'sb-admin.js', // SB Admin Scripts
                                'custom.js',
                                //cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js
                        )); ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Uri::create('/'); ?>">E1 FrontDesk</a><!-- SB Admin v2.0 -->
            </div>  <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li><a class="<?= Uri::segment(1) == 'dashboard' ? 'active' : '' ?>" href="<?= Uri::create('dashboard'); ?>"><i class="fa fa-th fa-fw"></i>&ensp;Dashboard</a></li>
                <li><a class="<?= Uri::segment(1) == 'reports' ? 'active' : '' ?>" href="<?= Uri::create('reports'); ?>"><i class="fa fa-file-text fa-fw"></i>&ensp;Reports</a></li>
                <?php if ($ugroup->id == 5 || $ugroup->id == 6) : ?>
                    <li><a class="<?= Uri::segment(1) == 'users' ? 'active' : '' ?>" href="<?= Uri::create('users'); ?>"><i class="fa fa-users fa-fw"></i>&ensp;Users</a></li>
                    <!--<li class="active"><a href="#modules">Modules</a></li>-->
                    <li><a class="<?= Uri::segment(1) == 'settings' ? 'active' : '' ?>" href="<?= Uri::create('settings'); ?>"><i class="fa fa-cog fa-fw"></i>&ensp;Settings</a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $uname; ?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?= Uri::create('users/edit/'.$uid) ?>"><i class="fa fa-edit fa-fw"></i> Edit Account</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= Uri::create('logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a></li>
                    </ul>   <!-- /.dropdown-user -->
                </li>   <!-- /.dropdown -->
            </ul>   <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <div id="sidebar-header" class="text-center">
                                <?php if (!empty($business->business_logo)) : ?>
                                    <?= Html::img($business->business_logo, ['style' => 'max-width: 220px']) ?>
                                <?php else : ?>
                                    <span class="lead"><?= isset($business) ? $business->trading_name : '' ?></span>
                                <?php endif ?>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i>&ensp;Guest Register<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
              				    <li><a href="<?= Uri::create('front-desk/reservations'); ?>"><i class=""></i>&ensp; Reservations</a></li>
              				    <li><a href="<?= Uri::create('front-desk/bookings'); ?>"><i class=""></i>&ensp; Bookings</a></li>
                                <li><a href="<?= Uri::create('front-desk/invoices'); ?>"><i class=""></i>&ensp; Folios</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i>&ensp;Cash Control<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= Uri::create('cash-control/receipts'); ?>">&ensp;Cash Receipts</a></li>
                                <li><a href="<?= Uri::create('cash-control/expenses'); ?>">&ensp;Cash Expenses</a></li>
              				</ul>
                        </li>
                        <?php if ($ugroup->id == 5 || $ugroup->id == 6) : ?>
						<li>
                            <a href="#"><i class="fa fa-bank fa-fw"></i>&ensp;Banking<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= Uri::create('banking/bank-deposits'); ?>">&ensp;Bank Deposits</a></li>
                                <li><a href="<?= Uri::create('banking/bank-accounts'); ?>">&ensp;Bank Accounts</a></li>
                            </ul>   <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building fa-fw"></i>&ensp;Accommodation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= Uri::create('accommodation/rooms'); ?>"><i class=""></i>&ensp;Rooms &amp; Room Types</a></li>
                                <li><a href="<?= Uri::create('accommodation/rates'); ?>"><i class=""></i>&ensp;Rates &amp; Rate Types</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>   <!-- /#side-menu -->
                </div>  <!-- /.sidebar-collapse -->
            </div>  <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
<?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <strong>Success</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                <?= implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                </p>
            </div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <strong>Error(s)</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                <?= implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                </p>
            </div>
<?php endif; ?>
<?php if (Session::get_flash('warning')): ?>
            <div class="alert alert-warning alert-dismissable">
                <strong>Warning</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                <?= implode('</p><p>', e((array) Session::get_flash('warning'))); ?>
                </p>
            </div>
<?php endif; ?>
<?php if (Session::get_flash('info')): ?>
            <div class="alert alert-info alert-dismissable">
                <strong>Info</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                <?= implode('</p><p>', e((array) Session::get_flash('info'))); ?>
                </p>
            </div>
<?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
		    <!-- Dashboard and Reports container -->
		    <?php if (Uri::segment(1) == 'dashboard' ||
                  Uri::segment(1) == '' ||
                  Uri::segment(1) == 'reports' ||
                  Uri::segment(1) == 'settings'): ?>
                    <!-- List Grids and Forms container -->
                    <div class="panel-body">
                        <?= $content; ?>
                    </div>
		    <?php else: ?>
                    <!--<h1 class="page-header"><?= $title; ?></h1>-->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?= $content; ?>
                        </div>
                    </div>  <!-- /.panel -->
		    <?php endif; ?>
		        </div>  <!-- /.col-lg-12  -->
	        </div>  <!-- /.row -->

            <footer class="text-center small">
                <br><br>
                <a href="http://fdesk.logicent.co" target="_blank">E1 FrontDesk</a> &copy; 2014-<?= date('Y'); ?> All Rights Reserved.
            </footer>
        </div>  <!-- /#page-wrapper -->
    </div>  <!-- /#wrapper -->

</body>
</html>
