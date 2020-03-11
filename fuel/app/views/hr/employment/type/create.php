<h2 class="page-header">New <span class='text-muted'>Employment type</span>&nbsp;
    <span><?= Html::anchor('hr/employment/type', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= render('hr/employment/' . basename(__DIR__) . '/_form'); ?>

