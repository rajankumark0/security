<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
class PlanPrice extends Model 
{   
	
	 public static function getList($param=null)
	   {	  
				  $result = DB::table('plan_prices');
				    $res =  $result->paginate(10);	
				   
			return $res;
		   
		 } 
	 
 	 
}
