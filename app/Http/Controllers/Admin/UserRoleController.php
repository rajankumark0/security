<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\UserRole;
use App\Admin\Plan;
use Redirect; 
use Auth;
use Validator;
use Storage;
use DB;
use Route;
class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 $param['search']=$request->input('search');
         $param['type']=$request->input('type');
		 if(!empty($request->input('country')))
		 {
		     $param['country']=$request->input('country');
		 }
		 else
		 {
			 $param['country']=array();
		 }		 
	
		 $data['param']=$param;
		  $data['user_role']= UserRole::get();
		  
        return view('admin.user_role.role_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $userrole= UserRole::where('status', 1)->get();	     
          return view('admin.user_role.role_add',compact('userrole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $validatedData = $request->validate([	        
				'role_type' => 'required',
			
				
			]);	
			
	          $planprice = new UserRole;
	          $planprice->role_type = $request->role_type;			
	          
			  $planprice->status = $request->status; 
			  	
              				  
		      $planprice->save();
		 
		 return redirect('/admin/user-role')->with('message', 'UserRole successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*     public function show($id)
    {
       $planprice=UserRole::leftJoin('users', function($join){ $join->on('planprices.added_by','=','users.id'); })
	            ->where('planprices.id',$id)
	            ->first(['planprices.*','users.name as uname']);
	   
	   return view('admin.planprice.planprice_view',compact('planprice'));
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
		$data['user_role']= UserRole::find($id); 

        return view('admin.user_role.role_edit',$data);
    }


  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
				'role_type' => 'required',
				'status' => 'required'
			]);
			
					 
 
	
			
			$UserRole =UserRole::find($id);
			$UserRole->role_type = $request->role_type;			
			$UserRole->status = $request->status; 
			$UserRole->update();

		  
		 return redirect('/admin/user-role')->with('message', 'User Role successfully updated!');
       }
     
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $planprice =UserRole::find($id);
		 $planprice->delete();
		  return redirect('/admin/user-role')->with('message', 'User Role successfully deleted!');
    }
	
	public function addpermission($id)
    {
		
		$data['action'] = Route::getRoutes()->get();
		
		$data['user_role']= UserRole::find($id); 

        return view('admin.user_role.add_permission',$data);
    }
	public function updatepermission(Request $request, $id)
	{
		
			$UserRole =UserRole::find($id);
			$UserRole->Permissions = json_encode($request->permision);			
			$UserRole->update();
			 return redirect('/admin/user-role')->with('message', 'User permission successfully assigned!');
		
		
	}
	
    
}
