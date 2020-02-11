<h2>Listing <span class='muted'>Partners</span></h2>
<br>
<?php if ($partners): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Inactive</th>
			<th>Credit limit</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($partners as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->type; ?></td>
			<td><?php echo $item->inactive; ?></td>
			<td><?php echo $item->credit_limit; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('partner/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('partner/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('partner/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Partners.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('partner/create', 'Add new Partner', array('class' => 'btn btn-success')); ?>

</p>
