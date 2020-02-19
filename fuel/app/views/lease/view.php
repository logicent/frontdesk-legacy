<h2>Viewing <span class='muted'>#<?php echo $lease->id; ?></span></h2>

<p>
	<strong>Reference:</strong>
	<?php echo $lease->reference; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $lease->title; ?></p>
<p>
	<strong>Customer id:</strong>
	<?php echo $lease->customer_id; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $lease->status; ?></p>
<p>
	<strong>Date leased:</strong>
	<?php echo $lease->date_leased; ?></p>
<p>
	<strong>Premise use:</strong>
	<?php echo $lease->premise_use; ?></p>
<p>
	<strong>Lease period:</strong>
	<?php echo $lease->lease_period; ?></p>
<p>
	<strong>Billed period:</strong>
	<?php echo $lease->billed_period; ?></p>
<p>
	<strong>Billed amount:</strong>
	<?php echo $lease->billed_amount; ?></p>
<p>
	<strong>Require deposit:</strong>
	<?php echo $lease->require_deposit; ?></p>
<p>
	<strong>Deposit amount:</strong>
	<?php echo $lease->deposit_amount; ?></p>
<p>
	<strong>Deposit includes:</strong>
	<?php echo $lease->deposit_includes; ?></p>
<p>
	<strong>Start date:</strong>
	<?php echo $lease->start_date; ?></p>
<p>
	<strong>End date:</strong>
	<?php echo $lease->end_date; ?></p>
<p>
	<strong>Owner id:</strong>
	<?php echo $lease->owner_id; ?></p>
<p>
	<strong>Property id:</strong>
	<?php echo $lease->property_id; ?></p>
<p>
	<strong>Unit id:</strong>
	<?php echo $lease->unit_id; ?></p>
<p>
	<strong>Attachments:</strong>
	<?php echo $lease->attachments; ?></p>
<p>
	<strong>On hold:</strong>
	<?php echo $lease->on_hold; ?></p>
<p>
	<strong>On hold from:</strong>
	<?php echo $lease->on_hold_from; ?></p>
<p>
	<strong>On hold to:</strong>
	<?php echo $lease->on_hold_to; ?></p>
<p>
	<strong>Remarks:</strong>
	<?php echo $lease->remarks; ?></p>

<?php echo Html::anchor('lease/edit/'.$lease->id, 'Edit'); ?> |
<?php echo Html::anchor('lease', 'Back'); ?>