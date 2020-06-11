<?php
use Orm\Model;

class Model_Accounts_Payment_Method extends Model
{
	protected static $_properties = array(
        'id',
        'code',
        'name',
        'is_default',
        'enabled',
		'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_table_name = 'payment_methods';

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('code', 'Code', 'required');
        $val->add_field('name', 'Name', 'required');
        $val->add_field('is_default', 'Is Default', 'boolean');
        $val->add_field('enabled', 'Enabled', 'boolean');
        
		return $val;
	}

    public static function listOptions()
	{
		$items = DB::select('code','name')
						->from(self::$_table_name)
                        ->where(array('enabled' => true))
						->execute()
						->as_array();

		$list_options = array('' => '');
		foreach($items as $item) {
			$list_options[$item['code']] = $item['name'];
        }
		return $list_options;
	}
}
