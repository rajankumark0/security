<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Buildingowner;
use App\Admin\Securityguard;
use App\Admin\Flatofficeowner;
use App\Admin\Complaint;
use App\Admin\Country;
use App\Admin\Admin;
use App\Admin\Visitor;
use Redirect;
use Auth;
use DB;
use Validator;
use Storage;
use App\Admin\PurchagePlan;

class BuildingownerController extends Controller
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
			$id=$request->user_id;
			$data['total_visitor']=Visitor::Where('added_by',$id)->count();
			$data['total_securtitygard']=Admin::Where(['role_id'=>3,'admin_id'=>$id])->count();	
			$data['flats']=Admin::Where(['role_id'=>5,'admin_id'=>$id])->count();	
			$data['totol_vip']=Visitor::Where(['vip_visitor'=>'yes','added_by'=>$id])->count();
		
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

/* ----------------------- Flat owner ---------------------------- */
	
	public function flatlists(Request $request)
    {
		  
	
		$flats=Admin::Where(['role_id'=>5,'admin_id'=>$request->user_id])->get()->toArray();
       if(count($flats)>0)
			{
			$success['status'] = 1;
			$success['data'] = $flats;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
    }
	
	public function flatshow(Request $request)
    {
		$admin=Flatofficeowner::find($request->id);
             
        if(!empty($admin)>0)
			{
			$success['status'] = 1;
			$success['data'] = $admin;
			$success['massege'] = "Record  Found";

			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
    }

	
	
	public function flatstore(Request $request)
    {	
			
			$count= PurchagePlan::where('email', $request->email)->count();
			
			if($count<1)
			{
			
			
	          $flatofficeowner = new Flatofficeowner;
	          $flatofficeowner->name = $request->name;			
			  $flatofficeowner->floor_no = $request->floor_no;
			  $flatofficeowner->email = $request->email;
			  $flatofficeowner->mobile = $request->mobile; 
			  $flatofficeowner->password =  bcrypt($request->password);
			  $flatofficeowner->role_id = 5;	
			  $flatofficeowner->admin_id = $request->user_id;		  	 
			  $flatofficeowner->status = $request->status;
			if($flatofficeowner->save())
			{
				$success['status'] = 1;
				//$success['data'] = $data;
				$success['massege'] = "Flat owner successfully added!";

			}
			else 
			{
				$success['massege'] = "Oops.. try again!";
				$success['status'] = 0;
			}
			}	
			else
			{
				$success['massege'] = "Email Id already Exits!";
				$success['status'] = 0;
			}
            return response()->json(['success' => $success], 200); 
		
    }
	
	public function flatupdate(Request $request)
    {
  
			
			
			
          $flatofficeowner =Flatofficeowner::find($request->id);
          $flatofficeowner->name = $request->name;	  	  
		  //$flatofficeowner->email = $request->email;		  
		  $flatofficeowner->mobile = $request->mobile; 
		  $flatofficeowner->floor_no = $request->floor_no;
		  if($request->password!='')
		  {
		   $flatofficeowner->password =  bcrypt($request->password);
		  }		 
		  $flatofficeowner->status = $request->status;
		 
		  

		  
		 if($flatofficeowner->save())
			{
				$success['status'] = 1;
				//$success['data'] = $data;
				$success['massege'] = "Flat owner successfully Updated!";

			}
			else 
			{
				$success['massege'] = "Flat owner Not Updated. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
       }
	   
	   
	   public function flatdestroy(Request $request)
		{
		 $admin =Flatofficeowner::find($request->id);
			if( $admin->delete())
			{
				$success['status'] = 1;
				$success['massege'] = "Security guard  successfully Deleted!";

			}
			else 
			{
				$success['massege'] = "Security guard  Not Deleted. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
		} 
	   
	   /* ----------------   ends-------------- */
	   
	   
	   
/* -------------------------- Securityguard --------------------------- */
	   
	 	public function gardlists(Request $request)
		{
		
			$adminlist=Admin::Where(['role_id'=>3,'admin_id'=>$request->user_id])->get()->toArray();
			if(count($adminlist)>0)
			{
				$success['status'] = 1;
				$success['data'] = $adminlist;
				$success['massege'] = "Record  Found";
			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}

			return response()->json(['success' => $success], 200); 

		}
		
		public function gardshow(Request $request)
		{
			$admin=Securityguard::find($request->id);
			   
			if(!empty($admin) )
			{
				$success['status'] = 1;
				$success['data'] = $admin;
				$success['massege'] = "Record  Found";
			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}

			return response()->json(['success' => $success], 200); 
		}
		
		
		public function gardstore(Request $request)
		{
			$flag=1;
			$adminid = $request->user_id;
			$purchageplane= PurchagePlan::where('user_id', $adminid)->first();
			$Securityguard= Securityguard::where(array('admin_id'=> $adminid,'role_id'=> 3))->get();
			if(empty($purchageplane))
			{
			 $msg='You Dont Have any Purchage Plan!';
			 $flag=0;
			 $success['status'] = 1;
			}

			if(count($Securityguard)>=$purchageplane->no_of_security)
			{
			$msg='Adding Securityguard limit cross!';
			$flag=0;
			$success['status'] = 0;

			}

				
			
			if($flag)
			{

			$securityguard = new Securityguard;
			$securityguard->name = $request->name;			
			$securityguard->email = $request->email;
			$securityguard->mobile = $request->mobile; 
			$securityguard->password =  bcrypt($request->password);
			$securityguard->role_id = 3;		  	 
			$securityguard->admin_id = $adminid;		  	 
			$securityguard->status = $request->status;
			$count= Securityguard::where('email', $request->email)->count();
			
			if($count>0)
			{
				$success['status'] = 0;
				$msg= "Email id already Exits!";
			
			}
			 else
			{
				
					
				$securityguard->save();
			
			$success['status'] = 1;
			//$success['data'] = $data;
			$msg= "Security guard successfully added!";
				
			}
			
			}
			
			$success['massege'] =$msg;
			return response()->json(['success' => $success], 200); 

		}
		
		
		public function gardupdate(Request $request)
		{
			

			$securityguard =Securityguard::find($request->id);
			$securityguard->name = $request->name;	  	  
			$securityguard->email = $request->email;		  
			$securityguard->mobile = $request->mobile; 

			if($request->password!='')
			{
			$securityguard->password =  bcrypt($request->password);
			}		 
			$securityguard->status = $request->status;

			//$securityguard->save();
			
			
			if($securityguard->save())
			{
				$success['status'] = 1;
				//$success['data'] = $data;
				$success['massege'] = "Security guard  successfully Updated!";

			}
			else 
			{
				$success['massege'] = "Security guard  Not Updated. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);

			
		}
		
		public function garddestroy(Request $request)
		{
		 $admin =Securityguard::find($request->id);
			if( $admin->delete())
			{
				$success['status'] = 1;
				$success['massege'] = "Security guard  successfully Deleted!";

			}
			else 
			{
				$success['massege'] = "Security guard  Not Deleted. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
		} 
     
/* ---------------------------ends---------------------------- */

/* -------------------Complaint-------------------------- */
	public function complaintlists(Request $request)
    {
		$complaint= Complaint::Where('user_id',$request->user_id)->orWhere('complaint_to', $request->user_id)->get();
			if(count($complaint)>0)
			{
				$success['status'] = 1;
				$success['data'] = $complaint;
				$success['massege'] = "Record  Found";
			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 0;
			}

			return response()->json(['success' => $success], 200); 
	
	}
	
	public function complaintstore(Request $request)
    {

             $validatedData = $request->validate([	        
				'subject' => 'required',
				'complaint' => 'required'
			
				
			]);
			$admin=Admin::Where(['admin_id'=>$request->user_id])->first();			
			$user_id = $admin->id;
			$user_name = $admin->name;
			$user_email = $admin->email;
			$user_mobile = $admin->mobile;
			$complaint_to = $admin->admin_id;
					  
	        $complaint = new Complaint;
			$complaint->user_id = $user_id; 
			$complaint->name = $user_name; 
			$complaint->email = $user_email; 
			$complaint->mobile = $user_mobile; 
			$complaint->subject = $request->subject; 
			$complaint->complaint = $request->complaint; 
			$complaint->complaint_to = $complaint_to; 
			$complaint->status = 'Request'; 
			
		 if($complaint->save())
			{
				$success['status'] = 1;
				//$success['data'] = $data;
				$success['massege'] = "Complaint successfully Added!";

			}
			else 
			{
				$success['massege'] = "Complaint Not Added. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);

    }
	
	public function complaintshow(Request $request)
    {

	   $complaint= Complaint::find($request->id); 
	   
		if(!empty($complaint) )
		{
			$success['status'] = 1;
			$success['data'] = $complaint;
			$success['massege'] = "Record  Found";
		}
		else
		{
			$success['massege'] = "Record Not Found";
			$success['status'] = 0;
		}

		return response()->json(['success' => $success], 200);
    }
	
		public function complaintupdate(Request $request)
		{
		$validatedData = $request->validate([
				'subject' => 'required',
				'complaint' => 'required',
				'status' => 'required'
			]);
			
					 


			
			$complaint = Complaint::find($request->id);
			$complaint->subject = $request->subject;			
			$complaint->complaint = $request->complaint;			
			$complaint->status = $request->status; 
			$complaint->update();

		  if($complaint->save())
			{
				$success['status'] = 1;
				//$success['data'] = $data;
				$success['massege'] = "Complaint successfully Updated!";

			}
			else 
			{
				$success['massege'] = "Complaint Not Updated. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
		}
		
		public function complaintdelete(Request $request)
		{
		 $admin =Complaint::find($request->id);
			if( $admin->delete())
			{
				$success['status'] = 1;
				$success['massege'] = "Complaint successfully Deleted!";

			}
			else 
			{
				$success['massege'] = "Complaint  Not Deleted. Try Again!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);
		} 
		

/* ------------------- ends --------------------- */


/* ------------------- purchase plane --------------------- */
    public function purchaseplans(Request $request)
    {
		
		
			 $purchagelist  = 	DB::table('plans')
			->select('purchage_plans.id',
					 'plans.plan_name',
					 'plan_prices.duration_name as package_name',
					 'plan_prices.duration_value as duration',
					 'purchage_plans.price',
					 'purchage_plans.no_of_security',
					 'purchage_plans.purchage_date',
					 'purchage_plans.expire_date',
					 'purchage_plans.status',
					 'purchage_plans.payment_status',
			
					)
			->join('purchage_plans','plans.id','=','purchage_plans.plan_id')
			->join('plan_prices','plans.id','=','plan_prices.plan_id')
			->where('user_id','=',$request->user_id)->first();
		if(!empty( $purchagelist ))
		{
			$success['status'] = 1;
			$success['data'] =  $purchagelist ;
			$success['massege'] = "Record  Found";
		}
		else
		{
			$success['massege'] = "Record Not Found";
			$success['status'] = 0;
		}

		return response()->json(['success' => $success], 200);
       		

       
    } 

/* ------------------- ends --------------------- */



}
