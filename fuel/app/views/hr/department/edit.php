<h2 class="page-header">Editing <span class='text-muted'>Department</span>&nbsp;
    <span><?= Html::anchor('hr/department', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= render('hr/' . basename(__DIR__) . '/_form'); ?>

