<h2>Viewing <span class='muted'>#<?php echo $property_setting->id; ?></span></h2>

<p>
	<strong>Property id:</strong>
	<?php echo $property_setting->property_id; ?></p>
<p>
	<strong>Key:</strong>
	<?php echo $property_setting->key; ?></p>
<p>
	<strong>Value:</strong>
	<?php echo $property_setting->value; ?></p>

<?php echo Html::anchor('property/setting/edit/'.$property_setting->id, 'Edit'); ?> |
<?php echo Html::anchor('property/setting', 'Back'); ?>