<?= Form::open(array("class"=>"form-horizontal", "enctype"=>"multipart/form-data")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Code', 'code', array('class'=>'control-label')); ?>
                <?= Form::input('code', Input::post('code', isset($amenity) ? $amenity->code : ''),
                                                            array('class' => 'col-md-4 form-control', 'autofocus' => true)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Description', 'name', array('class'=>'control-label')); ?>
                <?= Form::textarea('name', Input::post('name', isset($amenity) ? $amenity->name : ''),
                                                                    array('class' => 'col-md-4 form-control', 'rows' => 4)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::checkbox('enabled', Input::post('enabled', isset($amenity) ? $amenity->enabled : ''), 
                                    array('class' => 'cb-checked')); ?>
                <?= Form::label('Visible', 'enabled', array('class'=>'control-label')); ?>
            </div>
        </div>
<!--
        <div class="form-group">
            <div class="col-md-6">
                <?php // Form::checkbox('is_billable', Input::post('is_billable', isset($amenity) ? $amenity->is_billable : '0'), 
                        //            array('class' => 'cb-checked')); ?>
                <?php // Form::label('Is billable', 'is_billable', array('class'=>'control-label')); ?>            
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6">
                <?php // Form::checkbox('is_metered', Input::post('is_metered', isset($amenity) ? $amenity->is_metered : '0'), 
                        //            array('class' => 'cb-checked')); ?>
                <?php // Form::label('Is metered', 'is_metered', array('class'=>'control-label')); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6">
                <?php // Form::checkbox('is_default', Input::post('is_default', isset($amenity) ? $amenity->is_default : '0'), 
                        //            array('class' => 'cb-checked')); ?>
                <?php // Form::label('Is default', 'is_default', array('class'=>'control-label')); ?>
            </div>
        </div>
-->        
    </div>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($amenity) ? $amenity->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
    <div class="col-md-6">
        <?= Form::submit('submit', isset($amenity) ? 'Update' : 'Create amenity', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?= Form::close(); ?>

<script>
    cbEl = $('.cb-checked');

	$(cbEl.click(
        function() {
            if (cbEl.is(':checked')) // true
                $(cbEl).val(1);
            else $(cbEl).val(0);
        })
    );
        
    if (cbEl.val() == '1') {
        cbEl.prop('checked', true);
	}
</script>