<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Users</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?php
			if($ugroup->id == 6 || $ugroup->id ==  5)
				echo Html::anchor('users/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($users): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Group</th>
			<th>Last login</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $user) : ?>
		<tr>
            <td><?php 
				if ($uid == $user->id || $ugroup->id == 6) :
                    echo Html::anchor('users/edit/'. $user->id, $user->username, ['class' => 'clickable']);
                else:
                    echo $user->username;
                endif ?>
            </td>
			<td><?= $user->email; ?></td>
			<td><?= $user->group->name; ?></td>
			<td><?= date('d M Y h:i a', $user->last_login); ?></td>
			<td class="text-center">
            <?php
                if (($ugroup->id == 6 || $ugroup->id == 5) && ($uid != $user->id) && ($user->group_id != 6)) : ?>
					<?= Html::anchor('users/delete/'.$user->id, '<i class="fa fa-trash-o fa-fw"></i>',
									['method' => 'post', 'class' => 'text-muted del-btn confirm', 'onclick' => "return confirm('Are you sure?')"]); ?> 
            <?php 
                endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Users.</p>
<?php endif; ?>
