<h2>Viewing <span class='text-muted'>#<?= $cash_payment->id; ?></span></h2>

<p>
	<strong>Reference:</strong>
	<?= $cash_payment->reference; ?></p>
<p>
	<strong>Date:</strong>
	<?= $cash_payment->date; ?></p>
<p>
	<strong>Payee:</strong>
	<?= $cash_payment->payee; ?></p>
<p>
	<strong>Gl account id:</strong>
	<?= $cash_payment->gl_account_id; ?></p>
<p>
	<strong>Amount:</strong>
	<?= $cash_payment->amount; ?></p>
<p>
	<strong>Tax id:</strong>
	<?= $cash_payment->tax_id; ?></p>
<p>
	<strong>Bank account id:</strong>
	<?= $cash_payment->bank_account_id; ?></p>
<p>
	<strong>Description:</strong>
	<?= $cash_payment->description; ?></p>

<?= Html::anchor('cash/payment/edit/'.$cash_payment->id, 'Edit'); ?>
