<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use DB;
class Admin extends Model 
{
       protected  $table = 'users'; 
	
	 public static function getAdminList($param=null)
	   {	  
				  $result = DB::table('users')
							 ->leftjoin('countries', 'users.country', '=', 'countries.code')
							 ->leftjoin('user_roles', 'users.role_id', '=', 'user_roles.id')
							->select('users.*','countries.name as country_name','user_roles.role_type');
							
							 if(!empty($param['country']))
							 {							
								 $result->whereIn('users.country', $param['country']);
							 } 						 
						   if($param['type']!='')
							 {							
								 $result->where('users.role_id', $param['type']);
							 } 	
								
							   $result->where('users.role_id',2);					 
											
							if($param['search']!='')
							 {		
							   $q=$param['search'];							 
									$result->where(function ($query) use($q) {	
									$query->where('users.name', 'like', '%'.$q.'%');
									$query->orWhere('users.email','like','%'.$q.'%');	
									$query->orWhere('users.id','like','%'.$q.'%');						
								  });
							 } 


							
					   
				$res =  $result->paginate(10);	
				   
			return $res;
		   
		 }
	 
	 
	 
  public static function getAdminCount()
   {	  
       
		      $result = DB::table('users')						
						 ->leftjoin('user_roles', 'users.role_id', '=', 'user_roles.id');		 	
						   $result->where('allow_add', '>', 0);   
				   
			$res =  $result->count();	
			   
		return $res;
	   
     }
	 
	 
	 
}
