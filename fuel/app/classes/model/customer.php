<?php
use Orm\Model;

class Model_Customer extends Model
{
    const CUSTOMER_TYPE_GUEST = 'Guest'; // Resident
    const CUSTOMER_TYPE_VISITOR = 'Visitor'; // Non-Resident
    const CUSTOMER_TYPE_TENANT = 'Tenant';
    const CUSTOMER_TYPE_OWNER = 'Owner';
    const CUSTOMER_TYPE_MEMBER = 'Member';
    const CUSTOMER_TYPE_NONMEMBER = 'Non-member';
    
	protected static $_properties = array(
        'id',
        'customer_name',
        'customer_type',
        'customer_group',
        'account_manager',
        'bank_account',
        'billing_currency',
        'default_rate_ref',
        'tax_ID',
        'mobile_phone',
        'email_address',
        'sex',
        'title_of_courtesy',
        'birth_date',
        'ID_attachment',
        'ID_type',
        'ID_no',
        'ID_country',
        'occupation',
        'first_billed',
        'last_billed',
        'credit_limit',
        'is_internal_customer',
        'inactive',
        'on_hold',
        'on_hold_from',
        'on_hold_to',
        'remarks',
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

    protected static $_belongs_to = array(
		'activeLeases' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Lease',
			'key_to' => 'customer_id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
		// 'unitsLeased' => array(
			// 'key_from' => 'customer_id',
			// 'model_to' => 'Model_Unit',
			// 'key_to' => 'id',
			// 'cascade_save' => false,
			// 'cascade_delete' => false,
		// ),
		// 'openBills' => array(
			// 'key_from' => 'id',
			// 'model_to' => 'Model_Sales_Invoice',
			// 'key_to' => 'source_id',
			// 'cascade_save' => true,
			// 'cascade_delete' => true,
		// ),
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('customer_name', 'Customer Name', 'required|max_length[140]');
		$val->add_field('customer_type', 'Customer Type', 'required|max_length[140]');
		$val->add_field('email_address', 'Email Address', 'valid_email|max_length[140]');
		$val->add_field('mobile_phone', 'Mobile Phone', 'required|max_length[140]');
		$val->add_field('ID_type', 'ID Type', 'max_length[3]');
		$val->add_field('ID_no', 'ID Number', 'required|max_length[20]');
        $val->add_field('ID_country', 'ID Country', 'required|valid_string');
        
		return $val;
	}

	protected static $_table_name = 'customer';

    public static function listOptionsCustomerType()
	{
		return array(
            self::CUSTOMER_TYPE_GUEST => self::CUSTOMER_TYPE_GUEST,
            self::CUSTOMER_TYPE_VISITOR => self::CUSTOMER_TYPE_VISITOR,
            self::CUSTOMER_TYPE_TENANT => self::CUSTOMER_TYPE_TENANT,
            self::CUSTOMER_TYPE_OWNER => self::CUSTOMER_TYPE_OWNER,
            self::CUSTOMER_TYPE_MEMBER => self::CUSTOMER_TYPE_MEMBER,
            self::CUSTOMER_TYPE_NONMEMBER => self::CUSTOMER_TYPE_NONMEMBER,
        );
    }
    
    public static function listOptionsCustomerGroup()
	{
		return array(
            'Individual' => 'Individual',
            'Company' => 'Company',
        );
    }
    
    public static function listOptions($type = null)
	{
		$items = DB::select('id','customer_name')
						->from(self::$_table_name)
						->where([
                            'inactive' => false,
                            'customer_type' => $type
                            // ['customer_type', 'in', $type]
                        ])
						->execute()
						->as_array();
        
		$list_options = array('' => '&nbsp;');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['customer_name'];
        }
        
		return $list_options;
	}
}
