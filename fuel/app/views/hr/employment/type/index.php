<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Employment type</span></h2>
	</div>

	<div class="col-md-6">
        <br>
		<?= Html::anchor('hr/employment/type/create', 'New', array('class' => 'btn btn-primary pull-right')); ?>    
	</div>
</div>
<hr>

<?php if ($hr_employment_types): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Description</th>
			<th>Status</th>
			<th>Code</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($hr_employment_types as $item): ?>		
		<tr>
			<td>
                <?= Html::anchor('hr/designation/edit/'.$item->id, $item->description, ['class' => 'clickable']) ?>
            </td>
            <td><?= (bool) $item->enabled ? 
                    '<i class="fa fa-circle-o fa-fw text-success"></i>Visible' : 
                    '<i class="fa fa-circle-o fa-fw text-danger"></i>Hidden' ?>
			</td>
			<td class="text-muted"><?= $item->code; ?></td>
			<td class="text-center">
				<?= Html::anchor('hr/employment/type/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>	
	</tbody>
</table>

<?php else: ?>

<p>No Employment type found.</p>

<?php endif; ?>