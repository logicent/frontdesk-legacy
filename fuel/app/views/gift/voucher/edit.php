<h2>Editing <span class='muted'>Gift_voucher</span></h2>
<br>

<?php echo render('gift/voucher/_form'); ?>
<p>
	<?php echo Html::anchor('gift/voucher/view/'.$gift_voucher->id, 'View'); ?> |
	<?php echo Html::anchor('gift/voucher', 'Back'); ?></p>
