<h2>Viewing <span class='muted'>#<?php echo $checklist->id; ?></span></h2>


<?php echo Html::anchor('task/checklist/edit/'.$checklist->id, 'Edit'); ?> |
<?php echo Html::anchor('task/checklist', 'Back'); ?>