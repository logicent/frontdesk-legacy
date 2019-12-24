<h2>Viewing <span class='muted'>#<?= $expense_claim->id; ?></span></h2>

<p>
	<strong>Credit account id:</strong>
	<?= $expense_claim->credit_account_id; ?></p>
<p>
	<strong>Reference:</strong>
	<?= $expense_claim->reference; ?></p>
<p>
	<strong>Date:</strong>
	<?= $expense_claim->date; ?></p>
<p>
	<strong>Payer:</strong>
	<?= $expense_claim->payer; ?></p>
<p>
	<strong>Payee:</strong>
	<?= $expense_claim->payee; ?></p>
<p>
	<strong>Gl account id:</strong>
	<?= $expense_claim->gl_account_id; ?></p>
<p>
	<strong>Amount:</strong>
	<?= $expense_claim->amount; ?></p>
<p>
	<strong>Tax id:</strong>
	<?= $expense_claim->tax_id; ?></p>
<p>
	<strong>Description:</strong>
	<?= $expense_claim->description; ?></p>

<?= Html::anchor('expense/claim/edit/'.$expense_claim->id, 'Edit'); ?> |
<?= Html::anchor('expense/claim', 'Back'); ?>