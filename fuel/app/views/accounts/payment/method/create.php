<h2 class="page-header">New <span class='text-muted'>Payment Method</span>&nbsp;
<span><?= Html::anchor('accounts/payment-method', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>

<?= render('accounts/payment/method/_form'); ?>

