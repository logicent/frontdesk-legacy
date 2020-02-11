<h2>Viewing <span class='muted'>#<?php echo $service_type->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $service_type->name; ?></p>
<p>
	<strong>Code:</strong>
	<?php echo $service_type->code; ?></p>
<p>
	<strong>Enabled:</strong>
	<?php echo $service_type->enabled; ?></p>

<?php echo Html::anchor('service/type/edit/'.$service_type->id, 'Edit'); ?> |
<?php echo Html::anchor('service/type', 'Back'); ?>