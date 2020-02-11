<h2>Viewing <span class='muted'>#<?php echo $partner->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $partner->name; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $partner->type; ?></p>
<p>
	<strong>Inactive:</strong>
	<?php echo $partner->inactive; ?></p>
<p>
	<strong>Credit limit:</strong>
	<?php echo $partner->credit_limit; ?></p>

<?php echo Html::anchor('partner/edit/'.$partner->id, 'Edit'); ?> |
<?php echo Html::anchor('partner', 'Back'); ?>