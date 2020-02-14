<h2>Viewing <span class='muted'>#<?php echo $property->id; ?></span></h2>

<p>
	<strong>Code:</strong>
	<?php echo $property->code; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $property->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $property->description; ?></p>
<p>
	<strong>Location:</strong>
	<?php echo $property->location; ?></p>
<p>
	<strong>Property type:</strong>
	<?php echo $property->property_type; ?></p>
<p>
	<strong>Landlord id:</strong>
	<?php echo $property->landlord_id; ?></p>
<p>
	<strong>Property ref:</strong>
	<?php echo $property->property_ref; ?></p>
<p>
	<strong>Date signed:</strong>
	<?php echo $property->date_signed; ?></p>
<p>
	<strong>Date released:</strong>
	<?php echo $property->date_released; ?></p>
<p>
	<strong>Inactive:</strong>
	<?php echo $property->inactive; ?></p>
<p>
	<strong>On hold:</strong>
	<?php echo $property->on_hold; ?></p>
<p>
	<strong>On hold from:</strong>
	<?php echo $property->on_hold_from; ?></p>
<p>
	<strong>On hold to:</strong>
	<?php echo $property->on_hold_to; ?></p>
<p>
	<strong>Remarks:</strong>
	<?php echo $property->remarks; ?></p>

<?php echo Html::anchor('property/edit/'.$property->id, 'Edit'); ?> |
<?php echo Html::anchor('property', 'Back'); ?>