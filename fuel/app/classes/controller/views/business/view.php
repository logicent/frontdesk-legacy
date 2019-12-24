<h2>Viewing <span class='muted'>#<?= $business->id; ?></span></h2>

<?= Html::anchor('business/edit/'.$business->id, 'Edit'); ?> |
<?= Html::anchor('business', 'Back'); ?>

<p>
	<strong>Business name:</strong>
	<?= $business->business_name; ?></p>
<p>
	<strong>Trading name:</strong>
	<?= $business->trading_name; ?></p>
<p>
	<strong>Address:</strong>
	<?= $business->address; ?></p>
<p>
	<strong>Tax identifier:</strong>
	<?= $business->tax_identifier; ?></p>
<p>
	<strong>Tax rate:</strong>
	<?= $business->tax_rate; ?></p>
<p>
	<strong>Currency symbol:</strong>
	<?= $business->currency_symbol; ?></p>
<p>
	<strong>Email address:</strong>
	<?= $business->email_address; ?></p>
<p>
	<strong>Business logo:</strong>
	<?= $business->business_logo; ?></p>
