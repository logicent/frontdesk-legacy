<h2>Viewing <span class='muted'>#<?= $sales_invoice->id; ?></span></h2>

<p>
	<strong>Invoice num:</strong>
	<?= $sales_invoice->invoice_num; ?></p>
<p>
	<strong>Po number:</strong>
	<?= $sales_invoice->po_number; ?></p>
<p>
	<strong>Amounts tax inc:</strong>
	<?= $sales_invoice->amounts_tax_inc; ?></p>
<p>
	<strong>Issue date:</strong>
	<?= $sales_invoice->issue_date; ?></p>
<p>
	<strong>Due date:</strong>
	<?= $sales_invoice->due_date; ?></p>
<p>
	<strong>Guest id:</strong>
	<?= $sales_invoice->booking_id; ?></p>
<p>
	<strong>Billing address:</strong>
	<?= $sales_invoice->billing_address; ?></p>
<p>
	<strong>Summary:</strong>
	<?= $sales_invoice->summary; ?></p>
<p>
	<strong>Notes:</strong>
	<?= $sales_invoice->notes; ?></p>

<?= Html::anchor('sales/invoice/edit/'.$sales_invoice->id, 'Edit'); ?> |
<?= Html::anchor('accounts/sales-invoices', 'Back'); ?>
