<h2>Listing <span class='muted'>Gift_vouchers</span></h2>
<br>
<?php if ($gift_vouchers): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Type</th>
			<th>Valid from</th>
			<th>Valid to</th>
			<th>Value</th>
			<th>Is redeemed</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($gift_vouchers as $item): ?>		<tr>

			<td><?php echo $item->code; ?></td>
			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->type; ?></td>
			<td><?php echo $item->valid_from; ?></td>
			<td><?php echo $item->valid_to; ?></td>
			<td><?php echo $item->value; ?></td>
			<td><?php echo $item->is_redeemed; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('gift/voucher/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gift/voucher/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gift/voucher/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Gift_vouchers.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('gift/voucher/create', 'Add new Gift voucher', array('class' => 'btn btn-success')); ?>

</p>
