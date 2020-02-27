<?php
use Orm\Model;

class Model_Service_Type extends Model
{
    // System-defined (must NOT be deleted) but can be disabled
    // 
    // Facility use by individual/organization for personal/commercial purpose
    public const SERVICE_TYPE_ACCOMMODATION = 'ACCOM'; // 001
    public const SERVICE_TYPE_RENTAL = 'RENT'; // 002
    public const SERVICE_TYPE_HIRE = 'HIRE'; // 003
    // Housekeeping
    public const SERVICE_TYPE_CLEANING = 'CLNG'; // 004
    public const SERVICE_TYPE_COOKING = 'CKG'; // 004
    public const SERVICE_TYPE_LAUNDRY = 'LNDRY'; // 005
    public const SERVICE_TYPE_DRY_CLEANING = 'DRYC'; // 006
    // Food and Beverages (Meals)
    public const SERVICE_TYPE_DINING = 'DIN'; // 007

	protected static $_properties = array(
		'id',
		'name',
		'code',
        'enabled',
        'is_default',
        'default_service_provider',
        'fdesk_user',
		'created_at',
		'updated_at',
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
            self::SERVICE_TYPE_CLEANING,
            self::SERVICE_TYPE_COOKING,
            self::SERVICE_TYPE_LAUNDRY,
            self::SERVICE_TYPE_DRY_CLEANING,
            self::SERVICE_TYPE_DINING,
        ];
    }
}
