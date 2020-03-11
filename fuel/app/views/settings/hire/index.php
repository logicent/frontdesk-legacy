<h2 class="page-header">Settings <span class='text-muted'>Hire</span>&nbsp;
    <span><?= Html::anchor('settings', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>

<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

    <div class="form-group">
        <div class="col-md-6">
            <?= Form::hidden('require_advance_pmt', Input::post('require_advance_pmt', isset($hire_setting) ? $hire_setting->require_advance_pmt : '0')); ?>
            <?= Form::checkbox('cb_require_advance_pmt', null, array('class' => 'cb-checked', 'data-input' => 'require_advance_pmt')); ?>
            <?= Form::label('Require advance payment', 'cb_require_advance_pmt', array('class'=>'control-label')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <?= Form::label('Advance as percentage of total', 'advance_as_percentage_of_total', array('class'=>'control-label')); ?>
            <div class="input-group">
                <?= Form::input('advance_as_percentage_of_total', Input::post('advance_as_percentage_of_total', isset($hire_setting) ? $hire_setting->advance_as_percentage_of_total : ''), 
                                array('class' => 'col-md-4 form-control require-advance-pmt')); ?>
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

<?= Form::close(); ?>

<script>
    $('#form_cb_require_advance_pmt').on('change', function (e)
    {
        checked = $('#form_require_advance_pmt').val();
        
        $('.require-advance-pmt').each(function () {
            $(this).attr('disabled', checked == 1 ? false : true);
        });
    });

    if ($('#form_require_advance_pmt').val() == '1')
    {
        $('.require-advance-pmt').each(function () {
            $(this).attr('disabled', false);
        });
    } else {
        $('.require-advance-pmt').each(function () {
            $(this).attr('disabled', true);
        });
    }
</script>
