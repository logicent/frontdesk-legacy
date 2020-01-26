<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E1 FrontDesk</title>
        <!-- Core CSS -->
        <?= Asset::css(
                array(
                    'vendor/bootstrap.min.css',
                    'vendor/yeti.bootstrap.min.css',
                    '../font-awesome/css/font-awesome.css',
                    'sb-admin.css' // SB Admin Scripts
                )); ?>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
            <?php 
                if (Session::get_flash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <strong>Success</strong>
                        <p>
                        <?= implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                        </p>
                    </div>
            <?php 
                endif;
                if (Session::get_flash('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <strong>Error(s)</strong>
                        <p>
                        <?= implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                        </p>
                    </div>
            <?php 
                endif ?>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">E1 FrontDesk</h3>
                        </div>
                        <div class="panel-body">
                            <?= $content; ?>
                        </div>
                    </div>

                    <footer class="text-center small">
                        <br><br>
                        <a href="https://logicent.co/solutions/hotel-front-office.html" target="_blank">E1 FrontDesk</a> &copy; 2014-<?= date('Y'); ?> All Rights Reserved.
                    </footer>
                </div>
            </div>
        </div>

        <!-- Core Scripts -->
        <?= Asset::js(
                array('vendor/jquery-1.10.2.js',
                    'vendor/bootstrap.min.js',
                    'plugins/metisMenu/jquery.metisMenu.js',
                    'sb-admin.js' // SB Admin Scripts
            )); ?>
    </body>
</html>