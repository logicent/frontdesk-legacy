<h2>Editing <span class='muted'>Customer</span></h2>
<br>

<?php echo render('customer/_form'); ?>
<p>
	<?php echo Html::anchor('customer/view/'.$customer->id, 'View'); ?> |
	<?php echo Html::anchor('customer', 'Back'); ?></p>
