<?php 
    $img_ph = "images/camera.gif";
    $img_src ='';
    if (isset($employee)) :
        if ($employee->ID_attachment) :
            $img_src = $employee->ID_attachment;
        else :
            $img_src = "https://avatars.dicebear.com/v2/initials/{$employee->employee_name}.svg";
        endif;
    else :
        $img_src = $img_ph;
    endif ?>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off", "enctype"=>"multipart/form-data")); ?>

<div class="row">
	<div class="col-md-8">
		<div class="form-group">
			<div class="col-md-6">
				<?= Form::label('Full name', 'employee_name', array('class'=>'control-label')); ?>
                <?= Form::input('employee_name', Input::post('employee_name', isset($employee) ? $employee->employee_name : ''), 
                                                            array('class' => 'col-md-4 form-control')); ?>
			</div>
            
            <div class="col-md-3">
                <?= Form::label('Title of Courtesy', 'title_of_courtesy', array('class'=>'control-label')); ?>
                <?= Form::select('title_of_courtesy', Input::post('title_of_courtesy', isset($employee) ? $employee->title_of_courtesy : ''), 
                                Model_Facility_Booking::$toc, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-3">
                <?= Form::label('Sex', 'sex', array('class'=>'control-label')); ?>
                <?= Form::select('sex', Input::post('sex', isset($employee) ? $employee->sex : ''), Model_Facility_Booking::$sex, 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>            
		</div>
<!--
            <div class="col-md-6">
				<?php // Form::label('Employee group', 'employee_group', array('class'=>'control-label')); ?>
                <?php // Form::select('employee_group', Input::post('employee_group', isset($employee) ? $employee->employee_group : ''), 
                        //                                        Model_Employee::listOptionsEmployeeGroup(), 
                        //                                        array('class' => 'col-md-4 form-control')); ?>
			</div>
-->      
		<div class="form-group">
            <div class="col-md-6"> 
				<?= Form::label('Type', 'employee_type', array('class'=>'control-label')); ?>
                <?= Form::select('employee_type', Input::post('employee_type', isset($employee) ? $employee->employee_type : ''), 
                                Model_Employee::listOptionsEmployeeType(), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>            
            <div class="col-md-6">
                <?= Form::label('Date of Birth', 'birth_date', array('class'=>'control-label')); ?>
                <!--<div class="input-group">-->
                    <?= Form::input('birth_date', Input::post('birth_date', isset($employee) ? $employee->birth_date : ''),
                                    array('class' => 'col-md-4 form-control datepicker', 'readonly' => true)); ?>
                    <!--
                    <span class="input-group-addon">
                        <i class="fa fa-calendar text-default"></i>
                    </span>
                </div>-->
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-6">
				<?= Form::label('Email address', 'email_address', array('class'=>'control-label')); ?>
                <?= Form::input('email_address', Input::post('email_address', isset($employee) ? $employee->email_address : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>        

            <div class="col-md-6">
				<?= Form::label('Mobile phone', 'mobile_phone', array('class'=>'control-label')); ?>
                <?= Form::input('mobile_phone', Input::post('mobile_phone', isset($employee) ? $employee->mobile_phone : ''), 
                                                                array('class' => 'col-md-4 form-control')); ?>
			</div>
		</div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID type', 'ID_type', array('class'=>'control-label')); ?>
                <?= Form::select('ID_type', Input::post('ID_type', isset($employee) ? $employee->ID_type : ''), 
                                Model_Facility_Booking::$ID_type, array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('ID no.', 'ID_no', array('class'=>'control-label')); ?>
                <?= Form::input('ID_no', Input::post('ID_no', isset($employee) ? $employee->ID_no : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('ID country', 'ID_country', array('class'=>'control-label')); ?>
                <?= Form::select('ID_country', Input::post('ID_country', isset($employee) ? $employee->ID_country : ''), 
                                Model_Country::listOptions(true), array('class' => 'col-md-4 form-control select-from-list')); ?>
            </div>
            <div class="col-md-6">
				<?= Form::label('Occupation', 'occupation', array('class'=>'control-label')); ?>
                <?= Form::input('occupation', Input::post('occupation', isset($employee) ? $employee->occupation : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
			</div>            
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Manager', 'manager_id', array('class'=>'control-label')); ?>
                <?= Form::select('manager_id', Input::post('manager_id', isset($employee) ? $employee->manager_id : ''), 
                                Model_User::listOptions(), 
                                array('class' => 'col-md-4 form-control', 'id' => 'user_id')); ?>
            </div>
            
            <div class="col-md-6">
				<?= Form::label('Tax ID', 'tax_ID', array('class'=>'control-label')); ?>
                <?= Form::input('tax_ID', Input::post('tax_ID', isset($employee) ? $employee->tax_ID : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($employee) ? $employee->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
                <br>
                <?php // Form::hidden('is_internal_employee', Input::post('is_internal_employee', isset($employee) ? $employee->is_internal_employee : '0')); ?>
                <?php // Form::checkbox('cb_is_internal_employee', null, array('class' => 'cb-checked', 'data-input' => 'is_internal_employee')); ?>
                <?php // Form::label('Is internal employee', 'cb_is_internal_employee', array('class'=>'control-label')); ?>                
            </div>

            <div class="col-md-6">
				<?= Form::label('Bank account', 'bank_account', array('class'=>'control-label')); ?>
                <?= Form::input('bank_account', Input::post('bank_account', isset($employee) ? $employee->bank_account : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

	</div><!--/.col-md-6-->

    <!-- Right Side -->
	<div class="col-md-4">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('ID preview', 'upload_img', array('class'=>'control-label')); ?>
                <div class="well text-center">
                    <?= Form::file('uploaded_file', array('class' => '', 'style' => 'display: none;')); ?>
                    <div class="img-wrapper">
                        <?= Html::img($img_src, 
                                array(
                                    'class'=>'upload-img', 
                                    'style' => 'max-width: 360px; max-height: 270px;'
                                )
                            ); ?>
                    </div>
                </div>
            </div>
        </div>

		<div class="form-group">
            <div class="col-md-12">
                <?= Form::label('ID path', 'ID_attachment', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('ID_attachment', Input::post('ID_attachment', isset($employee) ? $employee->ID_attachment : ''),
                                    array('id' => 'file_path', 'class' => 'col-md-4 form-control', 'readonly' => true)); ?>
                    <span class="input-group-addon btn-add-img">
                        <?= Html::anchor(Uri::create(false), '<i class="fa fa-plus-square-o"></i>', 
                                            array('id' => 'add_img', 'class' => 'text-info')) ?>
                    </span>
                <?php 
                    if (isset($employee)) : ?>
                    <span class="input-group-addon">
                        <?= Html::anchor(Uri::create('employee/remove_img/' . $employee->id), '<i class="fa fa-trash-o text-red"></i>',
                                        array('id' => 'del_img', 'class' => 'text-primary', 'data-ph' => $img_ph)) ?>
                    </span>
                <?php 
                    endif ?>
                </div>
            </div>

            <div class="col-md-12">
				<?php Form::label('Base Salary', 'base_salary', array('class'=>'control-label')); ?>
                <?php Form::input('base_salary', Input::post('base_salary', isset($employee) ? $employee->base_salary : ''), 
                                array('class' => 'col-md-4 form-control text-right')); ?>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-12">
				<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($employee) ? $employee->remarks : ''), 
                                    array('class' => 'col-md-4 form-control', 'rows' => 5)); ?>
            </div>
		</div>
    </div><!--/.col-md-6-->
</div><!--/.row-->

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($employee) ? $employee->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($employee) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		<?php //echo Form::submit('submit', "Save + New", array('class' => 'btn btn-success')); ?>
	</div>

	<div class="col-md-6">
	</div>
</div>

<?= Form::close(); ?>

<script>
    // see checkbox code in custom.js
	// Date range picker for birth_date
</script>
