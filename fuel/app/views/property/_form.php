<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Title', 'name', array('class'=>'control-label')); ?>
                <?= Form::input('name', Input::post('name', isset($property) ? $property->name : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>
            <div class="col-md-6">
			    <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
                <?= Form::input('code', Input::post('code', isset($property) ? $property->code : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
		    </div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
	    		<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
                <?= Form::textarea('description', Input::post('description', isset($property) ? $property->description : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
	    		<?= Form::label('Physical address', 'physical_address', array('class'=>'control-label')); ?>
                <?= Form::textarea('physical_address', Input::post('physical_address', isset($property) ? $property->physical_address : ''), 
                                    array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
    			<?= Form::label('Owner', 'owner', array('class'=>'control-label')); ?>
                <?= Form::select('owner', Input::post('owner', isset($property) ? $property->owner : ''),
                                        Model_Property::listOptionsPropertyOwner(),
                                        array('class' => 'form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::label('Property type', 'property_type', array('class'=>'control-label')); ?>
                <?= Form::select('property_type', Input::post('property_type', isset($property) ? $property->property_type : ''),
                                        Model_Property_Type::listOptionsPropertyType(),
                                        array('class' => 'form-control')); ?>
            </div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
    			<?= Form::label('Map Location', 'map_location', array('class'=>'control-label')); ?>
                <?= Form::input('map_location', Input::post('map_location', isset($property) ? $property->map_location : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
    			<?= Form::label('Property ref', 'property_ref', array('class'=>'control-label')); ?>
                <?= Form::input('property_ref', Input::post('property_ref', isset($property) ? $property->property_ref : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
            </div>         
		</div>

		<div class="form-group">
            <div class="col-md-6">
    			<?= Form::label('Date signed', 'date_signed', array('class'=>'control-label')); ?>
                <?= Form::input('date_signed', Input::post('date_signed', isset($property) ? $property->date_signed : ''), 
                                array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>

            <div class="col-md-6">
    			<?= Form::label('Date released', 'date_released', array('class'=>'control-label')); ?>
                <?= Form::input('date_released', Input::post('date_released', isset($property) ? $property->date_released : ''), 
                                array('class' => 'col-md-4 form-control datepicker')); ?>
            </div>
		</div>
<!--
		<div class="form-group">
            <div class="col-md-6">
                <?php // Form::checkbox('on_hold', Input::post('on_hold', isset($property) ? $property->on_hold : '0'), 
                                        // array('class' => 'cb-checked')); ?>
                <?php // Form::label('On Hold', 'on_hold', array('class'=>'control-label')); ?>
            </div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
    			<?php // Form::label('On hold from', 'on_hold_from', array('class'=>'control-label')); ?>
                <?php // Form::input('on_hold_from', Input::post('on_hold_from', isset($property) ? $property->on_hold_from : ''), 
                                    // array('class' => 'col-md-4 form-control')); ?>
            </div>
		</div>

		<div class="form-group">
            <div class="col-md-6">
    			<?php // Form::label('On hold to', 'on_hold_to', array('class'=>'control-label')); ?>
                <?php // Form::input('on_hold_to', Input::post('on_hold_to', isset($property) ? $property->on_hold_to : ''), 
                                    // array('class' => 'col-md-4 form-control')); ?>
            </div>
		</div>
-->
		<div class="form-group">
            <div class="col-md-6">
    			<?= Form::label('Remarks', 'remarks', array('class'=>'control-label')); ?>
                <?= Form::textarea('remarks', Input::post('remarks', isset($property) ? $property->remarks : ''), 
                                array('class' => 'col-md-4 form-control')); ?>
            </div>

            <div class="col-md-6">
                <?= Form::hidden('inactive', Input::post('inactive', isset($lease) ? $lease->inactive : '0')); ?>
                <?= Form::checkbox('cb_inactive', null, array('class' => 'cb-checked', 'data-input' => 'inactive')); ?>
                <?= Form::label('Inactive', 'cb_inactive', array('class'=>'control-label')); ?>
            </div>
		</div>        
    </div>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property) ? $property->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
	<div class="col-md-6">
		<?= Form::submit('submit', isset($property) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
	</div>
</div>

<?= Form::close(); ?>