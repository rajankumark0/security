<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Plan;
use App\Admin\Country;
use Redirect;
use Auth;
use Validator;
use Storage;

class PlanController extends Controller
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
		  $data['planlist'] = Plan::getList($param);	
       		 
         return view('admin.plan.plan_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $countries= Country::where('status', 1)->get();	     
          return view('admin.plan.plan_add',compact('countries'));
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
				'plan_name' => 'required'
				
			]);	
			
	          $plan = new Plan;
	          $plan->plan_name = $request->plan_name;			
	          $plan->gaurd = $request->gaurd;			
			  $plan->status = $request->status; 
			  	
              				  
		      $plan->save();
		 
		 return redirect('/admin/plan')->with('message', 'Plan successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*     public function show($id)
    {
       $plan=Plan::leftJoin('users', function($join){ $join->on('plans.added_by','=','users.id'); })
	            ->where('plans.id',$id)
	            ->first(['plans.*','users.name as uname']);
	   
	   return view('admin.plan.plan_view',compact('plan'));
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$plan=Plan::find($id);         
        return view('admin.plan.plan_edit',compact('plan'));
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
				'plan_name' => 'required'
                

			]);
			
			
			
			$plan =Plan::find($id);
			$plan->plan_name = $request->plan_name;	
			$plan->gaurd = $request->gaurd;	
			$plan->status = $request->status; 
			$plan->update();

		  
		 return redirect('/admin/plan')->with('message', 'Plan successfully updated!');
       }
     
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $plan =Plan::find($id);
		 $plan->delete();
		  return redirect('/admin/plan')->with('message', 'Plan successfully deleted!');
    }
	
    
}
