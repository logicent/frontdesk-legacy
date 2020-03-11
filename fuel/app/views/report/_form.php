<?= Form::open(array("class"=>"form-horizontal")); ?>

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Name', 'name', array('class'=>'control-label')); ?>
                <?= Form::input('name', Input::post('name', isset($report) ? $report->name : ''), array('class' => 'col-md-4 form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Slug', 'slug', array('class'=>'control-label')); ?>
                <?= Form::input('slug', Input::post('slug', isset($report) ? $report->slug : ''), array('class' => 'col-md-4 form-control slug')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= Form::label('Type', 'type', array('class'=>'control-label')); ?>
                <?= Form::select('type', Input::post('type', isset($report) ? $report->type : ''),
                                        Model_Report_Builder::$report_type,
                                        array('class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('Allowed Users', 'allowed_users', array('class'=>'control-label')); ?>
                <?= Form::select('allowed_users', Input::post('allowed_users', isset($report) ? $report->allowed_users : ''),
                                        Model_User::listOptions(),
                                        array('class' => 'form-control', 'multiple' => true)); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?= Form::hidden('published', Input::post('published', isset($report) ? $report->published : '0')); ?>
                <?= Form::checkbox('cb_published', null, array('class' => 'cb-checked', 'data-input' => 'published')); ?>
                <?= Form::label('Published', 'cb_published', array('class'=>'control-label')); ?>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="form-group">
            <div class="col-md-12">
                <?= Form::label('DB Query', 'db_query', array('class'=>'control-label')); ?>
                <?= Form::textarea('db_query', Input::post('db_query', isset($report) ? $report->db_query : ''), 
                                    array('class' => 'col-md-4 form-control', 'rows' => 16, 'style' => 'max-height: 330px;')); ?>
            </div>
        </div>


    </div>
</div>

    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($report) ? $report->fdesk_user : $uid)); ?>

	<hr>

	<div class="form-group">
		<div class="col-md-3">
            <?= Form::submit('submit', isset($report) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
        </div>
	</div>

<?= Form::close(); ?>
