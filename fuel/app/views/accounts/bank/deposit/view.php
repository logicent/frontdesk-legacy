<h2>Viewing <span class='muted'>#<?= $bank_receipt->id; ?></span></h2>

<p>
	<strong>Reference:</strong>
	<?= $bank_receipt->reference; ?></p>
<p>
	<strong>Date:</strong>
	<?= $bank_receipt->date; ?></p>
<p>
	<strong>Payer:</strong>
	<?= $bank_receipt->payer; ?></p>
<p>
	<strong>Gl account id:</strong>
	<?= $bank_receipt->gl_account_id; ?></p>
<p>
	<strong>Amount:</strong>
	<?= $bank_receipt->amount; ?></p>
<p>
	<strong>Tax id:</strong>
	<?= $bank_receipt->tax_id; ?></p>
<p>
	<strong>Bank account id:</strong>
	<?= $bank_receipt->bank_account_id; ?></p>
<p>
	<strong>Description:</strong>
	<?= $bank_receipt->description; ?></p>

<?= Html::anchor('bank/receipt/edit/'.$bank_receipt->id, 'Edit'); ?> |
<?= Html::anchor('bank/receipt', 'Back'); ?>