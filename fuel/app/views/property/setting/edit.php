<h2>Editing <span class='muted'>Property_setting</span></h2>
<br>

<?php echo render('property/setting/_form'); ?>
<p>
	<?php echo Html::anchor('property/setting/view/'.$property_setting->id, 'View'); ?> |
	<?php echo Html::anchor('property/setting', 'Back'); ?></p>
