<?php
use Orm\Model;

class Model_Member extends Model_Customer
{
    // protected static $_belongs_to = array(
		// 'openBills' => array(
			// 'key_from' => 'id',
			// 'model_to' => 'Model_Sales_Invoice',
			// 'key_to' => 'source_id',
			// 'cascade_save' => true,
			// 'cascade_delete' => true,
		// ),
    // );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('customer_name', 'Full name', 'required|max_length[140]');
		$val->add_field('customer_type', 'Member Type', 'required|max_length[140]');
		$val->add_field('email_address', 'Email Address', 'valid_email|max_length[140]');
		$val->add_field('birth_date', 'Date of Birth', 'required|valid_date|max_length[140]');
		$val->add_field('mobile_phone', 'Mobile Phone', 'required|max_length[140]');
		$val->add_field('ID_type', 'ID Type', 'max_length[3]');
		$val->add_field('ID_no', 'ID Number', 'required|max_length[20]');
        $val->add_field('ID_country', 'ID Country', 'required|valid_string');
        
		return $val;
	}

    public static function listOptionsMemberGroup()
	{
		return array(
            'Corporate' => 'Corporate',
            'Individual' => 'Individual',
        );
    }
    
    public static function listOptions($type = null)
	{
		$items = DB::select('id','customer_name')
					->from(parent::$_table_name)
					->where([
						'inactive' => false,
						'customer_type' => parent::CUSTOMER_TYPE_MEMBER
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
