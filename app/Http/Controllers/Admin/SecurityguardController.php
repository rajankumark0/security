<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Securityguard;
use App\Admin\Country;
use Redirect;
use Auth;
use Validator;
use Storage;
use App\Admin\PurchagePlan;

class SecurityguardController extends Controller
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
		 $data['adminlist'] = Securityguard::getAdminList($param);	
         $data['totalAdminlist'] = Securityguard::getAdminCount();			 
         return view('admin.securityguard.securityguard_list',$data);
       
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
    public function store(Request $request)
    {
			$adminid = Auth::user()->id;
			$purchageplane= PurchagePlan::where('user_id', $adminid)->first();
			$Securityguard= Securityguard::where(array('admin_id'=> $adminid,'role_id'=> 3))->get();
			if(empty($purchageplane))
			{
				 return redirect('/admin/security-guard')->with('message', 'You Dont Have any Purchage Plan!');
				 
			}
			
			if(count($Securityguard)==$purchageplane->no_of_security)
			{
				 return redirect('/admin/security-guard')->with('message', 'Adding Securityguard limit cross!');
			exit;
			
			}
		
            $validatedData = $request->validate([	        
				'name' => 'required',
				'email' => 'required|unique:users,email',
				'mobile'=>'required',
				'password'=>'required'
			]);			
			
			
	          $securityguard = new Securityguard;
	          $securityguard->name = $request->name;			
			  $securityguard->email = $request->email;
			  $securityguard->mobile = $request->mobile; 
			  $securityguard->password =  bcrypt($request->password);
			  $securityguard->role_id = 3;		  	 
			  $securityguard->admin_id = $adminid;		  	 
			  $securityguard->status = $request->status;
		      $securityguard->save();
		   $sub="Login Credential!";
			  $msg.="user name : ".$request->email ."\n";
			  $msg.="password : ".$request->password;
			  $this->sendmail($request->email,$sub, $msg);
		 return redirect('/admin/security-guard')->with('message', 'User successfully created!');
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
				'name' => 'required',
                'mobile'=>'required',
				'email' => 'required|unique:users,email,'.$id

			]);		
			
          $securityguard =Securityguard::find($id);
          $securityguard->name = $request->name;	  	  
		  $securityguard->email = $request->email;		  
		  $securityguard->mobile = $request->mobile; 
		
		  if($request->password!='')
		  {
		   $securityguard->password =  bcrypt($request->password);
		  }		 
		  $securityguard->status = $request->status;
		 
		  $securityguard->save();

		  
		 return redirect('/admin/security-guard')->with('message', 'User successfully updated!');
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
	
	public function download(Request $request)
	{
		$auth=Auth::User();
		
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";

		$builder= Securityguard::where('role_id', 3)
		 ->where('created_at','>=', $from)
		 ->where('created_at','<=',$to);
		if($auth->role_id!=1)
		{
		$builder->where('admin_id','=',$auth->id);
		}
			
		$builder=$builder ->get()->toArray();
		 
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
	
	public function sendmail($to,$subject,$msg)
	{
			$headers = "From:Security Gaurd <info@wps-dev-com>" . "\r\n" ;
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			mail($to,$subject,$msg,$headers);
	}
}
