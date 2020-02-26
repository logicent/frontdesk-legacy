<?php
use Orm\Model;

class Model_Unit extends Model
{
	const UNIT_STATUS_OCCUPIED = 'OCC';
	const UNIT_STATUS_VACANT = 'VAC';
	//const UNIT_STATUS_DUE_CHECK_OUT = 'dco'; // will be available
	const UNIT_STATUS_BLOCKED = 'BLO'; // out-of-order
	public static $unit_status = array(
		self::UNIT_STATUS_OCCUPIED => 'Occupied',
		self::UNIT_STATUS_VACANT => 'Vacant',
		self::UNIT_STATUS_BLOCKED => 'Blocked',
	);

	const HK_STATUS_DIRTY = 'DTY';
	const HK_STATUS_TOUCH_UP = 'TUP';
	const HK_STATUS_CLEAN = 'CLN';
	public static $hk_status = array(
		self::HK_STATUS_DIRTY => 'Dirty',
		self::HK_STATUS_TOUCH_UP => 'Touch Up',
		self::HK_STATUS_CLEAN => 'Clean'
	);

	protected static $_properties = array(
		'id',
		'name',
		'unit_type',
		'status',
        'hk_status',
        'prefix',
        'fdesk_user',
        'created_at',
        'updated_at',
        'deleted_at',

	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[10]');
		$val->add_field('unit_type', 'Unit Type', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'max_length[3]');
		$val->add_field('hk_status', 'HK Status', 'max_length[3]');

		return $val;
	}

	protected static $_table_name = 'unit';

    protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
    );
    
	public static function listOptions($unit_id = null, $status = 'VAC')
	{
		$items = DB::select('id','name','status')->from(self::$_table_name)->execute()->as_array();

		if (!empty($unit_id))
			return array($unit_id => Model_Unit::find($unit_id)->name);
        
        $list_options = array(''=>'');

		foreach($items as $item) {
			if ($item['status'] != $status) continue;
			$list_options[$item['id']] = $item['name'];
		}
        
		return $list_options;
	}

	protected static $_belongs_to = array(
		'type' => array(
			'key_from' => 'unit_type',
			'model_to' => 'Model_Unit_Type',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

    protected static $_has_many = array(
		'reservations' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Facility_Reservation',
			'key_to' => 'unit_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
    );
    
	public static function hasOpenReservations()
	{

	}

	public static function getUnitHistory()
	{
		// usage per unit over period
		$unit_history = Model_Guest_Register::find('all', array('related' => array('unit', 'bill'),
                                                    'order_by' => array('unit_id', 'checkin')));

	}
}
