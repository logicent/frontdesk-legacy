<!-- <h4>Items <span class='text-muted'>billed</span></h4> -->

<?php if ($sales_invoice_items): ?>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Item</th>
			<!--<th>Gl account</th>-->
			<th>Description</th>
			<th>Qty</th>
			<th>Price</th>
			<!--<th>Discount %</th>-->
			<th>Amount</th>
			<!-- <th>&nbsp;</th> -->
		</tr>
	</thead>
	<tbody>
<?php foreach ($sales_invoice_items as $item): ?>
		<tr>
			<td><?= $item->item_id; ?></td>
			<!--<td><?php //= $item->gl_account_id; ?></td>-->
			<td><?= $item->description; ?></td>
			<td><?= number_format($item->qty, 2); ?></td>
			<td class="text-right"><?= number_format($item->unit_price, 2); ?></td>
			<!--<td><?php //= $item->discount_percent; ?></td>-->
			<td class="text-right"><?= number_format($item->amount, 2); ?></td>
			<!-- <td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php /* Html::anchor('sales/invoice/item/view/'.$item->id, '<i class="fa fa-eye fa-fw fa-lg"></i>',
												array('class' => 'btn btn-small')); */ ?>
						<?php /* Html::anchor('sales/invoice/item/edit/'.$item->id, '<i class="fa fa-edit fa-fw fa-lg"></i>',
												array('class' => 'btn btn-small')); */ ?>
						<?php /* Html::anchor('sales/invoice/item/delete/'.$item->id, '<i class="fa fa-trash-o fa-fw"></i>',
												array('class' => 'btn btn-small', 'onclick' => "return confirm('Are you sure?')")); */ ?>
					</div>
				</div>
			</td> -->
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>

<table class="well table">
	<thead>
		<tr>
			<th>Item</th>
			<!--<th>Gl account</th>-->
			<th>Description</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Discount %</th>
			<th>Amount</th>
			<th>&nbsp;</th>
		</tr>
	</thead>

	<tbody>
		<?= render('sales/invoice/item/_form'); ?>
	</tbody>

	<tfoot>
		<tr>
			<td colspan="4">
				<button  data-bind='click: addLine'><i class="glyphicon glyphicon-plus"></i> item</button>
			</td>
			<td class='grandTotal'>
						Total amount: <span data-bind='text: formatCurrency(grandTotal())'> </span>
				<?php //echo Form::input('total_amount', '', // compute total here
										//array('class' => 'input-sm form-control', 'readonly' => true)); ?>
			</td>
			<td></td>
		</tr>
	</tfoot>
</table>

<?php endif; ?>

<script>
// 	function formatCurrency(value) {
// 	    return "$" + value.toFixed(2);
// 	}
//
// 	var DocLine = function() {
// 		var self = this;
// 		self.item_id = ko.observable();
// 		self.description = ko.observable();
// 		self.qty = ko.observable(1);
// 		self.unit_price = ko.observable(1);
// 		self.subtotal = ko.computed(function() {
// 			return self.description() ? self.price() * parseInt("0" + self.qty(), 10) : 0;
// 		});
//
// 		// Whenever the item changes, reset the line details
// 		self.item_id.subscribe(function() {
// 			self.description(undefined);
// 		});
// 	};
//
// 	var Doc = function() {
// 		// Stores an array of lines, and from these, can work out the grandTotal
// 		var self = this;
// 		self.lines = ko.observableArray([new DocLine()]); // Put one line in by default
// 		self.grandTotal = ko.computed(function() {
// 			var total = 0;
// 			$.each(self.lines(), function() { total += this.subtotal() })
// 			return total;
// 		});
//
// 		// Operations
// 		self.addLine = function() { self.lines.push(new DocLine()) };
// 		self.removeLine = function(line) { self.lines.remove(line) };
// 		self.save = function() {
// 			var dataToSave = $.map(self.lines(), function(line) {
// 				return line.description() ? {
// 					description: line.description(),
// 					qty: line.qty()
// 				} : undefined
// 			});
// 			alert("Could now send this to server: " + JSON.stringify(dataToSave));
// 		};
// 	};
//
// 	ko.applyBindings(new Doc());
//
</script>
