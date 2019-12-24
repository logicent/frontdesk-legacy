<?php
use Orm\Model;

class Model_User_Metadata extends Model
{
    protected static $_properties = array(
        'id',				// primary key
        'parent_id',		// owner
        'key',				// attribute column
        'value',			// value column
        'user_id',			// foreign key
    );

    protected static $_table_name = 'users_metadata';
}
