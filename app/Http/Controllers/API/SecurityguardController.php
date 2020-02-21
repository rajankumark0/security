<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Securityguard;
use App\Admin\Country;
use App\Admin\Visitor;
use App\Admin\Plan;
use Redirect;
use Auth;
use App\User;
use DB;
use Validator;
use Storage;
use App\Admin\PurchagePlan;

class SecurityguardController extends Controller
{
	public  $token;
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
		
		
		$date=date('Y-m-d');
		   $success['token']=$this->token;
		 /* if($this->token==$request->token) */
		 if(1)
		 {
			
			$visitors=Visitor::where('entry_date','=',$date)->where('added_by','=',$request->guard_id)->orderBy('id', 'desc')->get();	
			if(count($visitors)>0)
			{
				$success['massege'] = "Record Found";
				foreach($visitors as $visitor):
				
				$data['id'] = $visitor->id;
				$data['name'] = $visitor->name;
				$data['mobile'] =$visitor->mobile;
				$data['flat'] = $visitor->flat;
				$data['entry'] = $visitor->entry_time;
				if($visitor->exit_time )
				{
				$data['exit'] = $visitor->exit_time  ;
				}
				else
				{
					$data['exit'] = "--"  ;
				}
				$data['meet_person'] = $visitor->meet_person;
				
				if( ($visitor->entry_time!="" || $visitor->entry_date!="") && ($visitor->exit_time=="" || $visitor->exit_date=="")  )
				{

				$data['status'] = 0;

				}
				else
				{
					$data['status'] =1;
				}
					
				
				
				
				$success['status'] = 1;
				$success['data'][]=$data;
				
				
				endforeach;
				
			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 1;
			}
			
				
			
            return response()->json(['success' => $success], 200); 
			
		 }
		 else
		 {
			
			$success['massege'] = "Access Denied!";
			$success['status'] = 0;
            return response()->json(['success' => $success], 200); 
		 }
       
    }
	
	public function getvisitor(Request $request)
    {
		$visitor=Visitor::where('mobile','=',$request->mobile)->orderBy('id', 'desc')->first();
		
		
		
		
		if(!empty($visitor))
		{
			
			
		if($visitor->vip_visitor=="yes" && $visitor->vip_status!="Unaproved")
		{
			$success['data']['id'] = $visitor->id;
			$success['data']['name'] = $visitor->name;
			$success['data']['mobile'] =$visitor->mobile;
			$success['data']['status'] =2;
			
		}
		else
			{	
				$success['data']['massege'] = "Record Found";
				$success['data']['id'] = $visitor->id;
				$success['data']['name'] = $visitor->name;
				$success['data']['mobile'] =$visitor->mobile;
				$success['data']['flat'] = $visitor->flat;
				$success['data']['meet_person'] =$visitor->meet_person;
				$success['data']['entry_time'] =$visitor->entry_time;
				if($visitor->entry_time)
				{
					$success['data']['exit_time'] =$visitor->exit_time;
				}
				else
				{
					$success['data']['exit_time'] ='--';
				}
				
				
				if( ($visitor->entry_time!="" || $visitor->entry_date!="") && ($visitor->exit_time=="" || $visitor->exit_date=="")  )
				{
					$success['data']['status'] = 0;
				}
				else
				{
					$success['data']['status'] = 1;
				}
			}
			$success['status'] =1;
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
    public function create()
    {
		 $countries= Country::where('status', 1)->get();	     
         return view('admin.securityguard.securityguard_add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
		$date=date("Y-m-d");
		$time=date("H:i A");
		$gaurd=USER::find($request->guard_id);
		$adminid =$gaurd->admin_id;
		$purchageplane= PurchagePlan::where('user_id', $adminid)->orderBy('id', 'desc')->first();
		$Plane=Plan::find($purchageplane->plan_id);
		$datd=array();
		$vistor_data=Visitor::find($request->vistor_id);
		if($request->vistor_id)
		{
			
			
				$visitor=new Visitor;
				$visitor->mobile = $vistor_data->mobile;
				$visitor->name = $vistor_data->name;
				$visitor->email = $vistor_data->email;
				$visitor->vehicle_no = $vistor_data->vehicle_no;
				$visitor->flat = $request->flat;
				$visitor->meet_person = $request->meet_person;
				$visitor->meet_person = $date;
				$visitor->entry_time = $time;
				$visitor->entry_date = $date;
				$visitor->added_by = $request->guard_id;
				if($Plane->category=="premium")
				{
					$visitor->flat_response = 1;
								
				}
				else
				{
					$visitor->flat_response = 0;
				}
				
				if($visitor->save())
				{
				$datd['flat_response']=1;
				$datd['status']=1;
				$datd['visitor_id']=$visitor->id;
				$datd['massege']='waiting for respons';
				}
				else
				{
					$datd['status']=0;
					$datd['massege']='Data not save';
				}
			
		}
		else
		{
			
				$visitor=new Visitor;
				$visitor->mobile = $request->mobile;
				$visitor->name = $request->name;
				$visitor->email = $request->email;
				$visitor->vehicle_no = $request->vehicle_no;
				$visitor->flat = $request->flat;
				$visitor->meet_person = $request->meet_person;
				$visitor->added_by = $request->guard_id;
				$visitor->image = $request->image;
				$visitor->entry_date = $date;
				$visitor->entry_time = $time;
				
				if($Plane->category=="premium")
				{
					$visitor->flat_response = 1;
								
				}
				else
				{
					$visitor->flat_response = 0;
				}
				
				if($visitor->save())
				{
				$datd['flat_response']=1;
				$datd['status']=1;
				$datd['visitor_id']=$visitor->id;
				$datd['massege']='waiting for respons';
				}
				else
				{
					$datd['status']=0;
					$datd['massege']='Data not save';
				}
		}
		if(!empty($datd))
		{
			$success['status']=1;
			$success['data']=$datd;
		}
		else
		{
			$success['status']=0;
		}

	 return response()->json(['success' => $success], 200);
		  
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

public function getflatlist(Request $request)
{
	$user=USER::find($request->id);
	$flat=DB::table('users')->select('users.id' , 'users.name')->where('role_id',5)->where("admin_id",$user->admin_id)->orderBy('id', 'desc')->get();
	if(empty($flat))
	{
		 $success['flatlist']=$flat;
		 $success['success']=1;
		
	}
	else
	{
		 $success['flatlist']=$flat;
		 $success['success']=0;
		 $success['massege']="Data Not Found";
		
	}
		 return response()->json(['success' => $success], 200);
	
}


public function getresponse(Request $request)
{
	$vistor_data=Visitor::find($request->vistor_id);
	
	if(!empty($vistor_data))
	{
		if($vistor_data->flat_response==1)
		{
		 $success['flat_response']=$vistor_data->flat_response;
		 $success['success']=1;
		
		}
		else
		{
			$success['flat_response']=$vistor_data->flat_response;
			 $success['success']=1;
		}
	}
	else
	{
		$success['flat_response']=3;
		 $success['success']=0;
		 $success['massege']="Data Not Found";
		
	}
		 return response()->json(['success' => $success], 200);
	
}

public function flatresponse(Request $request)
{
	
	
		$Visitor =Visitor::find($request->vistor_id);
        
		if($request->flat_response==2)
		{
			 $Visitor->flat_response = $request->flat_response;
			$Visitor->save();
			
		}
		else
		{
			$Visitor->delete();
		}
		
		$success['flat_response']=$request->flat_response;
		$success['success']=1;
		$success['message']="data update";
		return response()->json(['success' => $success], 200);
	
}

public function flatvisitorlist(Request $request)
{
	
	
			$visitors=Visitor::where('flat','=',$request->id)->orderBy('id', 'desc')->get();	
			if(count($visitors)>0)
			{
				$success['massege'] = "Record Found";
				foreach($visitors as $visitor):
				
				$data['id'] = $visitor->id;
				$data['name'] = $visitor->name;
				$data['mobile'] =$visitor->mobile;
				$data['flat'] = $visitor->flat;
				$data['flat_response'] = $visitor->flat_response;
				$data['meet_person'] = $visitor->meet_person;
				$data['entry_date'] = $visitor->entry_date;
				$data['entry_time'] = $visitor->entry_time  ;
				
				if( ($visitor->entry_time!="" || $visitor->entry_date!="") && ($visitor->exit_time=="" || $visitor->exit_date=="")  )
				{
					$data['status'] = 0;
				}
				else
				{
					$data['status'] = 1;
				}
               		
				$success['data'][]=$data;
				endforeach;
				
				$success['status'] = 1;
				
				
			}
			else
			{
				$success['massege'] = "Record Not Found";
				$success['status'] = 1;
			}
			
				
			
            return response()->json(['success' => $success], 200); 
			
		
	
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$admin=Securityguard::find($id);
        $countries= Country::where('status', 1)->get();      
        return view('admin.securityguard.securityguard_edit',compact('admin','countries'));
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
    public function update(Request $request)
    {
       	
			$date=date("Y-m-d");
			$time=date("H:i A");
			
			
          $Visitor =Visitor::find($request->id);
          $Visitor->exit_date = $date;	  	  
		  $Visitor->exit_time = $time;		  
		  
		  if($Visitor->save())
		  {
			$success['massege'] = "Successfully Exit";
			$success['status'] = 1;
		  }
		  else
		  {
			$success['massege'] = "Successfully Exit";
			$success['status'] = 1;
		  }
		 
			return response()->json(['success' => $success], 200);
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
         $admin =Securityguard::find($id);
		 $admin->delete();
		  return redirect('/admin/security-guard')->with('message', 'User successfully deleted!');
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
