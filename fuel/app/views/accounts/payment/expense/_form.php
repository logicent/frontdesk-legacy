<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($expense) ? $expense->reference : Model_Accounts_Payment_Expense::getNextSerialNumber()), array('class' => 'col-md-6 form-control', 'readonly' => true)); ?>
			</div>
		</div>
		<div class="col-md-3">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
			<!-- <div class="input-group"> -->
				<?= Form::input('date', Input::post('date', isset($expense) ? $expense->date : date('Y-m-d')), array('class' => 'col-md-6 form-control datepicker')); ?>
				<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
			<!-- </div> -->
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Payee', 'payee', array('class'=>'control-label')); ?>
			<?= Form::input('payee', Input::post('payee', isset($expense) ? $expense->payee : ''), 
							array('class' => 'col-md-6 form-control', 'autofocus' => true)); ?>
		</div>
	</div>

	<!-- <div class="form-group">
		<?= Form::label('GL account', 'gl_account_id', array('class'=>'control-label')); ?>
		<?= Form::input('gl_account_id', Input::post('gl_account_id', isset($expense) ? $expense->gl_account_id : ''), array('class' => 'col-md-6 form-control')); ?>
	</div> -->

	<!-- <div class="form-group">
		<?= Form::label('Tax id', 'tax_id', array('class'=>'control-label')); ?>
		<?= Form::input('tax_id', Input::post('tax_id', isset($expense) ? $expense->tax_id : 0), array('class' => 'col-md-6 form-control')); ?>
	</div> -->

	<!-- <div class="form-group">
		<?= Form::label('Bank account', 'bank_account_id', array('class'=>'control-label')); ?>
		<?= Form::input('bank_account_id', Input::post('bank_account_id', isset($expense) ? $expense->bank_account_id : ''), array('class' => 'col-md-6 form-control')); ?>
	</div> -->

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
            <?= Form::textarea('description', Input::post('description', isset($expense) ? $expense->description : ''), 
                                array('class' => 'col-md-6 form-control', 'rows' => 2)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
            <?= Form::input('amount', Input::post('amount', isset($expense) ? $expense->amount : 0), 
                            array('class' => 'col-md-6 form-control text-right')); ?>
		</div>
	</div>

    <!--<div class="form-group">-->
        <!--<div class="col-md-6">-->
            <?php // Form::label('Payment type', 'payment_type', array('class'=>'control-label')); ?>
            <?php // Form::select('payment_type', Input::post('payment_type', isset($fd_booking) ? $fd_booking->payment_type : ''), Model_Accounts_Payment_Receipt::$payment_type, array('class' => 'col-md-6 form-control')); ?>
        <!--</div>-->

        <!--<div class="col-md-offset-3 col-md-6">-->
            <?php // Form::label('Verify Code', 'verify_code', array('class'=>'control-label')); ?>
            <?php // Form::input('verify_code', Input::post('verify_code', isset($fd_booking) ? $fd_booking->verify_code : ''), array('class' => 'col-md-6 form-control')); ?>
        <!--</div>-->
    <!--</div>-->

    <!--<div class="form-group">-->
        <!--<div class="col-md-6">-->
            <?php // Form::label('Card type', 'card_type', array('class'=>'control-label')); ?>
            <?php // Form::select('card_type', Input::post('card_type', isset($fd_booking) ? $fd_booking->card_type : ''), Model_Accounts_Payment_Receipt::$card_type, array('class' => 'col-md-6 form-control')); ?>
        <!--</div>-->
    <!--</div>-->

    <!--<div class="form-group">-->
        <!--<div class="col-md-6">-->
            <?php // Form::label('Card expire', 'card_expire', array('class'=>'control-label')); ?>
            <?php // Form::input('card_expire', Input::post('card_expire', isset($fd_booking) ? $fd_booking->card_expire : ''), array('class' => 'col-md-6 form-control')); ?>
        <!--</div>-->
        <!--<div class="col-md-offset-3 col-md-6">-->
            <?php // Form::label('Card no.', 'card_no', array('class'=>'control-label')); ?>
            <?php // Form::input('card_no', Input::post('card_no', isset($fd_booking) ? $fd_booking->card_no : ''), array('class' => 'col-md-6 form-control')); ?>
        <!--</div>-->
    <!--</div>-->
    
	<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($expense) ? $expense->fdesk_user : $uid)); ?>
    
    <hr>

	<div class="form-group">
		<div class="col-md-3">
    		<?= Form::submit('submit', isset($expense) ? 'Update' : 'Add expense', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="col-md-3">
			<?php if (isset($expense)): ?>
				<div class="pull-right btn-toolbar">
					<div class="btn-group">
						<a href="<?= Uri::create('accounts/payment/expense/delete/'.$expense->id); ?>" class="btn btn-danger" >Cancel expense</a>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>

<?= Form::close(); ?>
