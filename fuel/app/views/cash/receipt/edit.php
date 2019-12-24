<h2 class="page-header">Editing <span class='text-muted'>Cash Receipt</span>&nbsp;
<span><?= Html::anchor('cash-control/receipts', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs btn-info')); ?></span>
</h2>
<br>

<?= render('cash/receipt/_form'); ?>
<!--
<?= Html::anchor('cash/receipt/view/'.$cash_receipt->id, 'View'); ?>
-->
