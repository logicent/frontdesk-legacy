<h2>Listing <span class='muted'>Roles</span></h2>
<br>
<?php if ($roles): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($roles as $item): ?>		<tr>

			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('role/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('role/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('role/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Roles.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('role/create', 'Add new Role', array('class' => 'btn btn-success')); ?>

</p>
