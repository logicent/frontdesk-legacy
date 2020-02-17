<h2 class="page-header">Settings <span class='text-muted'>Hire</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?php echo Form::checkbox('require_advance_pmt', Input::post('require_advance_pmt', isset($rental_setting) ? $rental_setting->require_advance_pmt : '0'), 
                                        array('class' => 'cb-checked')); ?>
                <?php echo Form::label('Require advance payment', 'require_advance_pmt', array('class'=>'control-label')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?php echo Form::label('Advance percentage of total', 'rent_due_by', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?php echo Form::input('rent_due_by', Input::post('rent_due_by', isset($rental_setting) ? $rental_setting->rent_due_by : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
                    <span class="input-group-addon">%</span>
                </div>                                        
            </div>            
        </div>

        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($property) ? $property->fdesk_user : $uid)); ?>

        <hr>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>

<?= Form::close(); ?>

<script>
	$('.cb-checked').click(function() {
	    if ($(this).is(':checked')) // true
	        $('#form_require_advance_pmt').val(1);
	    else $('#form_require_advance_pmt').val(0);
    });

    if ($('.cb-checked').val() == '1') {
        $('#form_require_advance_pmt').attr('checked', true);
	}
</script>
