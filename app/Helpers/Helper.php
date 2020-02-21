<?php 

namespace App\Helpers;
use Route;
use Session;
use DB;
use App\Admin\Kyc;
use Auth;

class Helper
{
    public static function getleftMenu()
    {
		$role_id= Auth::user()->role_id;
		$asignroute=DB::table('user_roles')->where('id',$role_id)->get()->first();
		$permitions=(array) json_decode($asignroute->Permissions);
		/* $route_name = array_column($asignroute, 'route_name');
		$routeCollection = Route::getRoutes()->get();
		$menuData=array();
		foreach($routeCollection as $route)
			{
				$item=array();
				$action=$route->action;					
				if(!empty($action['as']) and $action['namespace']=='App\Http\Controllers\Admin' )
					{
						$menuData[]=$action['as'];
					}			
			}
		$menuData=array_unique($menuData);
		$menuData=array_intersect($menuData,$route_name); */
				
        return $permitions;
    }

public static function is_kyc()
{
	$id= Auth::user()->id;
	$countkyc=Kyc::Where('user_id','=',$id)->count();
	if($countkyc>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
   
}