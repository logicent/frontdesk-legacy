<h2>Viewing <span class='muted'>#<?= $report->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?= $report->name; ?></p>
<p>
	<strong>Published:</strong>
	<?= $report->published; ?></p>

<?= Html::anchor('report/edit/'.$report->id, 'Edit'); ?> |
<?= Html::anchor('report', 'Back'); ?>