<h2>Viewing <span class='muted'>#<?= $report_period->id; ?></span></h2>

<p>
	<strong>From date:</strong>
	<?= $report_period->from_date; ?></p>
<p>
	<strong>To date:</strong>
	<?= $report_period->to_date; ?></p>
<p>
	<strong>Acctg method:</strong>
	<?= $report_period->acctg_method; ?></p>
<p>
	<strong>Description:</strong>
	<?= $report_period->description; ?></p>
<p>
	<strong>Report type:</strong>
	<?= $report_period->report_type; ?></p>

<?= Html::anchor('report/period/edit/'.$report_period->id, 'Edit'); ?> |
<?= Html::anchor('report/period', 'Back'); ?>