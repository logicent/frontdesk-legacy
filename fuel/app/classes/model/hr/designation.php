<?php
use Orm\Model;

class Model_Hr_Designation extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'description',
		'enabled',
		'reports_to',
		'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'manager' => array(
			'key_from' => 'reports_to',
			'model_to' => 'Model_Hr_Designation',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
    );

	protected static $_table_name = 'designation';

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
		$val->add_field('code', 'Code', 'required|max_length[20]');
		$val->add_field('name', 'Name', 'required|max_length[140]');
		$val->add_field('description', 'Description', 'max_length[280]');
		// $val->add_field('enabled', 'Enabled', '');
		$val->add_field('reports_to', 'Reports To', 'valid_string[numeric]');

		return $val;
	}

	public static function listOptionsReportsTo($self)
    {
		$items = DB::select('id','name')
					->from('designation')
					->where([
						'enabled' => true,
						'reports_to' => null
					])
					->and_where([
						['id', '<>', $self]
					])
					->execute()
					->as_array();
        
		$list_options = array('' => '');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['name'];
        }
        
		return $list_options;
    }
}
