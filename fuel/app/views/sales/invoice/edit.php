<h2 class="page-header">Editing <span class='text-muted'>Invoice</span>&nbsp;
<span><?= Html::anchor('accounts/sales-invoice', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>
	<?php //echo Html::anchor('sales/invoice/view/'.$sales_invoice->id, 'View'); ?>

<?= render('sales/invoice/_form'); ?>
