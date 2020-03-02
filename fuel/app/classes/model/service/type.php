<?php
use Orm\Model;

class Model_Service_Type extends Model
{
    // System-defined (must NOT be deleted) but can be disabled
    // 
    // Booking by individual/org for personal/commercial use
    public const SERVICE_TYPE_ACCOMMODATION = 'ACCOM'; // 001
    public const SERVICE_TYPE_RENTAL        = 'RENT'; // 002
    public const SERVICE_TYPE_HIRE          = 'HIRE'; // 003
    // Housekeeping
    public const SERVICE_TYPE_HOUSE_KEEPING = 'HK'; // 004
    // Laundry
    public const SERVICE_TYPE_LAUNDRY       = 'LNDRY'; // 005
    // Maintenance
    public const SERVICE_TYPE_MAINTENANCE   = 'MAINT'; // 006
    // Dining
    public const SERVICE_TYPE_MEALS         = 'F&B'; // 007

	protected static $_properties = array(
		'id',
		'name',
		'code',
        'enabled',
        'is_default',
        'parent_id',
        'default_service_provider',
        'fdesk_user',
		'created_at',
		'updated_at',
	);

    protected static $_belongs_to = array(
		'parent' => array(
			'key_from' => 'parent_id',
			'model_to' => 'Model_Service_Type',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
    );

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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('code', 'Code', 'required|max_length[255]');
		$val->add_field('enabled', 'Enabled', 'required');
		// $val->add_field('parent_id', 'Parent', 'valid_string[numeric]');

		return $val;
	}

    public static function checkIfServiceIsSystemDefined($service)
    {
        if (in_array($service, self::getSystemDefinedServices()))
            return true;
        // else
        return false;
    }

    public static function getSystemDefinedServices()
    {
        return [
            self::SERVICE_TYPE_ACCOMMODATION,
            self::SERVICE_TYPE_RENTAL,
            self::SERVICE_TYPE_HIRE,
            self::SERVICE_TYPE_HOUSE_KEEPING,
            self::SERVICE_TYPE_LAUNDRY,
            self::SERVICE_TYPE_MAINTENANCE,
            self::SERVICE_TYPE_MEALS,
        ];
    }

    public static function listOptionsServiceType()
    {
		$items = DB::select('st.id', 'st.name')
                    ->from(array('service_types', 'st'))
                    ->join(array('service_types', 'stp'), 'INNER')->on('stp.id', '=', 'st.parent_id')
                    ->where([
                        'st.enabled' => true,
                        ['st.parent_id', '!=', 0]
                    ])
                    ->order_by('stp.name', 'ASC')
                    ->order_by('st.name', 'ASC')
                    ->execute()
                    ->as_array();
        
		$list_options = array('' => '');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['name'];
        }
        
		return $list_options;
    }

    public static function listOptionsParentServiceType()
    {
		$items = DB::select('id','name')
						->from('service_types')
						->where([
                            'enabled' => true,
                            ['parent_id', 'in', [null, 0]]
                        ])
						->execute()
						->as_array();
        
		$list_options = array('' => '-- Select parent --');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['name'];
        }
        
		return $list_options;
    }
}
