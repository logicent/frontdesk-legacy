<h2>Listing <span class='muted'>Facilities</span></h2>
<br>
<?php if ($facilities): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facilities as $item): ?>		<tr>

			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('facility/facility/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('facility/facility/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('facility/facility/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Facilities.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('facility/facility/create', 'Add new Facility', array('class' => 'btn btn-success')); ?>

</p>
