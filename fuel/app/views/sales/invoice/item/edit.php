<h2>Editing <span class='text-muted'>Sales invoice item</span></h2>
<br>

<?= render('sales/invoice/item/_form'); ?>
<p>
	<?= Html::anchor('sales/invoice/item/view/'.$sales_invoice_item->id, 'View'); ?> |
	<?= Html::anchor('sales/invoice/item', 'Back'); ?></p>
