<h2>Listing <span class='muted'>Property_settings</span></h2>
<br>
<?php if ($property_settings): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Property id</th>
			<th>Key</th>
			<th>Value</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($property_settings as $item): ?>		<tr>

			<td><?php echo $item->property_id; ?></td>
			<td><?php echo $item->key; ?></td>
			<td><?php echo $item->value; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('property/setting/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('property/setting/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('property/setting/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Property_settings.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('property/setting/create', 'Add new Property setting', array('class' => 'btn btn-success')); ?>

</p>
