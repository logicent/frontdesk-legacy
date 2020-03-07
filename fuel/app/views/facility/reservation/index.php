<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Reservation</span>&ensp;
            <span class="btn-group list-filters">
            <?= Html::anchor('registers/reservation', 
                            'All', array('class' => "btn btn-sm btn-default", 'data-status' => '')); ?>            
                <?= Html::anchor('registers/reservation/?status=' . Model_Facility_Reservation::RESERVATION_STATUS_OPEN, 
                                'Open', array('data-status' => Model_Facility_Reservation::RESERVATION_STATUS_OPEN, 'class' => 'btn btn-sm btn-default')); ?>
                <?= Html::anchor('registers/reservation/?status=' . Model_Facility_Reservation::RESERVATION_STATUS_BOOKED, 
                                'Booked', array('data-status' => Model_Facility_Reservation::RESERVATION_STATUS_BOOKED, 'class' => 'btn btn-sm btn-default')); ?>
                <?= Html::anchor('registers/reservation/?status=' . Model_Facility_Reservation::RESERVATION_STATUS_NOSHOW, 
                                'No Show', array('data-status' => Model_Facility_Reservation::RESERVATION_STATUS_NOSHOW, 'class' => 'btn btn-sm btn-default')); ?>
                <?= Html::anchor('registers/reservation/?status=' . Model_Facility_Reservation::RESERVATION_STATUS_VOID, 
                                'Void', array('data-status' => Model_Facility_Reservation::RESERVATION_STATUS_VOID, 'class' => 'btn btn-sm btn-default')); ?>
            <!--
                <label class="">Filter:&ensp;
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                    Status
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?php Html::anchor('registers/booking/?status='.Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 'Stay Over'); ?></li>
                        <li><?php Html::anchor('registers/booking/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 'Checked In'); ?></li>
                        <li><?php Html::anchor('registers/booking/?status='.Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 'Due Out'); ?></li>
                        <li><?php Html::anchor('registers/booking/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 'Checked Out'); ?></li>
                    </ul>
                </label>
            -->
            </span>        
        </h2>
	</div>

	<div class="col-md-6">
        <br>
        <?= Html::anchor('facility/reservation/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($reservation): ?>
<table class="table table-hover datatable">
	<thead>
		<tr>
			<th>Customer name</th>
			<th>Status</th>
			<th>Check-in</th>
			<th>Pax (A/C)</th>
			<th>Country</th>
			<th>Res no.</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($reservation as $item): ?>
		<tr>
            <td><?= Html::anchor('facility/reservation/edit/'. $item->id, 
                                ucwords($item->customer->customer_name), ['class' => 'clickable']) ?></td>
            <td><?php 
                switch ($item->status) :
                    case 'Open':
                        $color = 'success';
                        break;
                    default:
                        $color = 'default';
                endswitch;
                
                echo "<i class='fa fa-circle-o fa-fw text-{$color}'></i>" . ucwords($item->status); ?>
            </td>
			<td><?= date('jS M, Y', strtotime($item->checkin)); ?></td>
			<td><?= $item->pax_adults.'/'.$item->pax_children; ?></td>
			<td><?= $item->g_country->iso_3166_3; ?></td>
			<td class="text-muted"><?= $item->unit->name . '-' . $item->res_no; ?></td>
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
<p>No Reservation found.</p>
<?php endif; ?>

<script>
	$('#list_sel').on('click', function() {
		var checked = $(this).is(':checked');

		$('.row-sel').each(function() {
			$(this).attr('checked', checked);
		});
	});

	$('.row-sel').on('click', function() {
		var cbSelected = $(this).is(':checked');

		$(this).siblings('.row-id').val(cbSelected);
    });
    
    urlParam = window.location.href.slice(window.location.href.indexOf('?') + 1).split('=');

    $('.list-filters a').each(function () {
        if (urlParam[1] == $(this).data('status')) 
        {
            $(this).addClass('active');
        }
        else
            $(this).removeClass('active');
    });
    // Read a page's GET URL variables and return them as an associative array.
</script>