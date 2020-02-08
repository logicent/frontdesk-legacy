<h2>Listing <span class='muted'>Report_period</span></h2>
<br>
<?php if ($report_period): ?>
<table class="table">
	<thead>
		<tr>
			<th>From date</th>
			<th>To date</th>
			<th>Acctg method</th>
			<th>Description</th>
			<th>Report type</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($report_period as $item): ?>		<tr>

			<td><?= $item->from_date; ?></td>
			<td><?= $item->to_date; ?></td>
			<td><?= $item->acctg_method; ?></td>
			<td><?= $item->description; ?></td>
			<td><?= $item->report_type; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?= Html::anchor('report/period/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?= Html::anchor('report/period/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?= Html::anchor('report/period/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Report_period.</p>

<?php endif; ?><p>
	<?= Html::anchor('report/period/create', 'Add new Report period', array('class' => 'btn btn-success')); ?>

</p>
