<div class="row">
	<div class="col-md-10">
		<h2>Listing <span class='text-muted'>Booking</span>&ensp;
		<span class="btn-group list-filters">
            <?= Html::anchor('registers/booking', 
                            'All', array('class' => "btn btn-sm btn-default", 'data-status' => '')); ?>
            <?= Html::anchor('registers/booking/?status=' . Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 
                            'Checked In', array('class' => "btn btn-sm btn-default", 'data-status' => Model_Facility_Booking::GUEST_STATUS_CHECKED_IN)); ?>
            <?= Html::anchor('registers/booking/?status=' . Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 
                            'Stay Over', array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Facility_Booking::GUEST_STATUS_STAY_OVER)); ?>
            <?= Html::anchor('registers/booking/?status=' . Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 
                            'Due Out', array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Facility_Booking::GUEST_STATUS_DUE_OUT)); ?>
            <?= Html::anchor('registers/booking/?status=' . Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 
                            'Checked Out', array('class' => 'btn btn-sm btn-default', 'data-status' => Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT)); ?>
		</span>
        </h2>
	</div>

	<div class="col-md-2">
        <br>
        <?= Html::anchor('facility/booking/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
	</div>
</div>
<hr>

<?php if ($booking): ?>
<form id="fd_booking" enctype="multipart/form-data" method="post" action="<?= Uri::create('facility/booking/copy'); ?>">
	<table class="table table-hover datatable">
		<thead>
			<tr>
				<!-- <th><input name="_id" type="checkbox" id="list_sel"></th> -->
				<th>Customer name</th>
				<th>Reg no.</th>
				<th>Phone no.</th>
				<th>Unit no.</th>
				<th>Check in</th>
				<th>Check out</th>
				<th class="text-right">Rate</th>
				<!-- <th>Country</th> -->
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
    <?php 
        foreach ($booking as $item): ?>
			<tr>
				<!-- <td><input class="row-sel" type="checkbox"><input class="row-id" type="hidden" name="id[<?= $item->id; ?>]" id="form_id[<?= $item->id; ?>]"></td> -->
                <td><?= Html::anchor('facility/booking/edit/'. $item->id, 
                                    ucwords($item->customer->customer_name), ['class' => 'clickable']) ?></td>
				<td><?= $item->reg_no; ?></td>
				<td><?= $item->phone; ?></td>
				<td><?= !is_null($item->unit) ? $item->unit->name : null; ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkin)); ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkout)); ?></td>
				<td class="text-right">
					<?= !is_null($item->unit) ?
						number_format(Model_Rate::find('first', ['where' => ['type_id' => $item->unit->type->id]])->charges, 2) :
						null; ?>
				</td>
				<!-- <td><?php //echo $item->g_country->iso_code_2; ?></td> -->
				<td class="text-center">
                    <?= Html::anchor('facility/booking/view/'.$item->id, '<i class="fa fa-eye fa-fw"></i>', ['class' => 'text-muted']); ?>
                    
					<?php if ($ugroup->id == 5 && $item->status != Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT) : ?>
                        <?= Html::anchor('facility/booking/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>', 
                                        array('class' => 'text-muted del-btn', 'onclick' => "return confirm('Are you sure?')")); ?>
					<?php endif ?>
				</td>
			</tr>
    <?php 
        endforeach; ?>
		</tbody>
	</table>
</form>

<?php else: ?>
	<p>No Booking found.</p>
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

    $('.filters a').each(function () {
        if (urlParam[1] == $(this).data('status')) 
        {
            $(this).addClass('active');
        }
        else
            $(this).removeClass('active');
    });
    // Read a page's GET URL variables and return them as an associative array.
</script>
