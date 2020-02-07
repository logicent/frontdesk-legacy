<h2>Viewing <span class='muted'>#<?php echo $payment_method->id; ?></span></h2>


<?php echo Html::anchor('accounts/payment/method/edit/'.$payment_method->id, 'Edit'); ?> |
<?php echo Html::anchor('accounts/payment-methods', 'Back'); ?>