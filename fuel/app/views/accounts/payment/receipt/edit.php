<h2 class="page-header">Editing <span class='text-muted'>Payment</span>&nbsp;
<span><?= Html::anchor('accounts/sales-receipt', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>

<?= render('accounts/payment/receipt/_form'); ?>