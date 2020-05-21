<?php
use Orm\Model;

class Model_Employee extends Model
{
    const EMPLOYEE_TYPE_INTERN = 'Intern';
    const EMPLOYEE_TYPE_PARTTIME = 'Part-time';
    const EMPLOYEE_TYPE_FULLTIME = 'Full-time';
    const EMPLOYEE_TYPE_CONTRACT = 'Contract';
    
	protected static $_properties = array(
        'id',
        'employee_name',
        'employee_type',
        'employee_group',
        'manager_id',
        'bank_account',
        'base_salary',
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
        'date_joined',
        'date_left',
        // 'is_seconded_employee',
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
		$val->add_field('employee_name', 'Employee Name', 'required|max_length[140]');
		$val->add_field('employee_type', 'Employee Type', 'required|max_length[140]');
		$val->add_field('email_address', 'Email Address', 'valid_email|max_length[140]');
		$val->add_field('mobile_phone', 'Mobile Phone', 'required|max_length[140]');
		$val->add_field('ID_type', 'ID Type', 'max_length[3]');
		$val->add_field('ID_no', 'ID Number', 'required|max_length[20]');
        $val->add_field('ID_country', 'ID Country', 'required|valid_string');
        
		return $val;
	}

	protected static $_table_name = 'employee';

    public static function listOptionsEmployeeType()
	{
		return array(
            self::EMPLOYEE_TYPE_INTERN => self::EMPLOYEE_TYPE_INTERN,
            self::EMPLOYEE_TYPE_PARTTIME => self::EMPLOYEE_TYPE_PARTTIME,
            self::EMPLOYEE_TYPE_FULLTIME => self::EMPLOYEE_TYPE_FULLTIME,
            self::EMPLOYEE_TYPE_CONTRACT => self::EMPLOYEE_TYPE_CONTRACT,
        );
    }
    
    public static function listOptionsEmployeeGroup()
	{
		return array(
            'Individual' => 'Individual',
            'Company' => 'Company',
        );
    }
    
    public static function listOptions($type = null)
	{
		$items = DB::select('id','employee_name')
						->from(self::$_table_name)
						->where([
                            'inactive' => false,
                            // ['employee_type', 'in', $type]
                        ])
						->execute()
						->as_array();
        
		$list_options = array('' => '');

		foreach($items as $item) {
			$list_options[$item['id']] = $item['employee_name'];
        }
        
		return $list_options;
	}
}
