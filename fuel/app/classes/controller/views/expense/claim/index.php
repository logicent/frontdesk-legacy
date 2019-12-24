<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Expense Claims</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<?= Html::anchor('expense/claim/create', 'New Expense Claim', array('class' => 'pull-right btn btn-info')); ?>
	</div>
</div>
<hr>

<?php if ($expense_claims): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<!--<th>Credit account</th>-->
			<th>Reference</th>
			<th>Date</th>
			<!--<th>Payer</th>-->
			<th>Payee</th>
			<!--<th>GL account</th>-->
			<th>Amount</th>
			<!--<th>Vat</th>-->
			<!--<th>Description</th>-->
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($expense_claims as $item): ?>
		<tr>
			<!--<td><?= $item->credit_account_id; ?></td>-->
			<td><?= $item->reference; ?></td>
			<td><?= $item->date; ?></td>
			<!--<td><?= $item->payer; ?></td>-->
			<td><?= $item->payee; ?></td>
			<!--<td><?= $item->gl_account_id; ?></td>-->
			<td><?= $item->amount; ?></td>
			<!--<td><?= $item->tax_id; ?></td>-->
			<!--<td><?= $item->description; ?></td>-->
			<td class="text-center">
				<?= Html::anchor('expense/claim/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>',
										array('class' => 'btn btn-small')); ?>
				<?= Html::anchor('expense/claim/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>',
										array('class' => 'btn btn-small')); ?>
				<?= Html::anchor('expense/claim/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>',
										array('class' => 'btn btn-small', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Expense claims found.</p>
<?php endif; ?>
