<h2>Viewing <span class='muted'>#<?= $summary->id; ?></span></h2>

<p>
	<strong>Reference:</strong>
	<?= $summary->reference; ?></p>
<p>
	<strong>Date:</strong>
	<?= $summary->date; ?></p>
<p>
	<strong>Units sold:</strong>
	<?= $summary->units_sold; ?></p>
<p>
	<strong>Units blocked:</strong>
	<?= $summary->units_blocked; ?></p>
<p>
	<strong>Complimentary units:</strong>
	<?= $summary->complimentary_units; ?></p>
<p>
	<strong>No of guests:</strong>
	<?= $summary->no_of_guests; ?></p>
<p>
	<strong>Opening bal:</strong>
	<?= $summary->opening_bal; ?></p>
<p>
	<strong>Rent total:</strong>
	<?= $summary->rent_total; ?></p>
<p>
	<strong>Discount total:</strong>
	<?= $summary->discount_total; ?></p>
<p>
	<strong>Settlement total:</strong>
	<?= $summary->settlement_total; ?></p>
<p>
	<strong>Expense total:</strong>
	<?= $summary->expense_total; ?></p>
<p>
	<strong>Deposits total:</strong>
	<?= $summary->deposits_total; ?></p>
<p>
	<strong>Closing bal:</strong>
	<?= $summary->closing_bal; ?></p>
<p>
	<strong>Fdesk user:</strong>
	<?= $summary->fdesk_user; ?></p>

<?= Html::anchor('summary/edit/'.$summary->id, 'Edit'); ?> |
<?= Html::anchor('summary', 'Back'); ?>