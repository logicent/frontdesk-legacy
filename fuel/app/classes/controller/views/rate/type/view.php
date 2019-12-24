<h2>Viewing <span class='muted'>#<?= $rate_type->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?= $rate_type->name; ?></p>
<p>
	<strong>Description:</strong>
	<?= $rate_type->description; ?></p>

<?= Html::anchor('rate/edit/'.$rate_type->id, 'Edit'); ?> |
<?= Html::anchor('rate', 'Back'); ?>
