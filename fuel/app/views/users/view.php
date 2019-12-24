<h2><?= $user->username; ?> <span class='muted'>#<?= $user->id; ?></span></h2>

<p>
	<strong>Group:</strong>
	<?= $user->group->name; ?></p>
<p>
	<strong>Email:</strong>
	<?= $user->email; ?></p>
<p>
	<strong>Last login:</strong>
	<?= date('M d Y', $user->last_login); ?></p>
<p>
	<strong>Previous login:</strong>
	<?= date('M d Y', $user->previous_login); ?></p>
<p>
	<strong>User id:</strong>
	<?= $user->user_id; ?></p>
	
<?= Html::anchor('users', 'Back'); ?>
