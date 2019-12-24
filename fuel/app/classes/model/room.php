<?php
use Orm\Model;

class Model_Room extends Model
{
	const ROOM_STATUS_OCCUPIED = 'OCC';
	const ROOM_STATUS_VACANT = 'VAC';
	//const ROOM_STATUS_DUE_CHECK_OUT = 'dco'; // will be available
	const ROOM_STATUS_BLOCKED = 'BLO'; // out-of-order
	public static $room_status = array(
		self::ROOM_STATUS_OCCUPIED => 'Occupied',
		self::ROOM_STATUS_VACANT => 'Vacant',
		self::ROOM_STATUS_BLOCKED => 'Blocked',
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
		'room_type',
		'alias',
		'status',
		'hk_status',

	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[10]');
		$val->add_field('room_type', 'Room Type', 'required|valid_string[numeric]');
		$val->add_field('alias', 'Alias', 'max_length[20]');
		$val->add_field('status', 'Status', 'max_length[3]');
		$val->add_field('hk_status', 'HK Status', 'max_length[3]');

		return $val;
	}

	protected static $_table_name = 'room';

	public static function listOptions($room_id = null, $status = 'vac')
	{
		$items = DB::select('id','name','status')->from(self::$_table_name)->execute()->as_array();

		if (!is_null($room_id))
			$list_options = array($room_id => Model_Room::find($room_id)->name);
		else $list_options = array(''=>'');

		foreach($items as $item) {
			if ($item['status'] != $status) continue;
			$list_options[$item['id']] = $item['name'];
		}

		return $list_options;
	}

	protected static $_belongs_to = array(
		'rm_type' => array(
			'key_from' => 'room_type',
			'model_to' => 'Model_Room_Type',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

	public static function hasOpenReservations()
	{

	}

	public static function getRoomHistory()
	{
		// bookings per room over period
		$rm_history = Model_Guest_Register::find('all', array('related' => array('room', 'bill'),
															  'order_by' => array('room_id', 'checkin')));

	}
}
