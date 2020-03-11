<h2>Listing <span class='muted'>Hr_attendances</span></h2>
<br>
<?php if ($hr_attendances): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Employee id</th>
			<th>Work day</th>
			<th>Status</th>
			<th>Fdesk user</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_attendances as $item): ?>		<tr>

			<td><?php echo $item->employee_id; ?></td>
			<td><?php echo $item->work_day; ?></td>
			<td><?php echo $item->status; ?></td>
			<td><?php echo $item->fdesk_user; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('hr/attendance/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('hr/attendance/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('hr/attendance/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Hr_attendances.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('hr/attendance/create', 'Add new Hr attendance', array('class' => 'btn btn-success')); ?>

</p>
