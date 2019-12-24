<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Reports</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('report/create', '<i class="fa fa-plus-square-o fa-lg"></i>&ensp;Report', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($report): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Activated</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($report as $item): ?>
		<tr>
			<td><?= $item->name; ?></td>
			<td><?= $item->type == 'm' ? 'Monthly' : 'Daily'; ?></td>
			<td><?= $item->activated == 1 ? '<span class="label label-success"><b>Yes</b></span>' : '<span class="label label-danger"><b>No</b></span>' //$item->activated; ?></td>
			<td class="text-center">
				<?= Html::anchor('report/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
				<?= Html::anchor('report/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>'); ?>
				<?= Html::anchor('report/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>', ['class' => 'text-danger', 'onclick' => "return confirm('Are you sure?')"]); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Reports.</p>

<?php endif; ?>
