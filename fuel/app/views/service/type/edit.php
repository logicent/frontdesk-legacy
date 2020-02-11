<h2>Editing <span class='muted'>Service_type</span></h2>
<br>

<?php echo render('service/type/_form'); ?>
<p>
	<?php echo Html::anchor('service/type/view/'.$service_type->id, 'View'); ?> |
	<?php echo Html::anchor('service/type', 'Back'); ?></p>
