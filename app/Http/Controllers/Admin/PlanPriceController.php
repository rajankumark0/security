<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\PlanPrice;
use App\Admin\Country;
use App\Admin\Plan;
use Redirect;
use Auth;
use Validator;
use Storage;
use DB;
class PlanPriceController extends Controller
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
		  $data['countries']= Country::where('status', 1)->get();
		  $data['planpricelist'] = 	DB::table('plans')
			->select('*')
			->join('plan_prices','plan_prices.plan_id','=','plans.id')->paginate(15); 
		 /*  $data['planpricelist'] = PlanPrice::getList($param);	
       		 echo "<pre>";
			 print_r( $data['planpricelist']);
			 die(); */
        return view('admin.plan_price.plan_price_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $plan= Plan::where('status', 1)->get();	     
          return view('admin.plan_price.plan_price_add',compact('plan'));
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
				'plan_id' => 'required',
				'duration_value' => 'required',
				'duration_name' => 'required',
				'price' => 'required'
				
			]);	
			
	          $planprice = new PlanPrice;
	          $planprice->plan_id = $request->plan_id;			
	          $planprice->duration_value = $request->duration_value;			
	          $planprice->duration_name = $request->duration_name;			
	          $planprice->price = $request->price;			
			  $planprice->status = $request->status; 
			  	
              				  
		      $planprice->save();
		 
		 return redirect('/admin/plan-price')->with('message', 'Plan successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*     public function show($id)
    {
       $planprice=Plan::leftJoin('users', function($join){ $join->on('planprices.added_by','=','users.id'); })
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
		$data['planprice']=PlanPrice::find($id);    
	
        return view('admin.plan_price.plan_price_edit',$data);
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
				'plan_id' => 'required',
				'duration_value' => 'required',
				'duration_name' => 'required',
				'price' => 'required'

			]);
			
			
			
			$planprice =PlanPrice::find($id);
			$planprice->plan_id = $request->plan_id;			
			$planprice->duration_value = $request->duration_value;			
			$planprice->duration_name = $request->duration_name;			
			$planprice->price = $request->price;				
			$planprice->status = $request->status; 
			$planprice->update();

		  
		 return redirect('/admin/plan-price')->with('message', 'Plan successfully updated!');
       }
     
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $planprice =Planprice::find($id);
		 $planprice->delete();
		  return redirect('/admin/plan-price')->with('message', 'Plan successfully deleted!');
    }
	
    
}
