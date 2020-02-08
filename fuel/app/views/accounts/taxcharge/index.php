<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Taxes &amp; Charges</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/tax/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($taxes): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
            <th>Tax identifier</th>
            <th>Tax rate</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($taxes as $item): ?>		
        <tr>
            <td><?= Html::anchor('accounts/tax/edit/'.$item->id, $item->tax_identifier, ['class' => 'clickable']); ?></td>
            <td><?= $item->tax_rate . '%' ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                        <?= Html::anchor('accounts/tax/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', 
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Taxes &amp; charges.</p>

<?php endif; ?><p>