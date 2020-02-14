<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Partners</span></h2>
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
            <td><?= $item->partner_type ?></td>
            <td><?= $item->partner_group ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>	
    </tbody>
</table>

<?php else: ?>
<p>No Partners.</p>

<?php endif; ?>
