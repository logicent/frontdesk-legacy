<h2>Viewing <span class='muted'>#<?php echo $email_setting->id; ?></span></h2>

<p>
	<strong>From address:</strong>
    <?php echo $email_setting->from_address; ?></p>    
<p>
    <strong>From name:</strong>
    <?php echo $email_setting->from_name; ?></p>
<p>
	<strong>Smtp host:</strong>
	<?php echo $email_setting->smtp_host; ?></p>
<p>
	<strong>Smtp username:</strong>
	<?php echo $email_setting->smtp_username; ?></p>
<p>
	<strong>Smtp password:</strong>
	<?php echo $email_setting->smtp_password; ?></p>
<p>
	<strong>Smtp port:</strong>
	<?php echo $email_setting->smtp_port; ?></p>
<p>
	<strong>Smtp starttls:</strong>
	<?php echo $email_setting->smtp_starttls; ?></p>
<p>
	<strong>Smtp timeout:</strong>
	<?php echo $email_setting->smtp_timeout; ?></p>

<?php echo Html::anchor('email/settings/edit/'.$email_setting->id, 'Edit'); ?> |
<?php echo Html::anchor('email/settings', 'Back'); ?>