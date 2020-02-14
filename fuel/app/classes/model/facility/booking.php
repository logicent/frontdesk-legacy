<?php
use Orm\Model_Soft;

class Model_Facility_Booking extends Model_Soft
{
	const GUEST_STATUS_CHECKED_IN = 'CI';
	const GUEST_STATUS_STAY_OVER = 'SO';
	const GUEST_STATUS_DUE_OUT = 'DO';
	const GUEST_STATUS_CHECKED_OUT = 'CO';
	public static $guest_status = array(
		self::GUEST_STATUS_CHECKED_IN => 'Checked In',
		self::GUEST_STATUS_STAY_OVER => 'Stay Over',
		self::GUEST_STATUS_DUE_OUT => 'Due Out',
		self::GUEST_STATUS_CHECKED_OUT => 'Checked Out',
	);

	const IDENTITY_TYPE_NATIONAL_ID = 'NI';
	const IDENTITY_TYPE_PASSPORT = 'PP';
	const IDENTITY_TYPE_DRIVING_LICENSE = 'DL';
	public static $ID_type = array(
		self::IDENTITY_TYPE_NATIONAL_ID => 'National ID',
		self::IDENTITY_TYPE_PASSPORT => 'Passport',
		self::IDENTITY_TYPE_DRIVING_LICENSE => 'Driving License',
	);

    const TOC_MR = 'Mr.';
    const TOC_MS = 'Ms.';
    const TOC_DR = 'Dr.';
    
	public static $toc = array(
        '' => '',
		self::TOC_MR => self::TOC_MR,
		self::TOC_MS => self::TOC_MS,
		self::TOC_DR => self::TOC_DR
    );
    
	const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';
    
	public static $sex = array(
        '' => '',
		self::SEX_MALE => 'Male',
		self::SEX_FEMALE => 'Female'
	);

	protected static $_properties = array(
		'id',
		'reg_no',
		'folio_no',
		'room_id',
		'fdesk_user',
		'res_no',
		'status',
		'checkin',
		'checkout',
		'duration',
		'pax_adults',
		'pax_children',
		'voucher_no',
		'last_name',
		'first_name',
		'sex',
		'address',
		'city',
		'country',
		'email',
		'phone',
		'payment_type',
		'verify_code',
		'card_type',
		'card_no',
		'card_expire',
		'rate_type',
		'rate_amount',
		'vat_amount',
		'total_amount',
		'total_charge',
		'total_payment',
		'id_type',
		'id_number',
		'id_country',
		'remarks',
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
		$val->add_field('reg_no', 'Reg. No.', 'required|valid_string[numeric]');
		$val->add_field('folio_no', 'Folio No.', 'valid_string[numeric]');
		$val->add_field('room_id', 'Room No.', 'required|valid_string[numeric]');
		$val->add_field('fdesk_user', 'Frontdesk User', 'required|valid_string[numeric]');
		$val->add_field('res_no', 'Res. No.', 'valid_string[numeric]');
		$val->add_field('status', 'Status', 'required|max_length[3]');
		$val->add_field('checkin', 'Check-in', 'required|valid_date');
		$val->add_field('checkout', 'Check-out', 'required|valid_date');
		$val->add_field('duration', 'Duration (days)', 'valid_string[numeric]');
		$val->add_field('pax_adults', 'Adults (Pax)', 'required|valid_string[numeric]');
		$val->add_field('pax_children', 'Children (Pax)', 'required|valid_string[numeric]');
		$val->add_field('voucher_no', 'Voucher No.', 'valid_string[numeric]');
		$val->add_field('last_name', 'Last Name', 'required|max_length[50]');
		$val->add_field('first_name', 'First Name', 'required|max_length[50]');
		$val->add_field('sex', 'Sex', 'required|max_length[1]');
		$val->add_field('address', 'Address', 'max_length[150]');
		$val->add_field('city', 'City', 'max_length[20]');
		$val->add_field('country', 'Country', 'valid_string');
		$val->add_field('email', 'Email', 'valid_email|max_length[50]');
		$val->add_field('phone', 'Phone', 'required|max_length[20]');
		$val->add_field('payment_type', 'Payment Type', 'max_length[20]');
		$val->add_field('verify_code', 'Verify Code', 'max_length[20]');
		$val->add_field('card_type', 'Card Type', 'max_length[20]');
		$val->add_field('card_no', 'Card No.', 'max_length[20]');
		$val->add_field('card_expire', 'Card Expire', 'valid_date');
		$val->add_field('rate_type', 'Rate Type', 'required|valid_string[numeric]');
		$val->add_field('rate_amount', 'Rate Amount', 'valid_string[]');
		$val->add_field('vat_amount', 'Vat Amount', 'valid_string[]');
		$val->add_field('total_amount', 'Total Amount', 'valid_string[]');
		$val->add_field('total_charge', 'Total Charge', 'valid_string[]');
		$val->add_field('total_payment', 'Total Payment', 'valid_string[]');
		$val->add_field('id_type', 'ID Type', 'max_length[3]');
		$val->add_field('id_number', 'ID Number', 'required|max_length[20]');
		$val->add_field('id_country', 'ID Country', 'required|valid_string');
		$val->add_field('remarks', 'Remarks', 'valid_string["alpha","numeric","spaces","punctuation","newlines","dashes","quotes"]');

		return $val;
	}

