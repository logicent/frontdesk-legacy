<h2>Editing <span class='muted'>Taxescharge</span></h2>
<br>

<?php echo render('accounts/taxescharges/_form'); ?>
<p>
	<?php echo Html::anchor('accounts/taxescharges/view/'.$taxescharge->id, 'View'); ?> |
	<?php echo Html::anchor('accounts/taxescharges', 'Back'); ?></p>
