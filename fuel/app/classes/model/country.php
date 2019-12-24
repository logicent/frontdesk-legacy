<?php

class Model_Country extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'sequence',
		'name',
		'iso_code_2',
		'iso_code_3',
		'address_format',
		'zip_required',
		'status',
		'tax',
	);

	protected static $_table_name = 'countries';

	public static function listOptions($prompt, $prompt_text)
	{
		$items = DB::select('id','name')->from(self::$_table_name)->execute()->as_array();
		
		if ($prompt === false) $list_options = array();
		else $list_options = array(''=>'');
		
		foreach($items as $item)
			$list_options[$item['id']] = $item['name'];
		
		return $list_options;
	}

	public static function getDefaultCountry()
	{
		return self::find('first', array('where' => array('iso_code_2' => 'KE')))->id;
	}
	
}
