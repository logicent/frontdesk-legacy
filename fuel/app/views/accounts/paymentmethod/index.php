<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Payment Methods</span></h2>
	</div>
	<div class="col-md-6">
		<br>
		<?= Html::anchor('accounts/payment-methods/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($paymentmethods): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($paymentmethods as $item): ?>	
        <tr>
            <td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('accounts/paymentmethod/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('accounts/paymentmethod/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('accounts/paymentmethod/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
                </div>

            </td>
        </tr>
    <?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Payment methods.</p>

<?php endif; ?><p>
