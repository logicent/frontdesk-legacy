<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Partner</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('partner/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($partners): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Full name</th>
			<th>Status</th>
			<th>Type</th>
			<th>Group</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($partners as $item): ?>
        <tr>
            <td><?= Html::anchor('partner/edit/'.$item->id, $item->partner_name, array('class' => 'clickable')) ?></td>
            <td><?= (bool) $item->inactive == 1 ? 
                '<i class="fa fa-circle-o fa-fw text-danger"></i>Disabled' : 
                '<i class="fa fa-circle-o fa-fw text-success"></i>Enabled' ?>
            </td>
            <td><?= Model_Partner::listOptionsPartnerType()[$item->partner_type] ?></td>
            <td><?= $item->partner_group ?></td>
			<td class="text-center">
            <?php if ($ugroup->id == 5) : ?>
				<?= Html::anchor('partner/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('method' => 'post',
									'class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
            <?php endif ?>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Partner found.</p>

<?php endif; ?>
