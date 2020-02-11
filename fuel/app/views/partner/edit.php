<h2>Editing <span class='muted'>Partner</span></h2>
<br>

<?php echo render('partner/_form'); ?>
<p>
	<?php echo Html::anchor('partner/view/'.$partner->id, 'View'); ?> |
	<?php echo Html::anchor('partner', 'Back'); ?></p>
