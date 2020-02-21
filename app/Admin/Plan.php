<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
class Plan extends Model 
{   
	
	 public static function getList($param=null)
	   {	  
				  $result = DB::table('plans');
				    $res =  $result->paginate(10);	
				   
			return $res;
		   
		 } 
	 
 	 
}
