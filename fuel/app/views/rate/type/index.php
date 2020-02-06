<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Rate Types</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-toolbar">
			<div class="btn-group">
				<?= Html::anchor('rate/type/create', 'New', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
</div>
<hr>

<?php if ($rate_type): ?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rate_type as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('rate/type/edit/'.$item->id, $item->name); ?>
            </td>
			<td><?= $item->description; ?></td>
			<td class="text-center">
				<?= Html::anchor('rate/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Rate types found.</p>
<?php endif; ?>
