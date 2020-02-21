<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class Cms extends Model 
{
	
    public static function cms_list($language_slug = NULL)
	{
		    $response = DB::table('cms');				
			$res = $response->paginate(10);			
            return $res;			
			
	}


}
