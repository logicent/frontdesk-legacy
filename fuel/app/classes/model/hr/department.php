<?php
use Orm\Model;

class Model_Hr_Department extends Model
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'enabled',
		'parent_id',
		'fdesk_user',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'parent' => array(
			'key_from' => 'parent_id',
			'model_to' => 'Model_Hr_Department',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
        ),
	);
	
	protected static $_table_name = 'department';

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
		// $val->add_field('enabled', 'Enabled', '');
		$val->add_field('parent_id', 'Parent Dept.', 'valid_string[numeric]');

		return $val;
	}

	public static function listOptionsParentDepartment($self)
    {
		$items = DB::select('id','name')
					->from('department')
					->where([
						'enabled' => true,
						'parent_id' => null
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
