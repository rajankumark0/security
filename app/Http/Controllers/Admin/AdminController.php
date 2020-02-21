<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Admin;
use App\Admin\Country;
use Redirect;
use Auth;
use Validator;
use Storage;

class AdminController extends Controller
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
		 }else
		 {
			 $param['country']=array();
		 }		 
	
		 $data['param']=$param;
		  $data['countries']= Country::where('status', 1)->get();
		 $data['adminlist'] = Admin::getAdminList($param);	
         $data['totalAdminlist'] = Admin::getAdminCount();			 
         return view('admin.admin.admin_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $countries= Country::where('status', 1)->get();	     
          return view('admin.admin.admin_add',compact('countries'));
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
				'name' => 'required',
				'email' => 'required|unique:users,email',
				'mobile'=>'required',
				'password'=>'required'
			]);			
			
	          $admin = new Admin;
	          $admin->name = $request->name;			
			  $admin->email = $request->email;
			  $admin->mobile = $request->mobile; 
			  $admin->password =  bcrypt($request->password);
			  $admin->role_id = 2;		  	 
			  $admin->status = $request->status;
		      $admin->save();
		 
		 return redirect('/admin/admin')->with('message', 'User successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$admin=Admin::find($id);
        $countries= Country::where('status', 1)->get();      
        return view('admin.admin.admin_edit',compact('admin','countries'));
    }


    public function logs($id)
    {
		$userLogs = UserLogs::where('user_id',$id)->get();
        return view('admin.admin.view_log',compact('userLogs'));
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
				'name' => 'required',
                'mobile'=>'required',
				'email' => 'required|unique:users,email,'.$id

			]);
			
			
			
          $admin =Admin::find($id);
          $admin->name = $request->name;	  	  
		  $admin->email = $request->email;		  
		  $admin->mobile = $request->mobile; 
		
		  if($request->password!='')
		  {
		   $admin->password =  bcrypt($request->password);
		  }		 
		  $admin->status = $request->status;
		 
		  $admin->save();

		  
		 return redirect('/admin/admin')->with('message', 'User successfully updated!');
       }
     
	 public function downloadExcel()
		{		
			
			 return Excel::download(new AdminExport, 'admin.csv');
   
			
		}
		
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $admin =Admin::find($id);
		 $admin->delete();
		  return redirect('/admin/admin')->with('message', 'User successfully deleted!');
    }
	
    public function checkUniqueEmail(Request $request)
    {
		$email=$request->email;
		$admin=Admin::where('email',$email)->first();
		 
		if (!empty($admin)) {
		    
			  $reponse['status']=1;
	 	  
			  
			}else
			{
				 $reponse['status']=0;
			      
			}
			
			 return response()->json($reponse, 200);
			
		 
    }
	  public function checkUniquePhone(Request $request)
    {
		$phone=$request->phone;
		$admin=Admin::where('phone',$phone)->first();
		 
		if (!empty($admin)) {
		    
			  $reponse['status']=1;
	 	  
			  
			}else
			{
				 $reponse['status']=0;
			      
			}
			
			 return response()->json($reponse, 200);
			
		 
    }
}
