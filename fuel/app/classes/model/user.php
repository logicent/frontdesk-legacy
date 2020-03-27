<?php
use Orm\Model_Soft;

class Model_User extends Model_Soft
{
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group_id',
		'email',
		'last_login',
		'previous_login',
		'login_hash',
		'user_id', // where is this used
		'created_at',
		'updated_at',
		'deleted_at',
	);

	protected static $_soft_delete = array(
		'deleted_field' => 'deleted_at',
		'mysql_timestamp' => true,
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
		$val->add_field('username', 'Username', 'required|max_length[50]');
		$val->add_field('password', 'Password', 'max_length[255]');
		$val->add_field('group_id', 'Group Id', 'required|valid_string[numeric]');
		$val->add_field('email', 'Email', 'valid_email|max_length[255]');
		$val->add_field('last_login', 'Last Login', 'max_length[25]');
		$val->add_field('previous_login', 'Previous Login', 'max_length[25]');
		$val->add_field('login_hash', 'Login Hash', 'max_length[255]');
		$val->add_field('user_id', 'User Id', 'valid_string[numeric]');
		$val->add_field('fullname', 'Full Name', 'required|max_length[140]');
		$val->add_field('mobile', 'Mobile Phone', 'max_length[20]');

		return $val;
	}

    protected static $_has_many = array(
        'metadata' => array(
            'key_from' => 'id',		// key in this model
            'key_to' => 'parent_id',	// key in the related model
			'model_to' => 'Model_User_Metadata',
            'cascade_save' => true,	// update the related table on save
            'cascade_delete' => true,	// delete the related data when deleting the parent
        )
    );

	protected static $_belongs_to = array(
		'group' => array(
			'model_to' => 'Model\Auth_Group',
			'key_from' => 'group_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	// define the EAV container
	protected static $_eav = array(
		'metadata' => array(		// relation
			'attribute' => 'key',	// the key column in the related table contains the attribute
			'value' => 'value',		// the value column in the related table contains the value
		)
	);

    public static function listOptions($show_del = false)
	{
		$users = DB::select('id','username')
                    // ->from(self::$_table_name)
                    ->from('users')
                    ->where(array('deleted_at' => null, array('group_id', 'in', array(3,5))))
                    ->execute()
                    ->as_array();

		$list_options = array('' => '');

		foreach($users as $user) {
			$list_options[ $user['id'] ] = $user['username'];
        }
        
		return $list_options;
	}

	public static function getUserGroupList($superuser = false)
    {
        $groups = Model\Auth_Group::find('all', array('where' => array(
                                    array('id', '!=', 1),
                                    array('id', '!=', 2),
									array('id', '!=', 4))));
        $list_options = array();

        foreach ($groups as $group) {
            $list_options[$group->id] = $group->name;
        }

		if (!$superuser)
			unset($list_options[6]);

        return $list_options;
    }
}
