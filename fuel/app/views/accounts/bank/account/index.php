<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Bank Account</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/bank/account/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>
	</div>
</div>
<hr>

<?php if ($bank_accounts): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Account number</th>
			<th>Financial institution</th>
			<th>Last statement date</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($bank_accounts as $item): ?>
		<tr>
			<td>
                <?= Html::anchor('accounts/bank/account/edit/'.$item->id, $item->name, ['class' => 'clickable']); ?>
            </td>
			<td><?= $item->account_number; ?></td>
			<td><?= $item->financial_institution; ?></td>
			<td><?= $item->last_statement_date; ?></td>
			<td class="text-center">
				<?= Html::anchor('accounts/bank/account/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Bank account found.</p>
<?php endif; ?>
