<h2>Viewing <span class='muted'>#<?= $bank_account->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?= $bank_account->name; ?></p>
<p>
	<strong>Account number:</strong>
	<?= $bank_account->account_number; ?></p>
<p>
	<strong>Financial institution:</strong>
	<?= $bank_account->financial_institution; ?></p>
<p>
	<strong>Starting bal:</strong>
	<?= $bank_account->starting_bal; ?></p>
<p>
	<strong>Starting date:</strong>
	<?= $bank_account->starting_date; ?></p>
<p>
	<strong>I banking N/A:</strong>
	<?= $bank_account->i_banking_na; ?></p>
<p>
	<strong>Last statement date:</strong>
	<?= $bank_account->last_statement_date; ?></p>

<?= Html::anchor('bank/account/edit/'.$bank_account->id, 'Edit'); ?> |
<?= Html::anchor('bank/account', 'Back'); ?>
