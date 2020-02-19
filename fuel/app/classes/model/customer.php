<?php
use Orm\Model;

class Model_Customer extends Model
{
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
            'Guest' => 'Guest', // Resident
            'Tenant' => 'Tenant',
            'Owner' => 'Owner',
            'Member' => 'Member',
            'Non-member' => 'Non-member',
            'Non-resident' => 'Non-resident', // Visitor
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
						->where(['inactive' => false])
						->and_where(['customer_type' => $type])
						->execute()
						->as_array();
        
		$list_options = array('' => '');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['customer_name'];
        }
        
		return $list_options;
	}
}
