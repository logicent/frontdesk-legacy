<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Users</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?php
			if($ugroup->id == 6 || $ugroup->id ==  5)
				echo Html::anchor('users/create', '<i class="fa fa-plus-square-o fa-lg"></i> User', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($users): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Username</th>
			<th>Group</th>
			<th>Email</th>
			<th>Last login</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>
		<tr>
			<td><?= $item->username; ?></td>
			<td><?= $item->group->name; ?></td>
			<td><?= $item->email; ?></td>
			<td><?= date('d M Y h:i a', $item->last_login); ?></td>
			<td class="text-center">
				<?= Html::anchor('users/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
				<?php if ($uid == $item->id || $ugroup->id == 6) : ?>
					<?= Html::anchor('users/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>'); ?>
				<?php endif; ?>
				<?php if (($ugroup->id != $item->group_id || $ugroup->id == 6) && ($item->group_id != 6)) : ?>
					<?= Html::anchor('users/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>',
									['class' => 'text-danger confirm', 'onclick' => "return confirm('Are you sure?')"]); ?> 
				<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Users.</p>
<?php endif; ?>
