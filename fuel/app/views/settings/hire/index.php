<h2 class="page-header">Settings <span class='text-muted'>Hire</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <?= Form::checkbox('require_advance_pmt', Input::post('require_advance_pmt', isset($hire_setting) ? $hire_setting->require_advance_pmt : '0'), 
                                        array('class' => 'cb-checked')); ?>
                <?= Form::label('Require advance payment', 'require_advance_pmt', array('class'=>'control-label')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Advance as percentage of total', 'advance_as_percentage_of_total', array('class'=>'control-label')); ?>
                <div class="input-group">
                    <?= Form::input('advance_as_percentage_of_total', Input::post('advance_as_percentage_of_total', isset($hire_setting) ? $hire_setting->advance_as_percentage_of_total : ''), 
                                        array('class' => 'col-md-4 form-control')); ?>
                    <span class="input-group-addon">%</span>
                </div>                                        
            </div>            
        </div>

        <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($hire_setting) ? $hire_setting->fdesk_user : $uid)); ?>

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
