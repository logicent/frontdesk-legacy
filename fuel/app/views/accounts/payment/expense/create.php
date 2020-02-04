<h2 class="page-header">New <span class='text-muted'>Expense</span>&nbsp;
<span><?= Html::anchor('accounts/expenses', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs')); ?></span>
</h2>
<br>

<?= render(__DIR__ . '/_form'); ?>
