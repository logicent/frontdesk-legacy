<h2 class="page-header">Editing <span class='text-muted'>Room</span>&nbsp;
<span><?= Html::anchor('room', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>
	<!--<?= Html::anchor('room/view/'.$room->id, 'View'); ?> |-->

<?= render(basename(__DIR__) . '/_form'); ?>
