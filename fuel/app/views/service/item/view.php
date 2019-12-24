<h2>Viewing <span class='muted'>#<?= $service_item->id; ?></span></h2>

<p>
	<strong>Item:</strong>
	<?= $service_item->item; ?></p>
<p>
	<strong>Gl account id:</strong>
	<?= $service_item->gl_account_id; ?></p>
<p>
	<strong>Description:</strong>
	<?= $service_item->description; ?></p>
<p>
	<strong>Qty:</strong>
	<?= $service_item->qty; ?></p>
<p>
	<strong>Unit price:</strong>
	<?= $service_item->unit_price; ?></p>
<p>
	<strong>Discount percent:</strong>
	<?= $service_item->discount_percent; ?></p>

<?= Html::anchor('service/item/edit/'.$service_item->id, 'Edit'); ?> |
<?= Html::anchor('service/item', 'Back'); ?>