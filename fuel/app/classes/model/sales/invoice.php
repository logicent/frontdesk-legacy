<?php
use Orm\Model_Soft;

class Model_Sales_Invoice extends Model_Soft
{
	const INVOICE_STATUS_OPEN = 'O';
	const INVOICE_STATUS_CLOSED = 'C';
	const INVOICE_STATUS_CANCELED = 'X';

	public static $invoice_status = array(
		self::INVOICE_STATUS_OPEN => 'Open',
		self::INVOICE_STATUS_CLOSED => 'Closed',
		self::INVOICE_STATUS_CANCELED => 'Canceled'
	);

	const INVOICE_PAID_STATUS_NOT_PAID = 'NP';
	const INVOICE_PAID_STATUS_PART_PAID = 'PP';
	const INVOICE_PAID_STATUS_FULL_PAID = 'FP';
	const INVOICE_PAID_STATUS_PLUS_PAID = 'AP';

	public static $invoice_paid_status = array(
		self::INVOICE_PAID_STATUS_NOT_PAID => 'Not paid',
		self::INVOICE_PAID_STATUS_PART_PAID => 'Partly paid',
		self::INVOICE_PAID_STATUS_FULL_PAID => 'Fully paid',
		self::INVOICE_PAID_STATUS_PLUS_PAID => 'Advance paid'
	);

	protected static $_properties = array(
		'id',
		'invoice_num',
		'po_number',
		'amounts_tax_inc',
		'issue_date',
		'due_date',
		'status',
		'source',
		'source_id',
		'customer_name',
		'unit_name',
		'amount_due',
		'disc_total',
		'tax_total',
		'amount_paid',
		'balance_due',
		'advance_paid',
		'paid_status',
		'billing_address',
		'summary',
		'notes',
		'fdesk_user',
		'created_at',
		'updated_at',
		'deleted_at'
	);

	protected static $_soft_delete = array(
        //'deleted_field' => 'deleted',
        'mysql_timestamp' => true,
    );

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('invoice_num', 'Invoice No.', 'required|valid_string[numeric]');
		$val->add_field('po_number', 'PO Number', 'max_length[10]');
		$val->add_field('amounts_tax_inc', 'Amounts Tax Incl.', 'valid_string[numeric]');
		$val->add_field('issue_date', 'Issue Date', 'required|valid_date');
		$val->add_field('due_date', 'Due Date', 'valid_date');
		$val->add_field('status', 'Status', 'required|valid_string[alpha]');
		// $val->add_field('source', 'Source Doc', 'required');
		// $val->add_field('source_id', 'Source ID', 'required');
		$val->add_field('customer_name', 'Customer Name', 'required|max_length[140]');
		$val->add_field('amount_due', 'Amount Due', 'valid_string[]');
		$val->add_field('amount_paid', 'Amount Paid', 'valid_string[]');
		$val->add_field('balance_due', 'Balance Due', 'required|valid_string[]');
		$val->add_field('advance_paid', 'Advance Paid', 'valid_string[]');
		$val->add_field('disc_total', 'Discount', 'required|valid_string[]');
		$val->add_field('tax_total', 'Tax', 'valid_string[]');
		$val->add_field('billing_address', 'Billing Address', 'max_length[255]');
		$val->add_field('summary', 'Summary', 'max_length[150]');
		$val->add_field('notes', 'Notes', 'max_length[255]');
		$val->add_field('fdesk_user', 'Frontdesk User', 'required|valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'sales_invoice';

	protected static $_belongs_to = array(
		'booking' => array(
			'key_from' => 'source_id',
			'model_to' => 'Model_Facility_Booking',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
		'lease' => array(
			'key_from' => 'source_id',
			'model_to' => 'Model_Lease',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),        
	);

	protected static $_has_many = array(
		'items' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Sales_Invoice_Item',
			'key_to' => 'invoice_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'receipts' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Accounts_Payment_Receipt',
			'key_to' => 'bill_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);

	public static function listOptions()
	{
		$items = DB::select('id','invoice_num')->from(self::$_table_name)->execute()->as_array();

		$list_options = array();
		foreach($items as $item)
			$list_options[$item['id']] = $item['invoice_num'];

		return $list_options;
	}

	public static function updateBillSettlement($booking)
	{
		$bill = $booking->bill;
		$bill->amount_due = $booking->total_payment - $bill->disc_total; // preserve applied discount
		$bill->balance_due = $bill->amount_due - $bill->amount_paid;

		switch ($bill->balance_due)
		{
			case 0:
				if ($bill->guest->status == Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT)
					$bill->status = self::INVOICE_STATUS_CLOSED;
				$bill->paid_status = self::INVOICE_PAID_STATUS_FULL_PAID;
				break;

			case $bill->balance_due < 0:
				$bill->balance_due += abs($bill->balance_due);
				$bill->advance_paid = abs($bill->balance_due);
				$bill->paid_status = self::INVOICE_PAID_STATUS_PLUS_PAID;
				break;

			case $bill->balance_due < $bill->amount_due:
				$bill->paid_status = self::INVOICE_PAID_STATUS_PART_PAID;
				break;

			default: // $bill->balance_due == $bill->amount_due
				$bill->paid_status = self::INVOICE_PAID_STATUS_NOT_PAID;
		}
		// update invoice
		if($bill->save())
			self::updateBillDetail($booking);
	}

	public static function updateBillDetail($booking)
	{
		$bill_item = Model_Sales_Invoice_Item::find('first', array('where' => array('invoice_id' => $booking->bill->id)));
		$bill_item->qty = $booking->duration;
		$bill_item->amount = $booking->duration * $booking->rate_amount;
		$bill_item->save();
	}

	public static function updateBillStatus($booking)
	{
		$invoice = $booking->bill;

		switch ($booking->status)
		{
			case Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT:
				$invoice->status = self::INVOICE_STATUS_CLOSED;
				break;
			default:
		}
		// update invoice
		$invoice->save();
	}

	public static function updateBillDates($booking)
	{
		$invoice = $booking->bill;
		$invoice->issue_date = $booking->checkin;
		$invoice->due_date = $booking->checkout;
		// update invoice
		$invoice->save();
	}

	public static function applyDiscountAmount(&$sales_invoice)
	{
		$sales_invoice->amount_due -= $sales_invoice->disc_total;
		$sales_invoice->balance_due = $sales_invoice->amount_due - $sales_invoice->amount_paid;

		if ($sales_invoice->balance_due == 0)
			$sales_invoice->paid_status = self::INVOICE_PAID_STATUS_FULL_PAID;
	}

	public static function getNextSerialNumber()
	{
		if (self::find('last'))
			return self::find('last')->invoice_num + 1; // reference
		else return 1001; // initial record
	}
}
