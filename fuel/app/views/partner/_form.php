<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Full name', 'partner_name', array('class'=>'control-label')); ?>
                <?= Form::input('partner_name', Input::post('partner_name', isset($partner) ? $partner->partner_name : ''), 
                                                            array('class' => 'col-md-4 form-control')); ?>
			</div>
            
			<div class="col-md-6">
				<?= Form::label('Account manager', 'account_manager', array('class'=>'control-label')); ?>
                <?= Form::select('account_manager', Input::post('account_manager', isset($partner) ? $partner->account_manager : ''), 
                                                                Model_User::listOptions(), 
                                                                array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
			</div>
		</div>
    
		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Type', 'partner_type', array('class'=>'control-label')); ?>
                <?= Form::select('partner_type', Input::post('partner_type', isset($partner) ? $partner->partner_type : ''), 
                                                                Model_Partner::listOptionsPartnerType(), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>        

            <div class="col-md-6">
				<?= Form::label('Partner group', 'partner_group', array('class'=>'control-label')); ?>
                <?= Form::select('partner_group', Input::post('partner_group', isset($partner) ? $partner->partner_group : ''), 
                                                                Model_Partner::listOptionsPartnerGroup(), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Email address', 'email_address', array('class'=>'control-label')); ?>
                <?= Form::input('email_address', Input::post('email_address', isset($partner) ? $partner->email_address : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>        

            <div class="col-md-6">
				<?= Form::label('Phone', 'phone', array('class'=>'control-label')); ?>
                <?= Form::input('phone', Input::post('phone', isset($partner) ? $partner->phone : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Tax ID', 'tax_ID', array('class'=>'control-label')); ?>
                <?= Form::input('tax_ID', Input::post('tax_ID', isset($partner) ? $partner->tax_ID : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>
        </div>

		<div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($partner) ? $partner->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
			</div>
		</div>

	</div><!--/.col-md-6-->
</div><!--/.row-->

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($partner) ? $partner->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($partner) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>
</div>

<?= Form::close(); ?>

<script>
</script>
