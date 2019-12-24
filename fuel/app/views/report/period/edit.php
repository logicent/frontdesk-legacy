<h2>Editing <span class='muted'>Report_period</span></h2>
<br>

<?= render('report/period/_form'); ?>
<p>
	<?= Html::anchor('report/period/view/'.$report_period->id, 'View'); ?> |
	<?= Html::anchor('report/period', 'Back'); ?></p>
