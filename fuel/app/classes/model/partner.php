<?php
use Orm\Model;

class Model_Partner extends Model
{
	protected static $_properties = array(
        'id',
        'partner_name',
        'partner_type',
        'partner_group',
        'account_manager',
        'bank_account',
        'billing_currency',
        'default_rate_ref',
        'tax_ID',
        'phone',
        'email_address',
        'first_billed',
        'last_billed',
        'credit_limit',
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
		$val->add_field('partner_name', 'Partner Name', 'required|max_length[140]');
		$val->add_field('partner_type', 'Partner Type', 'required|max_length[140]');
		$val->add_field('email_address', 'Email Address', 'required|valid_email');
		$val->add_field('phone', 'Phone Number', 'required');
		$val->add_field('credit_limit', 'Credit Limit', 'valid_string[numeric]');

		return $val;
	}

    public static function listOptionsPartnerGroup()
	{
		return array(
            'Local' => 'Local',
            'Natl' => 'National',
            'Intl' => 'International',
        );
    }
    
    public static function listOptionsPartnerType()
	{
		return array(
            'Co' => 'Company', // Sub-contractors, Service providers, Property agency
            'BS' => 'Business Source', // Car agents, Tours & Travel agents
            'OTA' => 'Online TA',
        );
	}
}
