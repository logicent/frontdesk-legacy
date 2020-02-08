<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Payment Methods</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/payment/method/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($payment_methods): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($payment_methods as $item): ?>	
        <tr>
            <td><?= Html::anchor('accounts/payment/method/edit/'.$item->id, $item->name, ['class' => 'clickable']) ?></td>
            <td><?= $item->code ?></td>
            <td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?= Html::anchor('accounts/payment/method/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', 
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Payment methods.</p>

<?php endif; ?><p>
