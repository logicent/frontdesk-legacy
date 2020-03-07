<h2>Viewing <span class='muted'>#<?php echo $employee->id; ?></span></h2>


<?php echo Html::anchor('employee/edit/'.$employee->id, 'Edit'); ?> |
<?php echo Html::anchor('employee', 'Back'); ?>