<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
class Visitor extends Model 
{   
	
	 public static function getList($param=null)
	   {	  
				  $result = DB::table('visitors')->where($param);
				    $res =  $result->paginate(10);	
				   
			return $res;
		   
		 } 
	 
 	 
}
