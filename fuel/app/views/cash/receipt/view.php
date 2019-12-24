<h2 class="page-header"><span class='text-muted'>Cash Receipt</span>&nbsp;
<span><?= Html::anchor('cash-control/receipts', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-xs btn-info')); ?></span>
</h2>
<br>

<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Reference', 'reference', array('class'=>'control-label')); ?>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<?= Form::input('reference', Input::post('reference', isset($cash_receipt) ? $cash_receipt->reference : Model_Cash_Receipt::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			</div>
			<?= Form::hidden('bill_id', Input::post('bill_id', isset($bill) ? $bill->id : $cash_receipt->bill_id)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Date', 'date', array('class'=>'control-label')); ?>
			<?= Form::input('date', Input::post('date', isset($cash_receipt) ? $cash_receipt->date : date('Y-m-d')), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Payer', 'payer', array('class'=>'control-label')); ?>
			<?= Form::input('payer', Input::post('payer', isset($cash_receipt) ? $cash_receipt->payer : $bill->guest->first_name .' '. $bill->guest->last_name), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Amount', 'amount', array('class'=>'control-label')); ?>
			<?= Form::input('amount', Input::post('amount', isset($cash_receipt) ? $cash_receipt->amount : $bill->balance_due), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Vat', 'tax_id', array('class'=>'control-label')); ?>
			<?= Form::input('tax_id', Input::post('tax_id', isset($cash_receipt) ? $cash_receipt->tax_id : ''),
								array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4">
			<?= Form::label('Description', 'description', array('class'=>'control-label')); ?>
			<?= Form::input('description', Input::post('description', isset($cash_receipt) ? $cash_receipt->description : 'Accommodation for Room no.'.$bill->guest->room->name), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>
	</div>

	<hr>

	<div class="form-group">
		<!-- <div class="col-md-2">
			<a class="btn btn-warning" href="<?php //= Uri::create('cash/receipt/edit/'.$cash_receipt->id); ?>" target="_blank"> <i class="fa fa-edit fa-fw fa-lg"></i> Edit</a>
		</div> -->
		<div class="col-md-2">
			<?php if (isset($cash_receipt)) : ?>
				<a class="btn btn-warning" href="<?= Uri::create('front-desk/receipts/to-print/'.$cash_receipt->id); ?>" target="_blank"> <i class="glyphicon glyphicon-print"></i> &ensp;Print</a>
			<?php endif; ?>
		</div>
	</div>

<?= Form::close(); ?>
