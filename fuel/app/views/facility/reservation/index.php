<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Reservations</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<div class="pull-right btn-group">
			<?php // echo Html::anchor('front-desk/reservations/?status='.Model_Facility_Reservation::RESERVATION_STATUS_OPEN, 'Open', array('class' => 'btn btn-sm btn-info')); ?>
			<?php // echo Html::anchor('front-desk/reservations/?status='.Model_Facility_Reservation::RESERVATION_STATUS_BOOKED, 'Booked', array('class' => 'btn btn-sm btn-info')); ?>
			<?php // echo Html::anchor('front-desk/reservations/?status='.Model_Facility_Reservation::RESERVATION_STATUS_NOSHOW, 'No Show', array('class' => 'btn btn-sm btn-info')); ?>
			<?php // echo Html::anchor('front-desk/reservations/?status='.Model_Facility_Reservation::RESERVATION_STATUS_VOID, 'Void', array('class' => 'btn btn-sm btn-info')); ?>
		</div>
	</div>
</div>
<hr>

<?php if ($reservation): ?>
<table class="table table-bordered table-hover table-striped datatable">
	<thead>
		<tr>
			<th>Guest</th>
			<th>Res no.</th>
			<th>Pax (A/C)</th>
			<th>Country</th>
			<th>Checkin</th>
			<th>Status</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($reservation as $item): ?>
		<tr>
            <td><?= Html::anchor('facility/reservation/edit/'. $item->id, 
                                ucwords($item->first_name .' '. $item->last_name), ['class' => 'clickable']) ?></td>
			<td><?= $item->room->name . '-' . $item->res_no; ?></td>
			<td><?= $item->pax_adults.'/'.$item->pax_children; ?></td>
			<td><?= $item->g_country->iso_code_2; ?></td>
			<td><?= date('M d Y', strtotime($item->checkin)); ?></td>
			<td><?= strtoupper($item->status); ?></td>
			<td class="text-center">
				<!-- <?php //= Html::anchor('facility/reservation/view/'.$item->id, '<i class="glyphicon glyphicon-eye"></i>'); ?> -->
				<?= Html::anchor('facility/reservation/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
                                array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Reservations found.</p>
<?php endif; ?>
