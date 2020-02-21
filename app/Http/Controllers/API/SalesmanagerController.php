<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Salesmanager;
use App\Admin\Salesperson;
use App\Admin\Saleslead;
use App\Admin\Country;
use App\Admin\PlanPrice;
use App\Admin\Plan;
use App\Admin\Admin;
use Redirect;
use Auth;
use Validator;
use Storage;

class SalesmanagerController extends Controller
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
			/* $data=DB::table('salesleads')
			->select('salesleads.id','salesleads.name','salesleads.email','salesleads.plan_name')
			->where("salesleads.admin_id",$request->user_id)
			->get()->toArray(); */
		 $data = Salesmanager::select('id','name','email','mobile')->where('admin_id',$request->user_id)->get()->toArray();	
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
	
	public function sales_leads(Request $request)
	{
		$Salesperson=Salesperson::where('admin_id',$request->user_id)->get()->toArray();		
		$Salesperson_ids = array_column($Salesperson, 'id');
		$data= Saleslead::select('salesleads.id','salesleads.name','salesleads.email','salesleads.plan_name')->whereIn('admin_id',$Salesperson_ids)->get();
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

	public function sales_leads_show(Request $request)
    {
			$data=Saleslead::select('salesleads.id','salesleads.name','salesleads.email','salesleads.mobile','salesleads.address','salesleads.status','salesleads.plan_name','salesleads.created_at','salesleads.package_name','salesleads.updated_at') 
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
	
	 public function sales_leads_edit(Request $request)
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
	
	
	public function sales_leads_update(Request $request)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $countries= Country::where('status', 1)->get();	     
          return view('admin.salesmanager.salesmanager_add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          	
				if($this->checkUniqueEmail($request->email))
				{
					$success['massege'] = "Email already Exits!";
					$success['status'] = 0;
					
				}
				else
				{
			
			  $adminid = $request->user_id;
	          $Salesperson = new Salesperson;
	          $Salesperson->name = $request->name;			
			  $Salesperson->email = $request->email;
			  $Salesperson->mobile = $request->mobile; 
			  $Salesperson->password =  bcrypt($request->password);
			  $Salesperson->role_id = 7;	
			  $Salesperson->admin_id = $adminid;		  	 
			  $Salesperson->status =1;
		     $data= $Salesperson->save();
			 if($data)
				{
				$success['status'] = 1;
				
				$success['massege'] = "Data Save";

				}
				else
				{
					$success['massege'] = "Data not Save!";
					$success['status'] = 0;
				}
				}
				return response()->json(['success' => $success], 200); 
		 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $data=Salesperson::select('id','name','email','mobile','status','created_at','updated_at') 
			->where("id",$request->id)
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$data=Salesperson::find($request->id);
            
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
      
			
			
			
          $Salesperson =Salesperson::find($request->id);
          $Salesperson->name = $request->name;	  	  
		  $Salesperson->email = $request->email;		  
		  $Salesperson->mobile = $request->mobile; 
		
		  if($request->password!='')
		  {
		   $Salesperson->password =  bcrypt($request->password);
		  }		 
		  $Salesperson->status = $request->status;
		 $Salesperson->updated_at = date('Y-m-d');
		 $data= $Salesperson->update();


		  
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
     
	
		
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $admin =Salesperson::find($id);
		 $data=$Salesperson->delete();
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

	public function checkUniquePhone(Request $request)
    {
		$phone=$request->phone;
		$admin=Admin::where('phone',$phone)->first();
		 
		
			
			if(!empty($admin))
			{
			$success['status'] = 1;
			
			$success['massege'] = "phone already Exits";

			}
			else
			{
				$success['massege'] = "phone Not Exits! ";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
			
		 
    }
	public function checkUniqueEmail($email)
    {
		
		$admin=Admin::where('email',$email)->first();
		 
		if(!empty($admin))
			{
			return 1;
			
			

			}
			else
			{
				
				return  0;
			}
				
          
			
		 
    }
	
	public function download(Request $request)
	{
		$auth=Auth::User();
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";

		$builder= Salesmanager::where('role_id', 7)
		 ->where('created_at','>=', $from)
		 ->where('created_at','<=',$to)
		 ->get()->toArray();
		 
	$fp = fopen('php://output', 'w');
   $flag=1;
    foreach ($builder as $value)
		{
			if( $flag==1)
			{
				$row[]='S.NO.';
				$row[]='Name';
				$row[]='Email';
				$row[]='Moble';
				
				$row[]='Register Date';
				fputcsv($fp, array_values($row));
				unset($row);
			}
				$row[]=$flag;
				$row[]=$value['name'];
				$row[]=$value['email'];
				$row[]=$value['mobile'];
				
				$row[]=$value['created_at'];
        fputcsv($fp, array_values($row));
		unset($row);
		$flag++;
		}
	header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Sales-Manager-report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
		 exit;
		 
		
		
	}
}
