<?php
use Orm\Model;

class Model_Summary extends Model
{
	protected static $_properties = array(
		'id',
		'reference',
		'date',
		'units_sold',
		'units_blocked',
		'complimentary_units',
		'no_of_guests',
		'opening_bal',
		'rent_total',
		'discount_total',
		'settlement_total',
		'expense_total',
		'deposits_total',
		'closing_bal',
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
		$val->add_field('reference', 'Reference', 'required|max_length[10]');
		$val->add_field('date', 'Date', 'required');
		$val->add_field('units_sold', 'Units Sold', 'required|valid_string[numeric]');
		$val->add_field('units_blocked', 'Units Blocked', 'required|valid_string[numeric]');
		$val->add_field('complimentary_units', 'Complimentary Units', 'required|valid_string[numeric]');
		$val->add_field('no_of_guests', 'No Of Guests', 'required|max_length[10]');
		$val->add_field('opening_bal', 'Opening Bal', 'required');
		$val->add_field('rent_total', 'Rent Total', 'required');
		$val->add_field('discount_total', 'Discount Total', 'required');
		$val->add_field('settlement_total', 'Settlement Total', 'required');
		$val->add_field('expense_total', 'Expense Total', 'required');
		$val->add_field('deposits_total', 'Deposits Total', 'required');
		$val->add_field('closing_bal', 'Closing Bal', 'required');
		$val->add_field('fdesk_user', 'Fdesk User', 'required|valid_string[numeric]');

		return $val;
	}

	protected static $_table_name = 'summary';
}
