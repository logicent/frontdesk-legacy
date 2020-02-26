<h2>Viewing <span class='muted'>#<?= $unit->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?= $unit->name; ?></p>
<p>
	<strong>Unit type:</strong>
	<?= $unit->unit_type; ?></p>
<p>
	<strong>Alias:</strong>
	<?= $unit->alias; ?></p>

<?= Html::anchor('unit/edit/'.$unit->id, 'Edit'); ?> |
<?= Html::anchor('unit', 'Back'); ?>