	protected static $_table_name = 'facility_booking';

	// public static function after_save($this)
	// {// updated related table data if save succeeded
	// 	return;
	// }

	protected static $_has_one = array(
		'room' => array(
			'key_from' => 'room_id',
			'model_to' => 'Model_Room',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'ratetype' => array(
			'key_from' => 'rate_type',
			'model_to' => 'Model_Rate_Type',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'bill' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Sales_Invoice',
			'key_to' => 'booking_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'g_country' => array(
			'key_from' => 'country',
			'model_to' => 'Model_Country',
			'key_to' => '->iso_3166_3',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

	public static function listOptions($reg_no = false)
	{
		$items = DB::select('id','last_name','first_name', 'reg_no')
						->from(self::$_table_name)
						//->where()
						->execute()
						->as_array();

		$list_options = array();

		foreach($items as $item) {
			$list_options[$item['id']] = ucwords($item['first_name']) .' '. ucwords($item['last_name']);
			if ($reg_no)
				$list_options[$item['id']] .= '&ensp;&ndash;&ensp;#' . $item['reg_no'];
		}
		return $list_options;
	}

	public static function getNextSerialNumber()
	{
		if (self::find('last'))
			return self::find('last')->reg_no + 1; // reference
		else return 1001; // initial record
	}

	public static function getColumnDefault( $name )
	{
		$col_def = DB::list_columns(self::$_table_name, "$name");
		return $col_def["$name"]['default'];
	}

	public static function updateRoomStatus($rm_id, $g_status) {
		$room = Model_Room::find($rm_id);

		switch ($g_status) {
			case self::GUEST_STATUS_CHECKED_IN:
				$room->status = Model_Room::ROOM_STATUS_OCCUPIED;
				break;
			case self::GUEST_STATUS_CHECKED_OUT:
				$room->status = Model_Room::ROOM_STATUS_VACANT;
				break;
			default:
		}

		$room->save(false);
	}

	public static function createSalesInvoice($booking)
	{
		$invoice = Model_Sales_Invoice::forge(array(
			'invoice_num' => Model_Sales_Invoice::getNextSerialNumber(),
			'po_number' => Input::post('po_number'),
			'amounts_tax_inc' => Input::post('amounts_tax_inc'),
			'fdesk_user' => $booking->fdesk_user,
			'issue_date' => $booking->checkin,
			'due_date' => $booking->checkout,
			'status' => Model_Sales_Invoice::INVOICE_STATUS_OPEN,
			'booking_id' => $booking->id,
			'amount_due' => $booking->total_payment,
			'disc_total' => 0,
			'tax_total' => $booking->vat_amount,
			'amount_paid' => 0,
			'balance_due' => $booking->total_payment,
			'advance_paid' => 0,
			'paid_status' => Model_Sales_Invoice::INVOICE_PAID_STATUS_NOT_PAID,
			'billing_address' => $booking->address,
			'summary' => Input::post('summary'),
			'notes' => $booking->remarks,
		));

        // TODO: Use DB transaction here
		if ($invoice and $invoice->save())
		{
			$sales_invoice_item = Model_Sales_Invoice_Item::forge(array(
				'item_id' => Model_Service_Item::find('first')->id,
				'invoice_id' => $invoice->id,
				'gl_account_id' => null,
				'description' => 'Accommodation for room no. '.$booking->room->name,
				'qty' => $booking->duration,
				'unit_price' => $booking->rate_amount,
				'discount_percent' => 0,
				'amount' => $booking->duration * $booking->rate_amount,
			));
			$sales_invoice_item->save();

			Session::set_flash('success', 'Created sales invoice #'.$invoice->id.'.');
		}
		else
		{
			Session::set_flash('error', 'Failed to create invoice.');
		}
	}

	public static function updateSalesInvoice($booking)
	{
		$invoice = $booking->bill;

		$invoice->due_date = $booking->checkout;
		$invoice->amount_due = $booking->total_payment - $invoice->disc_total; // preserve applied discount
		$invoice->balance_due += $booking->total_amount;
		// $invoice->tax_total = $booking->vat_amount;

        // TODO: Use DB transaction here
		if ($invoice and $invoice->save())
		{
			$sales_invoice_item = Model_Sales_Invoice_Item::find('first', array('where' => array('invoice_id' => $invoice->id)));
			$sales_invoice_item->qty = $booking->duration;
			$sales_invoice_item->amount = $booking->duration * $booking->rate_amount;
			$sales_invoice_item->save();

			Session::set_flash('success', 'Updated sales invoice #'.$invoice->id.'.');
		}
		else
		{
			Session::set_flash('error', 'Failed to update invoice.');
		}
	}

    public static function setBillingAmounts(&$fd_booking) 
    {
		$fd_booking->duration = self::getStayPeriod($fd_booking->checkin, $fd_booking->checkout);
		// rates, vat, total, charges and payments
		$fd_booking->rate_amount = Model_Rate::find('first', array('where' => array('id' => $fd_booking->rate_type)))->charges;
		//$fd_booking->vat_amount = $fd_booking->rate_amount / 1.16; // get tax rate
		$fd_booking->total_amount = $fd_booking->rate_amount + $fd_booking->vat_amount;
		$fd_booking->total_payment = $fd_booking->total_amount * $fd_booking->duration;
	}

	public function hasRoomChange() {
		// has Accounting impact on settlement due if room type is different
	}

	public function hasStayChange() {
		// has Accounting impact on settlement due if duration changed
	}

	public function hasRateChange() {
		// has Accounting impact on settlement due if room plan changed
	}

	public function hasBalanceDue() {
		// has outstanding settlement if not fully paid
	}

	public function guestIsDueOut() {
		// if ci_date == today_date then status is DO i.e. due out
	}

	public function setGuestStatus() {
		if ($this->is_new())
			return self::GUEST_STATUS_CHECKED_IN;
		// if ci_date == today_date return ci
		// if ci_date < today_date return so
		// if co_date == today_date return do
		// if co_date < today_date return co
	}

	public static function getStayPeriod($checkin, $checkout)
	{
		return round(abs(strtotime($checkin) - strtotime($checkout)) / 86400);
	}

	public function activeRoomBookingExists($rm_id)
	{
		return Model_Facility_Booking::find('first', array('where' => array('room_id' => $rm_id, array('status', '!=', self::GUEST_STATUS_CHECKED_OUT))));
	}
}
