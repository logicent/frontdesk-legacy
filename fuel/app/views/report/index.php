<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Reports</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('report/builder/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($report): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Published</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($report as $item): ?>
		<tr>
			<td>
            <?= Html::anchor('report/builder/edit/'.$item->id, $item->name, ['class' => 'clickable']); ?>
			<td><?= $item->type == 'm' ? 'Monthly' : 'Daily'; ?></td>
			<td><?= $item->published == 1 ? '<span class="label label-success"><b>Yes</b></span>' : '<span class="label label-danger"><b>No</b></span>' //$item->published; ?></td>
			<td class="text-center">
				<?= Html::anchor('report/builder/view/'.$item->id, '<i class="fa fa-eye fa-fw"></i>', ['class' => 'text-muted vw-btn']); ?>
				<?= Html::anchor('report/builder/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', ['class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')"]); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Reports found.</p>

<?php endif; ?>
