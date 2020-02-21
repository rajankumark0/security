<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Saleslead;
use App\Admin\Plan;
use App\Admin\PlanPrice;
use App\Admin\Salesperson;

use Redirect; 
use Auth;
use Validator;
use Storage;
//use Intervention\Image\Facades\Image;
use DB;
class SalesleadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$auth=Auth::user();
		if($auth->role_id==1)
		{
			
		  $data['saleslead']= Saleslead::get();
		}
		elseif($auth->role_id==7)
		{
				$Salesperson=Salesperson::where('admin_id',$auth->id)->get()->toArray();		
				$Salesperson_ids = array_column($Salesperson, 'id');
			$Salesperson_ids[]=$auth->id;
			$data['saleslead']= Saleslead::whereIn('admin_id',$Salesperson_ids)->get();
		}
		else
		{
			$data['saleslead']= Saleslead::where('admin_id',$auth->id)->get();
		}
			
		 
		  
        return view('admin.saleslead.saleslead_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $data['plan']= Plan::where('status', 1)->get();     
          $data['package']= PlanPrice::where('status', 1)->get();   
			
          return view('admin.saleslead.saleslead_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			print_r($request)
			die;
           		exit;  
			$admin_id = Auth::user()->id;
	        $saleslead = new saleslead;
			$saleslead->name = $request->name; 
			$saleslead->email = $request->email; 
			$saleslead->mobile = $request->mobile; 
			$saleslead->package_name = $request->package_name; 
			$saleslead->plan_name = $request->plan_name;  
			$saleslead->address = $request->address;  
			$saleslead->admin_id = $admin_id; 
			$saleslead->status = 'Request'; 
			 
			  	
		    $saleslead->save();
		 
	
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
		$data['plan']= Plan::where('status', 1)->get();     
        $data['package']= PlanPrice::where('status', 1)->get(); 
		$data['saleslead']= Saleslead::find($id); 
	    //print_r($data['saleslead']);die;
        return view('admin.saleslead.saleslead_edit',$data);
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
				'email' => 'required',
				'mobile' => 'required',
				'package_name' => 'required',
				'plan_name' => 'required',
				'address' => 'required',
			]);
			
			$saleslead = Saleslead::find($id);
			$saleslead->name = $request->name; 
			$saleslead->email = $request->email; 
			$saleslead->mobile = $request->mobile; 
			$saleslead->package_name = $request->package_name; 
			$saleslead->plan_name = $request->plan_name; 
			$saleslead->address = $request->address; 
			$saleslead->status = $request->status; 
            $saleslead->updated_at = date('Y-m-d'); 
			$saleslead->update();

		  
		 return redirect('/admin/saleslead')->with('message', 'Saleslead successfully updated!');
       }
    public function show($id)
    {
          $data['plan']= Plan::where('status', 1)->get();     
          $data['package']= PlanPrice::where('status', 1)->get();   
		  $data['saleslead']= Saleslead::find($id); 
	   
	   return view('admin.saleslead.saleslead_view',$data);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $saleslead =Saleslead::find($id);
		 $saleslead->delete();
		  return redirect('/admin/saleslead')->with('message', 'Saleslead successfully deleted!');
    }
	
    
}
