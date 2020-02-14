<?php
use Orm\Model_Soft;

class Model_Accounts_Payment_Receipt extends Model_Soft
{
	public static $payment_type = array(
		'Csh' => 'Cash',
		'Mob' => 'Mobile Cash',
		'Crd' => 'Credit Card',
	);

	public static $card_type = array(
		'' => '',
		'Vis' => 'Visa',
		'Mas' => 'MasterCard',
	);

	protected static $_properties = array(
		'id',
		'receipt_number',
		'bill_id',
		'date',
        'payer',
        'payment_method',
        'reference',
        'status',
        'attachment',
		'gl_account_id',
		'amount',
		'tax_id',
		'bank_account_id',
		'description',
		'fdesk_user',
		'created_at',
		'updated_at',
		'deleted_at'
	);

	protected static $_table_name = 'sales_payment';

	protected static $_soft_delete = array(
		//'deleted_field' => 'deleted_at',
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
		$val->add_field('receipt_number', 'Reference', 'required|valid_string[numeric]');
		$val->add_field('bill_id', 'Bill No.', 'required|valid_string[numeric]');
		$val->add_field('date', 'Date', 'required|valid_date');
		$val->add_field('payer', 'Payer', 'required|max_length[140]');
		$val->add_field('gl_account_id', 'Gl Account Id', 'valid_string[numeric]');
		$val->add_field('amount', 'Amount', 'required|numeric_min[0]');
		$val->add_field('payment_method', 'Payment Method', 'required');
		$val->add_field('reference', 'Payment Reference', 'valid_string[alpha]');
		$val->add_field('status', 'Status', 'required');
		$val->add_field('tax_id', 'Tax Id', 'valid_string[numeric]');
		$val->add_field('bank_account_id', 'Bank Account Id', 'valid_string[numeric]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('attachment', 'Attachment', 'max_length[140]');

		$val->set_message('numeric_min', 'Amount must be 0 or greater'); // preferrably greater than 0 in create mode

		return $val;
	}

	// protected static $_table_name = 'cash_receipt';

	protected static $_belongs_to = array(
		'invoice' => array(
			'key_from' => 'bill_id',
			'model_to' => 'Model_Sales_Invoice',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

	public static function updateInvoiceSettlement($bill, $amount_paid)
	{
		$bill->amount_paid += $amount_paid;
		$bill->balance_due = $bill->amount_due - $bill->amount_paid;
		// advance paid reversal not working
		// if ($bill->paid_status = Model_Sales_Invoice::INVOICE_PAID_STATUS_PLUS_PAID)
		// 	$bill->advance_paid -= $amount_paid;

		switch ($bill->balance_due)
		{
			case 0:
				if ($bill->guest->status == Model_Facility_Booking::GUEST_STATUS_CHECKED_OUT)
					$bill->status = Model_Sales_Invoice::INVOICE_STATUS_CLOSED;
				$bill->paid_status = Model_Sales_Invoice::INVOICE_PAID_STATUS_FULL_PAID;
				break;

			case $bill->balance_due < 0:
				$bill->advance_paid += abs($bill->balance_due); // add neg bal to advance_paid
				$bill->balance_due += abs($bill->balance_due);
				$bill->paid_status = Model_Sales_Invoice::INVOICE_PAID_STATUS_PLUS_PAID;
				break;

			case $bill->balance_due < $bill->amount_due:
				$bill->paid_status = Model_Sales_Invoice::INVOICE_PAID_STATUS_PART_PAID;
				break;

			default: // $bill->balance_due == $bill->amount_due
				$bill->paid_status = Model_Sales_Invoice::INVOICE_PAID_STATUS_NOT_PAID;
		}
		// update invoice
		$bill->save();
	}

	public static function getNextSerialNumber()
	{
		if (self::find('last'))
			return self::find('last')->receipt_number + 1;
		else return 10001; // initial record
	}
}
