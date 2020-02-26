<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Booking</span></h2>
	</div>

	<div class="col-md-6">
        <br>
        <?= Html::anchor('facility/booking/create', 'New', array('class' => 'pull-right btn btn-primary')); ?>
		<!-- <div class="btn-group">
			<label class="">Filter:&ensp;
			    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
			      Status
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
					<li><?php // echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 'Stay Over', array('class' => 'btn btn-sm btn-default')); ?></li>
					<li><?php // echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 'Checked In', array('class' => "btn btn-sm btn-default")); ?></li>
					<li><?php // echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 'Due Out', array('class' => 'btn btn-sm btn-default')); ?></li>
					<li><?php // echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 'Checked Out', array('class' => 'btn btn-sm btn-default')); ?></li>
			    </ul>
			</label>
	  	</div> -->
		<div class="pull-right btn-group">
			<!-- <div class="button-group"> -->
				<!-- <button form="fd_booking" formaction="<?= Uri::create('facility/booking/copy'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-copy"></i></button> -->
			<!-- </div> -->
			<!-- <div class="button-group"> -->
                <?= Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 
                                'Checked In', array('id' => 'cin_btn', 'class' => "btn btn-sm btn-default")); ?>
				<!-- <?php // echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 'Stay Over', array('class' => 'btn btn-sm btn-default')); ?> -->
				<!-- <?php //echo Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 'Due Out', array('class' => 'btn btn-sm btn-default')); ?> -->
                <?= Html::anchor('registers/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 
                                'Checked Out', array('id' => 'cout_btn', 'class' => 'btn btn-sm btn-default')); ?>
			<!-- </div> -->
		</div>
	</div>
</div>
<hr>

<?php if ($booking): ?>
<form id="fd_booking" enctype="multipart/form-data" method="post" action="<?= Uri::create('facility/booking/copy'); ?>">
	<table class="table table-hover datatable">
		<thead>
			<tr>
				<!-- <th><input name="_id" type="checkbox" id="list_sel"></th> -->
				<th>Guest name</th>
				<th>Reg no.</th>
				<th>Phone no.</th>
				<th>Unit no.</th>
				<th>Check in</th>
				<th>Check out</th>
				<th>Rate</th>
				<!-- <th>Country</th> -->
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
    <?php 
        foreach ($booking as $item): ?>
			<tr>
				<!-- <td><input class="row-sel" type="checkbox"><input class="row-id" type="hidden" name="id[<?= $item->id; ?>]" id="form_id[<?= $item->id; ?>]"></td> -->
                <td><?= Html::anchor('facility/booking/edit/'. $item->id, ucwords($item->first_name .' '. $item->last_name), ['class' => 'clickable']) ?></td>
				<td><?= $item->reg_no; ?></td>
				<td><?= $item->phone; ?></td>
				<td><?= $item->unit->name; ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkin)); ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkout)); ?></td>
				<td class="text-right"><?= number_format(Model_Rate::find('first', ['where' => ['type_id' => $item->unit->type->id]])->charges, 2); ?></td>
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
    
    if (urlParam[1] == 'CI') 
    {
        $('#cin_btn').removeClass('btn-default');
        $('#cout_btn').addClass('btn-default');
    }
    
    if (urlParam[1] == 'CO') 
    {
        $('#cin_btn').addClass('btn-default');
        $('#cout_btn').removeClass('btn-default');
    }
    // Read a page's GET URL variables and return them as an associative array.
</script>
