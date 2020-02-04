<h2>Viewing <span class='muted'>#<?php echo $paymentmethod->id; ?></span></h2>


<?php echo Html::anchor('accounts/paymentmethod/edit/'.$paymentmethod->id, 'Edit'); ?> |
<?php echo Html::anchor('accounts/paymentmethod', 'Back'); ?>