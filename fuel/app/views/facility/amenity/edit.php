<h2>Editing <span class='muted'>Amenity</span></h2>
<br>

<?php echo render('facility/amenity/_form'); ?>
<p>
	<?php echo Html::anchor('facility/amenity/view/'.$amenity->id, 'View'); ?> |
	<?php echo Html::anchor('facility/amenity', 'Back'); ?></p>
