<h2 class="page-header">New <span class='text-muted'>Reservation</span>&nbsp;
<span><?= Html::anchor('registers/reservations', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs')); ?></span>
</h2>
<br>

<?= render('facility/reservation/_form'); ?>