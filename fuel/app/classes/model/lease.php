<?php
use Orm\Model;

class Model_Lease extends Model
{
    const TENANT_STATUS_INCOMING = 'Incoming';
    const TENANT_STATUS_ONGOING = 'Ongoing';
    const TENANT_STATUS_OUTGOING = 'Outgoing';
	const TENANT_STATUS_INACTIVE = 'Inactive';
	
	protected static $_properties = array(
		'id',
		'reference',
		'title',
		'customer_id',
		'status',
		'date_leased',
		'premise_use',
		'lease_period',
		'billed_period',
		'billed_amount',
		'require_deposit',
		'deposit_amount',
		'deposit_includes',
		'start_date',
		'end_date',
		'owner_id',
		'property_id',
		'unit_id',
		'attachments',
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
		'customer' => array(
			'key_from' => 'customer_id',
			'model_to' => 'Model_Customer',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
		'unit' => array(
			'key_from' => 'unit_id',
			'model_to' => 'Model_Unit',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'bill' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Sales_Invoice',
			'key_to' => 'source_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),		
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('reference', 'Reference', 'required|max_length[255]');
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('customer_id', 'Customer Name', 'required|valid_string[numeric]');
		// $val->add_field('status', 'Status', 'required|max_length[255]');
		$val->add_field('date_leased', 'Date Leased', 'required');
		$val->add_field('premise_use', 'Premise Use', 'required|max_length[255]');
		$val->add_field('lease_period', 'Lease Period', 'required|valid_string[numeric]');
		$val->add_field('billed_period', 'Billed Period', 'required|max_length[255]');
		$val->add_field('billed_amount', 'Billed Amount', 'required');
		// $val->add_field('require_deposit', 'Require Deposit', '');
		// $val->add_field('deposit_amount', 'Deposit Amount', '');
		// $val->add_field('deposit_includes', 'Deposit Includes', '');
		$val->add_field('start_date', 'Start Date', 'required');
		$val->add_field('end_date', 'End Date', 'required');
		$val->add_field('owner_id', 'Owner', 'required|valid_string[numeric]');
		$val->add_field('property_id', 'Property', 'required|valid_string[numeric]');
		$val->add_field('unit_id', 'Unit', 'required|valid_string[numeric]');
		// $val->add_field('attachments', 'Attachments', '');
		// $val->add_field('on_hold', 'On Hold', '');
		// $val->add_field('on_hold_from', 'On Hold From', '');
		// $val->add_field('on_hold_to', 'On Hold To', '');
		// $val->add_field('remarks', 'Remarks', '');

		return $val;
	}

    public static function listOptionsBilledPeriod()
    {
        return array(
            // 'W' => 'Weekly',
            'M' => 'Monthly',
            'Q' => 'Quarterly',
            'Y' => 'Yearly',
        );
    }
}
