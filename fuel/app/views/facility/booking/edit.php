<h2 class="page-header">Editing <span class='text-muted'>Booking</span>&nbsp;
<span><?= Html::anchor('facility/booking', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs')); ?></span>
</h2>
<br>
	<!--<?php //echo Html::anchor('guest/register/view/'.$guest_register->id, 'View'); ?> |-->

<?= render('facility/booking/_form'); ?>
