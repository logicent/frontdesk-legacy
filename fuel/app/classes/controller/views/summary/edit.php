<h2>Editing <span class='muted'>Summary</span></h2>
<br>

<?= render('summary/_form'); ?>
<p>
	<?= Html::anchor('summary/view/'.$summary->id, 'View'); ?> |
	<?= Html::anchor('summary', 'Back'); ?></p>
