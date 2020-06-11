<h2 class="page-header">Viewing <span class='text-muted'>Invoice</span>&nbsp;
<span><?= Html::anchor('accounts/sales-invoice', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>
<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>
	<div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Source', 'source', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->source, 'source', array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="col-md-3">
			<?= Form::label('Invoice no.', 'invoice_num', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->invoice_num, 'invoice_num', array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
            <?= Form::label(Model_Sales_Invoice::$invoice_status[$sales_invoice->status], 'status', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Source ref.', 'source_id', array('class'=>'control-label')); ?>
            <?= Form::label(Model_Lease::listOptions()[$sales_invoice->source_id], 'source_id', 
                            array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="col-md-3">
			<?= Form::label('Issue date', 'issue_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->issue_date, 'issue_date', array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="col-md-3">
			<?= Form::label('Due date', 'due_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->due_date, 'due_date', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>
	<div class="form-group">
    <div class="col-md-6">
			<?= Form::label('Tenant', 'customer_name', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->customer_name, 'customer_name', array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="col-md-6">
			<?= Form::label('Billing address', 'billing_address', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->billing_address, 'billing_address', array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <br>
	<ul id="doc_detail" class="nav nav-tabs">
		<li><a id="bills-tab" data-toggle="tab" href="#bills">Services</a></li>
		<li><a id="receipts-tab" data-toggle="tab" href="#receipts">Receipts</a></li>
	</ul>
    <!-- <br> -->
	<div id="doc_tabs" class="tab-content">
		<div id="bills" class="tab-pane fade">
			<?= render('sales/invoice/item/index', array('sales_invoice_items' => $sales_invoice->items)); ?>
		</div>
		<div id="receipts" class="tab-pane fade">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="col-md-2">Receipt no.</th>
						<th class="col-md-2">Date</th>
						<th class="col-md-6">Description</th>
						<th class="col-md-2 text-right">Amount</th>
					</tr>
				</thead>
				<tbody>
        <?php 
            if (!empty($sales_invoice->receipts)) :
                foreach ($sales_invoice->receipts as $item): ?>
                    <tr class="<?= $item->amount > 0 ? : 'strikeout text-muted' ?>">
                        <td><?= Html::anchor('accounts/payment/receipt/edit/'.$item->id, $item->reference); ?></td>
                        <td><?= $item->date; ?></td>
                        <td><?= $item->description; ?></td>
                        <td class="text-right"><?= number_format($item->amount, 2); ?></td>
                    </tr>
        <?php 
                endforeach;
            else : ?>
                    <tr id="no_data"><td class="text-muted text-center" colspan="4">No data</td></tr>
        <?php
            endif ?>
				</tbody>
			</table>
		</div>
	</div>
    <div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Notes', 'notes', array('class'=>'control-label')); ?>
            <?= Form::textarea('notes', Input::post('notes', $sales_invoice->notes), 
                    array('class' => 'col-md-4 form-control', 'readonly' => true, 'style' => 'height: 110px')); ?>
        </div>
        <div class="col-md-3">
            <?= Form::label('Advance Paid', 'advance_paid', array('class'=>'control-label')); ?>
            <?= Form::label(number_format($sales_invoice->advance_paid, 2), '', array('class' => 'col-md-4 form-control text-number')); ?>
            <?php Form::label('Discount Amount', 'disc_total', array('class'=>'control-label')); ?>
            <?php Form::label($sales_invoice->disc_total, '', array('class' => 'col-md-4 form-control text-number')); ?>
        </div>
        <div class="col-md-3">
            <?= Form::label('Amount Due', 'amount_due', array('class'=>'control-label')); ?>
            <?= Form::label(number_format($sales_invoice->amount_due, 2), '', array('class' => 'col-md-4 form-control text-number')); ?>
        </div>
        <div class="col-md-3">
            <?= Form::label('Amount Paid', 'amount_paid', array('class'=>'control-label')); ?>
            <?= Form::label(number_format($sales_invoice->amount_paid, 2), '', array('class' => 'col-md-4 form-control text-number')); ?>
        </div>
        <div class="col-md-3">
            <?= Form::label('Balance Due', 'balance_due', array('class'=>'control-label')); ?>
            <?= Form::label(number_format($sales_invoice->balance_due, 2), '', array('class' => 'col-md-4 form-control text-number text-red')); ?>
        </div>        
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <?= Form::label('Summary', 'summary', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->summary, 'summary', array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="col-md-6">
            <?= Form::label('Paid Status', 'paid_status', array('class'=>'control-label')); ?>
            <?= Form::label(Model_Sales_Invoice::$invoice_paid_status[$sales_invoice->paid_status], 'paid_status', array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
    <?php Form::label($sales_invoice->tax_total, 'tax_total', array('class' => 'col-md-4 form-control')); ?>
    <hr>
	<div class="form-group">
		<div class="col-md-6">
			<!-- <button class="btn btn-success" data-bind='click: save'>Save</button> -->
			<?= Form::submit('submit', 'Edit', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="col-md-6">
			<div class="pull-right btn-group">
            <?php 
                if (isset($sales_invoice)) :
                    if ($sales_invoice->status == 'O') : ?>
                        <a href="<?= Uri::create('accounts/payment/receipt/create/' . $sales_invoice->id); ?>" class="btn btn-default ">Add payment</a>
            <?php 
                    endif;
                endif ?>
			</div>
		</div>
	</div>

<?= Form::close(); ?>

<script>
	$('#doc_detail a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
	})
	$('#doc_detail a:first').tab('show')
</script>