<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

<div class="form-group">
    <?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
    <?= Form::input('reference', Input::post('reference', isset($summary) ? $summary->reference : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
    <?= Form::input('date', Input::post('date', isset($summary) ? $summary->date : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Units sold', 'units_sold', array('class'=>'control-label')); ?>
    <?= Form::input('units_sold', Input::post('units_sold', isset($summary) ? $summary->units_sold : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Units blocked', 'units_blocked', array('class'=>'control-label')); ?>
    <?= Form::input('units_blocked', Input::post('units_blocked', isset($summary) ? $summary->units_blocked : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Complimentary units', 'complimentary_units', array('class'=>'control-label')); ?>
    <?= Form::input('complimentary_units', Input::post('complimentary_units', isset($summary) ? $summary->complimentary_units : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('No of guests', 'no_of_guests', array('class'=>'control-label')); ?>
    <?= Form::input('no_of_guests', Input::post('no_of_guests', isset($summary) ? $summary->no_of_guests : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Opening bal', 'opening_bal', array('class'=>'control-label')); ?>
    <?= Form::input('opening_bal', Input::post('opening_bal', isset($summary) ? $summary->opening_bal : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Rent total', 'rent_total', array('class'=>'control-label')); ?>
    <?= Form::input('rent_total', Input::post('rent_total', isset($summary) ? $summary->rent_total : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Discount total', 'discount_total', array('class'=>'control-label')); ?>
    <?= Form::input('discount_total', Input::post('discount_total', isset($summary) ? $summary->discount_total : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Settlement total', 'settlement_total', array('class'=>'control-label')); ?>
    <?= Form::input('settlement_total', Input::post('settlement_total', isset($summary) ? $summary->settlement_total : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Expense total', 'expense_total', array('class'=>'control-label')); ?>
    <?= Form::input('expense_total', Input::post('expense_total', isset($summary) ? $summary->expense_total : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Deposits total', 'deposits_total', array('class'=>'control-label')); ?>
    <?= Form::input('deposits_total', Input::post('deposits_total', isset($summary) ? $summary->deposits_total : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<div class="form-group">
    <?= Form::label('Closing bal', 'closing_bal', array('class'=>'control-label')); ?>
    <?= Form::input('closing_bal', Input::post('closing_bal', isset($summary) ? $summary->closing_bal : ''), 
                    array('class' => 'col-md-4 form-control')); ?>
</div>

<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($summary) ? $summary->fdesk_user : $uid)); ?>

<hr>

<div class="form-group">
    <div class="col-md-3">
        <?= Form::submit('submit', isset($summary) ? 'Update' : 'Add', array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?= Form::close(); ?>