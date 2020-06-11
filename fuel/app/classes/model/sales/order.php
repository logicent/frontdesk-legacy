<?php
use Orm\Model_Soft;

class Model_Sales_Order extends Model_Soft
{
	const ORDER_STATUS_OPEN = 'O';
	const ORDER_STATUS_CLOSED = 'C';
	const ORDER_STATUS_CANCELED = 'X';

	public static $order_status = array(
		self::ORDER_STATUS_OPEN => 'Open',
		self::ORDER_STATUS_CLOSED => 'Closed',
		self::ORDER_STATUS_CANCELED => 'Canceled'
	);

	const ORDER_PAID_STATUS_NOT_PAID = 'NP';
	const ORDER_PAID_STATUS_PART_PAID = 'PP';
	const ORDER_PAID_STATUS_FULL_PAID = 'FP';
	const ORDER_PAID_STATUS_PLUS_PAID = 'AP';

	public static $order_paid_status = array(
		self::ORDER_PAID_STATUS_NOT_PAID => 'Not paid',
		self::ORDER_PAID_STATUS_PART_PAID => 'Partly paid',
		self::ORDER_PAID_STATUS_FULL_PAID => 'Fully paid',
		self::ORDER_PAID_STATUS_PLUS_PAID => 'Advance paid'
	);

	// public $customer_id;

	protected static $_properties = array(
		'id',
		'order_num',
		'po_number',
		'amounts_tax_inc',
		'issue_date',
		'due_date',
		'status',
		// 'source',
		// 'source_id',
		'customer_name',
		'unit_name',
		'amount_due',
		'disc_total',
		'tax_total',
		'amount_paid',
		'balance_due',
		'advance_paid',
		'paid_status',
		'shipping_address',
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
		$val->add_field('order_num', 'Order No.', 'required|valid_string[numeric]');
		$val->add_field('po_number', 'PO Number', 'max_length[10]');
		$val->add_field('amounts_tax_inc', 'Amounts Tax Incl.', 'valid_string[numeric]');
		$val->add_field('issue_date', 'Issue Date', 'required|valid_date');
		$val->add_field('due_date', 'Due Date', 'valid_date');
		$val->add_field('status', 'Status', 'required|valid_string[alpha]');
		// $val->add_field('source', 'Source', 'required');
		// $val->add_field('source_id', 'Source Order Ref', 'required');
		$val->add_field('customer_name', 'Customer Name', 'required|max_length[140]');
		$val->add_field('amount_due', 'Amount Due', 'valid_string[]');
		$val->add_field('amount_paid', 'Amount Paid', 'valid_string[]');
		$val->add_field('balance_due', 'Balance Due', 'required|valid_string[]');
		$val->add_field('advance_paid', 'Advance Paid', 'valid_string[]');
		$val->add_field('disc_total', 'Discount', 'required|valid_string[]');
		$val->add_field('tax_total', 'Tax', 'valid_string[]');
		$val->add_field('shipping_address', 'Billing Address', 'max_length[255]');
		$val->add_field('summary', 'Summary', 'max_length[150]');
		$val->add_field('notes', 'Notes', 'max_length[255]');
		$val->add_field('fdesk_user', 'Frontdesk User', 'required|valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'sales_order';

	protected static $_has_one = array(
		'invoice' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Sales_Invoice',
			'key_to' => 'source_id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
	);

	protected static $_has_many = array(
		'items' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Sales_Order_Item',
			'key_to' => 'order_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'receipts' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Accounts_Payment_Receipt',
			'key_to' => 'source_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);

	public static function listOptions()
	{
		$items = DB::select('id','order_num')->from(self::$_table_name)->execute()->as_array();

		$list_options = array();
		foreach($items as $item)
			$list_options[$item['id']] = $item['order_num'];

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
					$bill->status = self::ORDER_STATUS_CLOSED;
				$bill->paid_status = self::ORDER_PAID_STATUS_FULL_PAID;
				break;

			case $bill->balance_due < 0:
				$bill->balance_due += abs($bill->balance_due);
				$bill->advance_paid = abs($bill->balance_due);
				$bill->paid_status = self::ORDER_PAID_STATUS_PLUS_PAID;
				break;

			case $bill->balance_due < $bill->amount_due:
				$bill->paid_status = self::ORDER_PAID_STATUS_PART_PAID;
				break;

			default: // $bill->balance_due == $bill->amount_due
				$bill->paid_status = self::ORDER_PAID_STATUS_NOT_PAID;
		}
		// update order
		if($bill->save())
			self::updateBillDetail($booking);
	}

	public static function updateBillDetail($booking)
	{
		$bill_item = Model_Sales_Order_Item::find('first', array('where' => array('order_id' => $booking->bill->id)));
		$bill_item->qty = $booking->duration;
		$bill_item->amount = $booking->duration * $booking->rate_amount;
		$bill_item->save();
	}

	public static function updateBillStatus($booking)
	{
		$order = $booking->bill;

		switch ($booking->status)
		{
			case Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT:
				$order->status = self::ORDER_STATUS_CLOSED;
				break;
			default:
		}
		// update order
		$order->save();
	}

	public static function updateBillDates($booking)
	{
		$order = $booking->bill;
		$order->issue_date = $booking->checkin;
		$order->due_date = $booking->checkout;
		// update order
		$order->save();
	}

	public static function applyDiscountAmount(&$sales_order)
	{
		$sales_order->amount_due -= $sales_order->disc_total;
		$sales_order->balance_due = $sales_order->amount_due - $sales_order->amount_paid;

		if ($sales_order->balance_due == 0)
			$sales_order->paid_status = self::ORDER_PAID_STATUS_FULL_PAID;
	}

	public static function getNextSerialNumber()
	{
		if (self::find('last'))
			return self::find('last')->order_num + 1; // reference
		else return 1001; // initial record
    }
    
    // public static function getUnitName($order)
    // {
    //     if ($order->source == self::ORDER_SOURCE_BOOKING)
    //         $order->unit_name = $order->booking->unit->name;
        
    //     if ($order->source == self::ORDER_SOURCE_LEASE)
    //         $order->unit_name = $order->lease->unit->name;
        
    //     $order->save(); // update the order

    //     return $order->unit_name;
	// }
	
	// public static function getSourceName($business)
	// {
	// 	$source= array();
	// 	if ($business->service_accommodation || $business->service_hire)
	// 		$source[self::ORDER_SOURCE_BOOKING] = self::ORDER_SOURCE_BOOKING;
		
	// 	if ($business->service_rental || $business->service_sale)
	// 		$source[self::ORDER_SOURCE_LEASE] = self::ORDER_SOURCE_LEASE;
		
	// 	return $source;
	// }
}
