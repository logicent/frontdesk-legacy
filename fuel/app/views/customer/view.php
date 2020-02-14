<h2>Viewing <span class='muted'>#<?php echo $customer->id; ?></span></h2>


<?php echo Html::anchor('customer/edit/'.$customer->id, 'Edit'); ?> |
<?php echo Html::anchor('customer', 'Back'); ?>