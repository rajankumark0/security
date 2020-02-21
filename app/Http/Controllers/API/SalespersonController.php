<?php

namespace App\Http\Controllers\API;

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
class SalespersonController extends Controller
{
	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
		/* $user=Auth::user();
     $this->token=$user->createToken('MyApp')-> accessToken;  */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
	$data=DB::table('salesleads')
	->select('salesleads.id','salesleads.name','salesleads.email','salesleads.plan_name')
	->where("salesleads.admin_id",$request->user_id)
	->get()->toArray();
		  if(count($data)>0)
			{
			$success['status'] = 1;
			$success['data'] = $data;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);  
       
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getplans()
    {
    $data=DB::table('plans')
	->select('plans.id','plans.plan_name')
	->where("plans.status",'1')
	->get()->toArray();
		  if(count($data)>0)
			{
			$success['status'] = 1;
			$success['data'] = $data;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
    }
	
	public function getpackage()
    {
    $data=DB::table('plan_prices')
	->select('plan_prices.id','plan_prices.duration_name as package_name')
	->where("plan_prices.status",'1')
	->get()->toArray();
		  if(count($data)>0)
			{
			$success['status'] = 1;
			$success['data'] = $data;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		
		

			$Plan=Plan::find($request->plan_id);
			$PlanPrice=PlanPrice::find($request->package_id);
			$saleslead = new saleslead;
			$saleslead->name = $request->name; 
			$saleslead->email = $request->email; 
			$saleslead->mobile = $request->mobile; 
			$saleslead->package_name = $PlanPrice->duration_name; 
			$saleslead->plan_name = $Plan->plan_name;  
			$saleslead->address = $request->address;  
			$saleslead->admin_id = $request->user_id; 
			$saleslead->status = 'Request'; 
			 
			  	
		   $data= $saleslead->save();
		 if($data)
			{
			$success['status'] = 1;
			
			$success['massege'] = "Data Save";

			}
			else
			{
				$success['massege'] = "Data not save!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
		
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
    public function edit(Request $request)
    {
		$data['plan']= Plan::where('status', 1)->get();     
        $data['package']= PlanPrice::where('status', 1)->get()->toArray(); 
		$data['saleslead']= Saleslead::find($request->id); 
	    if($data)
			{
			$success['status'] = 1;
			$success['data'] = $data;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
    }


  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
			$Plan=Plan::find($request->plan_id);
			$PlanPrice=PlanPrice::find($request->package_id);
			
			$saleslead = Saleslead::find($request->id);
			$saleslead->name = $request->name; 
			$saleslead->email = $request->email; 
			$saleslead->mobile = $request->mobile; 
			$saleslead->package_name = $PlanPrice->duration_name; 
			$saleslead->plan_name = $Plan->plan_name;  
			$saleslead->address = $request->address;  
			$saleslead->admin_id = $request->user_id; 
			
            $saleslead->updated_at = date('Y-m-d'); 
			$data=$saleslead->update();

		  
		  if($data)
			{
			$success['status'] = 1;
			
			$success['massege'] = "Data Update";

			}
			else
			{
				$success['massege'] = "Data not Update!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
       }
    public function show(Request $request)
    {
			$data=DB::table('salesleads')
			->select('salesleads.id','salesleads.name','salesleads.email','salesleads.mobile','salesleads.address','salesleads.status','salesleads.plan_name','salesleads.created_at','salesleads.package_name','salesleads.updated_at') 
			->where("salesleads.id",$request->id)
			->get()->first();
		
		  if($data)
			{
			$success['status'] = 1;
			$success['data'] = $data;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
		 $saleslead =Saleslead::find($request->id);
		$data= $saleslead->delete();
		  if($data)
			{
			$success['status'] = 1;
			
			$success['massege'] = "Successfully Deleted ";

			}
			else
			{
				$success['massege'] = "Error occure ! Try again! ";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);  
    }
	
	
    
}
