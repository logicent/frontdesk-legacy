<h2>Listing <span class='muted'>Customers</span></h2>
<br>
<?php if ($customers): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($customers as $item): ?>		<tr>

			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('customer/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('customer/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('customer/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Customers.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('customer/create', 'Add new Customer', array('class' => 'btn btn-success')); ?>

</p>
