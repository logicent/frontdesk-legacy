<h2 class="page-header">Viewing <span class='text-muted'>Invoice</span>&nbsp;
<span><?= Html::anchor('accounts/sales-invoice', '<i class="fa fa-level-down fa-fw fa-rotate-180"></i> Back to List', array('class' => 'btn btn-default btn-xs')); ?></span>
</h2>
<br>

<?= Form::open(array("class"=>"form-horizontal", "autocomplete" => "off")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Folio no.', 'invoice_num', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->invoice_num, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::label(Model_Sales_Invoice::$invoice_status[$sales_invoice->status], '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Customer', 'customer_name', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->customer_name, '', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Issue date', 'issue_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->issue_date, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Due date', 'due_date', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->due_date, '', array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Billing address', 'billing_address', array('class'=>'control-label')); ?>
            <?= Form::label($sales_invoice->billing_address, '', array('class' => 'col-md-4 form-control')); ?>
		</div>
	</div>

	<ul id="invoice_detail" class="nav nav-tabs">
		<li>
			<a id="bills-tab" data-toggle="tab" href="#bills">Bills</a>
		</li>
		<li>
			<a id="receipts-tab" data-toggle="tab" href="#receipts">Receipts</a>
		</li>
	</ul>
    <!-- <br> -->
	<div id="invoice_tabs" class="tab-content">
		<div id="bills" class="tab-pane fade">
			<?= render('sales/invoice/item/index', array('sales_invoice_items' => isset($sales_invoice) ? $sales_invoice->items : array())); ?>
		</div>

		<div id="receipts" class="tab-pane fade">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Receipt No.</th>
						<th>Date</th>
						<th>Description</th>
						<th class="text-right">Amount</th>
					</tr>
				</thead>
				<tbody>
            <?php 
            if (isset($sales_invoice)) :
                foreach ($sales_invoice->receipts as $item): ?>
                    <tr class="<?= $item->amount > 0 ? : 'strikeout text-muted' ?>">
                        <td><?= Html::anchor('accounts/payment/receipt/edit/'.$item->id, $item->reference); ?></td>
                        <td><?= $item->date; ?></td>
                        <td><?= $item->description; ?></td>
                        <td class="text-right"><?= number_format($item->amount, 2); ?></td>
                    </tr>
            <?php 
                endforeach;
            endif ?>
				</tbody>
			</table>
		</div>
	</div>

    <?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($sales_invoice) ? $sales_invoice->fdesk_user : $uid)); ?>
    <?= Form::hidden('source', Input::post('source', isset($sales_invoice) ? $sales_invoice->source : '')); ?>
    <?= Form::hidden('source_id', Input::post('source_id', isset($sales_invoice) ? $sales_invoice->source_id : '')); ?>

	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
        		<div class="col-md-12">
                    <?= Form::label('Notes', 'notes', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->notes, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?= Form::label('Summary', 'summary', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->summary, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
		
		<div class="col-md-6">
            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Amount Due', 'amount_due', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->amount_due, '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <div class="col-md-6">
                    <?= Form::label('Amount Paid', 'amount_paid', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->amount_paid, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Discount Amount', 'disc_total', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->disc_total, '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <?= Form::hidden('tax_total', Input::post('tax_total', isset($sales_invoice) ? $sales_invoice->tax_total : 0.0)); ?>

                <div class="col-md-6">
                    <?= Form::label('Balance Due', 'balance_due', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->balance_due, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= Form::label('Paid Status', 'paid_status', array('class'=>'control-label')); ?>
                    <?= Form::label(Model_Sales_Invoice::$invoice_paid_status[$sales_invoice->paid_status], '', array('class' => 'col-md-4 form-control')); ?>
                </div>

                <div class="col-md-6">
                    <?= Form::label('Advance Paid', 'advance_paid', array('class'=>'control-label')); ?>
                    <?= Form::label($sales_invoice->advance_paid, '', array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
    </div>
	
    <hr>

	<div class="form-group">
		<div class="col-md-6">
			<button class="btn btn-primary">Print</button>
		</div>
	</div>

<?= Form::close(); ?>

<script>
	$('#invoice_detail a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

	$('#invoice_detail a:first').tab('show')
</script>
