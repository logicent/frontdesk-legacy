<?php

class Model_Country extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'iso_3166_2',
		'iso_3166_3',
		'currency_code',
		'currency_symbol',
	);

	protected static $_table_name = 'countries';

	public static function listOptions($prompt, $prompt_text = '')
	{
		$items = DB::select('iso_3166_3', 'name')->from(self::$_table_name)->execute()->as_array();
        
        if ($prompt === false) 
            $list_options = array();
        else 
            $list_options = array( '' => $prompt_text);
		
		foreach($items as $item)
			$list_options[$item['iso_3166_3']] = $item['name'];
		
		return $list_options;
	}

	public static function getDefaultCountry()
	{
        //  TODO: use the settings to capture this as pre-defined value
		return 'KEN';
	}
	
}
