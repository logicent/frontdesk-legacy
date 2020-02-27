<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontDesk &ndash; <?= $title; ?></title>
    <!-- Core CSS -->
    <?= Asset::css(
                array(
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
                    // 'vendor/yeti.bootstrap.min.css',
                    'vendor/united.bootstrap.min.css',
                    // '../font-awesome/css/font-awesome.css',
                    '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
                    'print.css'
                )); ?>
</head>
<body>
    <div id="wrapper">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="report report-default">
                        <?= $content; ?>
                    </div>
		        </div>  <!-- /.col-lg-12  -->
	        </div>  <!-- /.row -->
        </div>  <!-- /#page-wrapper -->
    </div>  <!-- /#wrapper -->

</body>
</html>
