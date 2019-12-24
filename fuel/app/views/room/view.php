<h2>Viewing <span class='muted'>#<?= $room->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?= $room->name; ?></p>
<p>
	<strong>Room type:</strong>
	<?= $room->room_type; ?></p>
<p>
	<strong>Alias:</strong>
	<?= $room->alias; ?></p>

<?= Html::anchor('room/edit/'.$room->id, 'Edit'); ?> |
<?= Html::anchor('room', 'Back'); ?>