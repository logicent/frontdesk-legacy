<h2>Editing <span class='muted'>Paymentmethod</span></h2>
<br>

<?php echo render('accounts/paymentmethod/_form'); ?>
<p>
	<?php echo Html::anchor('accounts/paymentmethod/view/'.$paymentmethod->id, 'View'); ?> |
	<?php echo Html::anchor('accounts/paymentmethod', 'Back'); ?></p>
