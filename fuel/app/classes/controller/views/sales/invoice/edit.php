<h2 class="page-header">Editing <span class='text-muted'>Guest Folio</span>&nbsp;
<span><?= Html::anchor('sales/invoice', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs btn-info')); ?></span>
</h2>
<br>
	<?php //echo Html::anchor('sales/invoice/view/'.$sales_invoice->id, 'View'); ?>

<?= render('sales/invoice/_form'); ?>
