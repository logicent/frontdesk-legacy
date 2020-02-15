<h2>Listing <span class='muted'>Summaries</span></h2>
<br>
<?php if ($summaries): ?>
<table class="table">
	<thead>
		<tr>
			<th>Reference</th>
			<th>Date</th>
			<th>Units sold</th>
			<th>Units blocked</th>
			<th>Complimentary units</th>
			<th>No of guests</th>
			<th>Opening bal</th>
			<th>Rent total</th>
			<th>Discount total</th>
			<th>Settlement total</th>
			<th>Expense total</th>
			<th>Deposits total</th>
			<th>Closing bal</th>
			<th>Fdesk user</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($summaries as $item): ?>		<tr>

			<td><?= $item->reference; ?></td>
			<td><?= $item->date; ?></td>
			<td><?= $item->units_sold; ?></td>
			<td><?= $item->units_blocked; ?></td>
			<td><?= $item->complimentary_units; ?></td>
			<td><?= $item->no_of_guests; ?></td>
			<td><?= $item->opening_bal; ?></td>
			<td><?= $item->rent_total; ?></td>
			<td><?= $item->discount_total; ?></td>
			<td><?= $item->settlement_total; ?></td>
			<td><?= $item->expense_total; ?></td>
			<td><?= $item->deposits_total; ?></td>
			<td><?= $item->closing_bal; ?></td>
			<td><?= $item->fdesk_user; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?= Html::anchor('summary/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?= Html::anchor('summary/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?= Html::anchor('summary/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Summaries.</p>

<?php endif; ?><p>
	<?= Html::anchor('summary/create', 'Add new Summary', array('class' => 'btn btn-success')); ?>

</p>
