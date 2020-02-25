<h2>Editing <span class='text-muted'>User</span></span>&nbsp;
<span><?= Html::anchor('users', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span></h2>

<hr>

<?= render(basename(__DIR__) . '/_form'); ?>
