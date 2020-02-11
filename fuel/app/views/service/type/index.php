<h2>Listing <span class='muted'>Service_types</span></h2>
<br>
<?php if ($service_types): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Code</th>
			<th>Enabled</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($service_types as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->code; ?></td>
			<td><?php echo $item->enabled; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('service/type/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('service/type/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('service/type/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Service_types.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('service/type/create', 'Add new Service type', array('class' => 'btn btn-success')); ?>

</p>
