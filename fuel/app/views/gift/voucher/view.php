<h2>Viewing <span class='muted'>#<?php echo $gift_voucher->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $gift_voucher->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $gift_voucher->name; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $gift_voucher->type; ?></p>
<p>
	<strong>Valid from:</strong>
	<?php echo $gift_voucher->valid_from; ?></p>
<p>
	<strong>Valid to:</strong>
	<?php echo $gift_voucher->valid_to; ?></p>
<p>
	<strong>Value:</strong>
	<?php echo $gift_voucher->value; ?></p>
<p>
	<strong>Is redeemed:</strong>
	<?php echo $gift_voucher->is_redeemed; ?></p>

<?php echo Html::anchor('gift/voucher/edit/'.$gift_voucher->id, 'Edit'); ?> |
<?php echo Html::anchor('gift/voucher', 'Back'); ?>