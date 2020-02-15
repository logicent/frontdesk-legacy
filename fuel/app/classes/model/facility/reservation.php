<?php
use Orm\Model_Soft;

class Model_Facility_Reservation extends Model_Soft
{
	const RESERVATION_STATUS_OPEN = 'Open';
	const RESERVATION_STATUS_BOOKED = 'Sold';
	const RESERVATION_STATUS_NOSHOW = 'Lost';
	const RESERVATION_STATUS_VOID = 'Void';
	public static $guest_status = array(
		self::RESERVATION_STATUS_OPEN => 'Open',
		self::RESERVATION_STATUS_BOOKED => 'Booked',
		self::RESERVATION_STATUS_NOSHOW => 'No Show',
		self::RESERVATION_STATUS_VOID => 'Void',
	);

	protected static $_properties = array(
		'id',
		'res_no',
		'unit_id',
		'fdesk_user',
		'status',
		'checkin',
		'checkout',
		'duration',
		'pax_adults',
		'pax_children',
		'voucher_no',
		'last_name',
		'first_name',
		'address',
		'city',
		'country',
		'email',
		'phone',
		'rate_type',
		'id_type',
		'id_number',
		'id_country',
		'remarks',
		'deleted_at',
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
		$val->add_field('res_no', 'Reservation No.', 'required|valid_string[numeric]');
		$val->add_field('unit_id', 'Unit No.', 'required|valid_string[numeric]');
		$val->add_field('fdesk_user', 'Frontdesk User', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'required|max_length[6]');
		$val->add_field('checkin', 'Checkin', 'required|valid_date');
		$val->add_field('checkout', 'Checkout', 'required|valid_date');
		$val->add_field('duration', 'Duration', 'required|valid_string[numeric]');
		$val->add_field('pax_adults', 'Adults', 'required|valid_string[numeric]');
		$val->add_field('pax_children', 'Children', 'required|valid_string[numeric]');
		$val->add_field('voucher_no', 'Voucher No.', 'valid_string[numeric]');
		$val->add_field('last_name', 'Last Name', 'required|max_length[50]');
		$val->add_field('first_name', 'First Name', 'required|max_length[50]');
		$val->add_field('address', 'Address', 'max_length[150]');
		$val->add_field('city', 'City', 'max_length[20]');
		$val->add_field('country', 'Country', 'required|valid_string');
		$val->add_field('email', 'Email', 'valid_email|max_length[50]');
		$val->add_field('phone', 'Phone', 'required|max_length[20]');
		$val->add_field('rate_type', 'Rate Type', 'required|valid_string[numeric]');
		$val->add_field('id_type', 'ID Type', 'required|max_length[3]');
		$val->add_field('id_number', 'ID Number', 'max_length[20]');
		$val->add_field('id_country', 'ID Country', 'required|valid_string');
		$val->add_field('remarks', 'Remarks', 'valid_string["alpha","numeric","spaces","punctuation","newlines","dashes","quotes"]');

		return $val;
	}

	protected static $_table_name = 'facility_reservation';

	protected static $_has_one = array(
		'unit' => array(
			'key_from' => 'unit_id',
			'model_to' => 'Model_Unit',
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
		'g_country' => array(
			'key_from' => 'id_country',
			'model_to' => 'Model_Country',
			'key_to' => 'iso_3166_3',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

	public static function getNextSerialNumber()
	{
		if (self::find('last'))
			return self::find('last')->res_no + 1; // reference
		else return 1; // initial record
    }
    
}
