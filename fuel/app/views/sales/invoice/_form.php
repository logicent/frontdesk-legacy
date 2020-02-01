<?= Form::open(array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Folio no.', 'invoice_num', array('class'=>'control-label')); ?>
			<?= Form::input('invoice_num', Input::post('invoice_num', isset($sales_invoice) ? $sales_invoice->invoice_num : Model_Sales_Invoice::getNextSerialNumber()), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Status', 'status', array('class'=>'control-label')); ?>
			<?= Form::hidden('status', Input::post('status', isset($sales_invoice) ? $sales_invoice->status : '')); ?>
			<?= Form::select('status_list', Input::post('status_list', isset($sales_invoice) ? $sales_invoice->status : ''), Model_Sales_Invoice::$invoice_status, array('class' => 'col-md-4 form-control', 'disabled' => true)); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Guest', 'booking_id', array('class'=>'control-label')); ?>
			<?= Form::hidden('booking_id', Input::post('booking_id', isset($sales_invoice) ? $sales_invoice->booking_id : $booking->id), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
			<?= Form::select('guest_id', Input::post('guest_id', isset($sales_invoice) ? $sales_invoice->booking_id : $booking->id), Model_Fd_Booking::listOptions(true), array('class' => 'col-md-4 form-control', 'disabled' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2">
			<?= Form::label('Issue date', 'issue_date', array('class'=>'control-label')); ?>
			<?= Form::input('issue_date', Input::post('issue_date', isset($sales_invoice) ? $sales_invoice->issue_date : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>

		<div class="col-md-2">
			<?= Form::label('Due date', 'due_date', array('class'=>'control-label')); ?>
			<?= Form::input('due_date', Input::post('due_date', isset($sales_invoice) ? $sales_invoice->due_date : ''), array('class' => 'col-md-4 form-control', 'readonly' => true)); ?>
		</div>

		<div class="col-md-offset-4 col-md-4">
			<?= Form::label('Billing address', 'billing_address', array('class'=>'control-label')); ?>
			<?= Form::textarea('billing_address', Input::post('billing_address', isset($sales_invoice) ? $sales_invoice->billing_address : $booking->address), array('class' => 'col-md-4 form-control')); ?>
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

	<div id="invoice_tabs" class="tab-content">
		<div id="bills" class="tab-pane fade">
			<?= render('sales/invoice/item/index', array('sales_invoice_items' => isset($sales_invoice) ? $sales_invoice->items : array())); ?>
		</div>

		<div id="receipts" class="tab-pane fade">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Receipt No.</th>
						<th>Date</th>
						<th>Description</th>
						<th>Amount</th>
						<!-- <th>&nbsp;</th> -->
					</tr>
				</thead>
				<tbody>
            <?php 
                if (isset($sales_invoice)) :
                    foreach ($sales_invoice->receipts as $item): ?>
                        <tr class="<?= $item->amount > 0 ? : 'strikeout' ?>">
                            <td><?= Html::anchor('cash/receipt/edit/'.$item->id, $item->reference); ?></td>
                            <td><?= $item->date; ?></td>
                            <td><?= $item->description; ?></td>
                            <td class="text-right"><?= number_format($item->amount, 2); ?></td>
                            <!-- <td>
                                <div class="btn-toolbar">
                                    <div class="btn-group">
                                        <?= Html::anchor('cash/receipt/view/'.$item->id, '<i class="fa fa-eye"></i>', array('class' => 'btn btn-small')); ?>
                                        <?= Html::anchor('cash/receipt/edit/'.$item->id, '<i class="fa fa-edit"></i>', array('class' => 'btn btn-small')); ?>
                                        <?= Html::anchor('cash/receipt/delete/'.$item->id, '<i class="fa fa-trash"></i>', array('class' => 'btn btn-small', 'onclick' => "return confirm('Are you sure?')")); ?>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                <?php 
                    endforeach;
                endif ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Notes', 'notes', array('class'=>'control-label')); ?>
			<?= Form::textarea('notes', Input::post('notes', isset($sales_invoice) ? $sales_invoice->notes : ''), array('class' => 'col-md-4 form-control', 'rows' => 3)); ?>
		</div>
		<?= Form::hidden('fdesk_user', Input::post('fdesk_user', isset($sales_invoice) ? $sales_invoice->fdesk_user : $uid)); ?>

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<?= Form::label('Amount Due', 'amount_due', array('class'=>'control-label')); ?>
					<?= Form::input('amount_due', Input::post('amount_due', isset($sales_invoice) ? $sales_invoice->amount_due : 0), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Amount Paid', 'amount_paid', array('class'=>'control-label')); ?>
					<?= Form::input('amount_paid', Input::post('amount_paid', isset($sales_invoice) ? $sales_invoice->amount_paid : 0), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Discount Amount', 'disc_total', array('class'=>'control-label')); ?>
					<?= Form::input('disc_total', Input::post('disc_total', isset($sales_invoice) ? $sales_invoice->disc_total : 0), array('class' => 'col-md-4 form-control text-right')); ?>
				</div>

				<?= Form::hidden('tax_total', Input::post('tax_total', isset($sales_invoice) ? $sales_invoice->tax_total : 0.0)); ?>

				<div class="col-md-6">
					<?= Form::label('Balance Due', 'balance_due', array('class'=>'control-label')); ?>
					<?= Form::input('balance_due', Input::post('balance_due', isset($sales_invoice) ? $sales_invoice->balance_due : 0), array('class' => 'col-md-4 form-control text-right text-red', 'readonly' => true)); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<?= Form::label('Summary', 'summary', array('class'=>'control-label')); ?>
			<?= Form::input('summary', Input::post('summary', isset($sales_invoice) ? $sales_invoice->summary : ''), array('class' => 'col-md-4 form-control')); ?>
		</div>

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<?= Form::label('Paid Status', 'paid_status', array('class'=>'control-label')); ?>
					<?= Form::hidden('paid_status', Input::post('paid_status', isset($sales_invoice) ? $sales_invoice->paid_status : '')); ?>
					<?= Form::select('paid_status_list', Input::post('paid_status_list', isset($sales_invoice) ? $sales_invoice->paid_status : ''), Model_Sales_Invoice::$invoice_paid_status, array('class' => 'col-md-4 form-control', 'disabled' => true)); ?>
				</div>

				<div class="col-md-6">
					<?= Form::label('Advance Paid', 'advance_paid', array('class'=>'control-label')); ?>
					<?= Form::input('advance_paid', Input::post('advance_paid', isset($sales_invoice) ? $sales_invoice->advance_paid : ''), array('class' => 'col-md-4 form-control text-right', 'readonly' => true)); ?>
				</div>
			<!-- <div class="form-group">
				<div class="col-md-3">
				<?php //echo Form::label(' Amounts are VAT incl.', 'amounts_tax_inc'); ?>
				<?php //echo Form::checkbox('amounts_tax_inc', Input::post('amounts_tax_inc', isset($sales_invoice) ? $sales_invoice->amounts_tax_inc : ''), array('class' => 'col-md-1')); ?>
				</div>
			</div> -->
			</div>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<div class="col-md-6">
			<!-- <button class="btn btn-success" data-bind='click: save'>Save</button> -->
			<?= Form::submit('submit', isset($sales_invoice) ? 'Update' : 'Create', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="col-md-6">
			<div class="pull-right btn-group">
            <?php 
                if (isset($sales_invoice) && $sales_invoice->status == 'O') : ?>
				    <a href="<?= Uri::create('cash/receipt/create/'.$sales_invoice->guest->id); ?>" class="btn btn-warning ">Add payment</a>
            <?php 
                endif ?>
			</div>
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

<script>
/* Inline detail form handler */
	function formatCurrency(value) {
	    return "$" + value.toFixed(2);
	}

	var DocLine = function() {
		var self = this;
		self.item_id = ko.observable();
		self.description = ko.observable();
		self.qty = ko.observable(1);
		self.unit_price = ko.observable();
		self.amount = ko.computed(function() {
			return self.item_id() ? self.unit_price() * parseInt("0" + self.qty(), 10) : 0;
		});

		// Whenever the item changes, reset the line details
		self.item_id.subscribe(function() {
			self.description(undefined);
		});
	};

	var Doc = function() {
		// Stores an array of lines, and from these, can work out the grandTotal
		var self = this;
		self.lines = ko.observableArray([new DocLine()]); // Put one line in by default
		self.grandTotal = ko.computed(function() {
			var total = 0;
			$.each(self.lines(), function() { total += this.amount() })
			return total;
		});

		// Operations
		self.addLine = function() { self.lines.push(new DocLine()) };
		self.removeLine = function(line) { self.lines.remove(line) };
		self.save = function() {
			var dataToSave = $.map(self.lines(), function(line) {
				return line.item_id() ? {
					description: line.description(),
					qty: line.qty(),
					unit_price: line.unit_price(),
				} : undefined
			});
			alert("Could now send this to server: " + JSON.stringify(dataToSave));
		};
	};

	ko.applyBindings(new Doc());

</script>
