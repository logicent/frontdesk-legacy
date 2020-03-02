<?php

class Model_Setting extends \Orm\Model
{
    public const SETTINGS_COLUMN_RIGHT = 'rgt';
    public const SETTINGS_COLUMN_LEFT = 'lft';

	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"created_at" => array(
			"label" => "Created at",
			"data_type" => "int",
		),
		"updated_at" => array(
			"label" => "Updated at",
			"data_type" => "int",
		),
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'settings';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

    public static function menu_list_items()
    {
        return array(
            'business' => array(
                array(
                    'id'     => 'business_detail',
                    'label'  => 'Business detail',
                    'route'  => 'settings/business-detail',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                array(
                    'id'     => 'bank_account',
                    'label'  => 'Bank account',
                    'route'  => 'accounts/bank-account',
                    'column' => self::SETTINGS_COLUMN_LEFT,
                ),
            ),
            'payments' => array(
                array(
                    'id'     => 'taxes',
                    'label'  => 'Taxes & charges',
                    'route'  => 'accounts/taxes',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                array(
                    'id'     => 'payment_method',
                    'label'  => 'Payment method',
                    'route'  => 'accounts/payment-method',
                    'column' => self::SETTINGS_COLUMN_LEFT,
                ),
            ),
            'property' => array(
                array(
                    'id'     => 'property_type',
                    'label'  => 'Property type',
                    'route'  => 'facilities/property-type',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                array(
                    'id'     => 'amenities',
                    'label'  => 'Amenities',
                    'route'  => 'facilities/amenities',
                    'column' => self::SETTINGS_COLUMN_LEFT,
                ),
            ),
            'services' => array(
                array(
                    'id'     => 'service_type',
                    'label'  => 'Service type',
                    'route'  => 'facilities/service-type',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                array(
                    'id'     => 'accommodation',
                    'label'  => 'Accommodation',
                    'route'  => 'settings/accommodation',
                    'column' => self::SETTINGS_COLUMN_LEFT,
                ),
                array(
                    'id'     => 'rental',
                    'label'  => 'Rental',
                    'route'  => 'settings/rental',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                array(
                    'id'     => 'hire',
                    'label'  => 'Hire',
                    'route'  => 'settings/hire',
                    'column' => self::SETTINGS_COLUMN_LEFT,
                ),                                
            ),
            'email' => array(
                array(
                    'id'     => 'email_settings',
                    'label'  => 'Email settings',
                    'route'  => 'settings/email-settings',
                    'column' => self::SETTINGS_COLUMN_RIGHT,
                ),
                // array(
                //     'id'     => 'email_templates',
                //     'label'  => 'Email templates',
                //     'route'  => 'settings/email-templates',
                //     'column' => self::SETTINGS_COLUMN_LEFT,
                // ),
            ),
            // permissions
            // roles
            // language text
            // letter templates
            // standard policy
            // checklists
        );
    }
}
