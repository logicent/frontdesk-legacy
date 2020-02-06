<h2>Editing <span class='muted'>Rate type</span>&nbsp;
<span><?= Html::anchor('rate/type', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs')); ?></span>
</h2>
<hr>

<?= render('rate/type/_form'); ?>
<?php //echo Html::anchor('rate/view/'.$rate->id, 'View'); ?>