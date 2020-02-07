<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E1 FrontDesk</title>

    <!-- Core CSS -->
    <?= Asset::css(
                    array('vendor/bootstrap.min.css',
                        'vendor/yeti.bootstrap.min.css',
                        '../font-awesome/css/font-awesome.css',
                        'sb-admin.css' // SB Admin Scripts
                    )); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
<?php if (Session::get_flash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <strong>Success</strong>
                        <p>
                        <?= implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                        </p>
                    </div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <strong>Error(s)</strong>
                        <p>
                        <?= implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                        </p>
                    </div>
<?php endif; ?>
                <div class="text-center">
            <?php
                if (!empty($business->business_logo)) :
                    echo Html::img($business->business_logo, ['style' => 'max-width: 240px']) ;
                else : ?>
                    <span class="lead"><?= isset($business) ? $business->trading_name : '' ?></span>
            <?php 
                endif ?>
                </div>   
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">E1 FrontDesk</h3>
                    </div>
                    
                    <div class="panel-body">
                        <form role="form" accept-charset="utf-8" action="<?php //echo Uri::create('login'); ?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <!-- <label for="form_email_username">Email or Username</label> -->
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input name="email_username" value="" placeholder="Email or Username" id="form_email_username" class="form-control" type="text" autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="form_password">Password</label> -->
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input name="password" value="" placeholder="Password" id="form_password" class="form-control" type="password">
                                    </div>
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <div class="text-right">
                                    <button id="form_submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Log In</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

                <footer class="text-center small">
                    <br><br>
                    <a href="http://fdesk.logicent.co" target="_blank">E1 FrontDesk</a> &copy; 2014-<?= date('Y'); ?> All Rights Reserved.
                </footer>
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <?= Asset::js(array('vendor/jquery-1.10.2.js',
                        'vendor/bootstrap.min.js',
                        'plugins/metisMenu/jquery.metisMenu.js',
                        'sb-admin.js' // SB Admin Scripts
                )); ?>
</body>
</html>
