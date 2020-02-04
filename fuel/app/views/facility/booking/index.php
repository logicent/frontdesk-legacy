<div class="row">
	<div class="col-md-6">
		<h2>Listing <span class='text-muted'>Bookings</span></h2>
	</div>

	<div class="col-md-6">
		<br>
		<!-- <div class="btn-group">
			<label class="">Filter:&ensp;
			    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
			      Status
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
					<li><?php // echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 'Stay Over', array('class' => 'btn btn-sm btn-info')); ?></li>
					<li><?php // echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 'Checked In', array('class' => "btn btn-sm btn-info")); ?></li>
					<li><?php // echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 'Due Out', array('class' => 'btn btn-sm btn-info')); ?></li>
					<li><?php // echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 'Checked Out', array('class' => 'btn btn-sm btn-info')); ?></li>
			    </ul>
			</label>
	  	</div> -->
		<div class="pull-right btn-group">
			<!-- <div class="button-group"> -->
				<!-- <button form="fd_booking" formaction="<?= Uri::create('facility/booking/copy'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-copy"></i></button> -->
			<!-- </div> -->
			<!-- <div class="button-group"> -->
                <?= Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_IN, 
                                'Checked In', array('id' => 'cin_btn', 'class' => "btn btn-sm btn-info")); ?>
				<!-- <?php // echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_STAY_OVER, 'Stay Over', array('class' => 'btn btn-sm btn-info')); ?> -->
				<!-- <?php //echo Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_DUE_OUT, 'Due Out', array('class' => 'btn btn-sm btn-info')); ?> -->
                <?= Html::anchor('front-desk/bookings/?status='.Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT, 
                                'Checked Out', array('id' => 'cout_btn', 'class' => 'btn btn-sm btn-info')); ?>
			<!-- </div> -->
		</div>
	</div>
</div>
<hr>

<?php if ($booking): ?>
<form id="fd_booking" enctype="multipart/form-data" method="post" action="<?= Uri::create('facility/booking/copy'); ?>">
	<table class="table table-bordered table-hover table-striped datatable">
		<thead>
			<tr>
				<!-- <th><input name="_id" type="checkbox" id="list_sel"></th> -->
				<th>Reg no.</th>
				<th>Guest name</th>
				<th>Phone no.</th>
				<th>Room no.</th>
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
				<td><?= $item->reg_no; ?></td>
                <td><?= Html::anchor('facility/booking/edit/'. $item->id, ucwords($item->first_name .' '. $item->last_name), ['class' => 'clickable']) ?></td>
				<td><?= $item->phone; ?></td>
				<td><?= $item->room->name; ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkin)); ?></td>
				<td><?= date('d-M-Y H:i', strtotime($item->checkout)); ?></td>
				<td class="text-right"><?= number_format(Model_Rate::find('first', ['where' => ['type_id' => $item->room->rm_type->id]])->charges, 2); ?></td>
				<!-- <td><?php //echo $item->g_country->iso_code_2; ?></td> -->
				<td class="text-center">
                    <?= Html::anchor('facility/booking/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>'); ?>
                    
					<?php if ($ugroup->id == 5 && $item->status != Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT) : ?>
                        <?= Html::anchor('facility/booking/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw fa-lg"></i>', 
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
	<p>No Guests found.</p>
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
        $('#cin_btn').removeClass('btn-info');
        $('#cout_btn').addClass('btn-info');
    }
    
    if (urlParam[1] == 'CO') 
    {
        $('#cin_btn').addClass('btn-info');
        $('#cout_btn').removeClass('btn-info');
    }
    // Read a page's GET URL variables and return them as an associative array.
</script>
