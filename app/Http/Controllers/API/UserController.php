<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Admin\Kyc;
use Illuminate\Support\Facades\Session;
use Storage;
use DB;
use DateTime;
use App\Admin\PurchagePlan;
use App\Admin\Plan;
use App\Admin\PlanPrice;

class UserController extends Controller 
{
	public function __construct()
		{
			header("Access-Control-Allow-Origin: *");
			
		}
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
	

        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'status' => 1])){ 
            $user = Auth::user();
			$success['id'] = $user->id;
			$success['name'] = $user->name;
			$success['email'] = $user->email;
			$success['mobile'] = $user->mobile;
			$success['role'] = $user->role_id;
			$success['status'] = 1;
			$success['massege'] = "success";
			
			$menulist=array();
			if($user->role_id==6)
			{
				/* $menulist[0]['page']='add-sales-lead.html';
				$menulist[0]['label']='Add Sales Lead';
				$menulist[0]['icone']='images/visitors.png'; 
				$menulist[1]['page']='sales-lead-listing.html';
				$menulist[1]['label']='Sales Lead Listing';
				$menulist[1]['icone']='images/visitors.png'; */
				
				$menulist[2]['page']='add-bilder-owner.html';
				$menulist[2]['label']='Add Sales Lead';
				$menulist[2]['icone']='images/visitors.png';
			
				
			}
			elseif($user->role_id==5)
			{
			$menulist[0]['page']='visitors-list.html';
			$menulist[0]['label']='Visitors LIST';
			$menulist[0]['icone']='images/visitors.png';

			/* $menulist[1]['page']='visitors-add.html';
			$menulist[1]['label']='Visitors Add';
			$menulist[1]['icone']='images/visitors.png'; */
			}
			elseif($user->role_id==7)
			{
				$menulist[0]['page']='add-sales-person.html';
				$menulist[0]['label']='Add Sales Person';
				$menulist[0]['icone']='images/visitors.png';
				
				$menulist[1]['page']='sales-person-listing.html';
				$menulist[1]['label']='Sales Person Listing';
				$menulist[1]['icone']='images/visitors.png';
				
				$menulist[2]['page']='sales-lead-listing.html';
				$menulist[2]['label']='Sales Lead Listing';
				$menulist[2]['icone']='images/visitors.png';
			}
			elseif($user->role_id==4)
			{
				$menulist[0]['page']='security-guard.html';
				$menulist[0]['label']='Security Guard';
				$menulist[0]['icone']='images/visitors.png';
				
				$menulist[1]['page']='flat-owner.html';
				$menulist[1]['label']='Flat Owner';
				$menulist[1]['icone']='images/visitors.png';
				
				$menulist[2]['page']='complaint-list.html';
				$menulist[2]['label']='Complaint List';
				$menulist[2]['icone']='images/visitors.png';
				
				$menulist[3]['page']='purchase-plan.html';
				$menulist[3]['label']='Purchase Plan';
				$menulist[3]['icone']='images/visitors.png';
			}
			
			$menulist[4]['page']='profile.html';
			$menulist[4]['label']='Profile';
			$menulist[4]['icone']='images/user-app1.png';
			
			$menulist[5]['page']='resetpassword.html';
			$menulist[5]['label']='Change Password';
			$menulist[5]['icone']='images/lock.png';
			
			if($user->role_id==7)
			{
				
				$success['massege'] = "Access Denied!";
				$success['status'] = 0;
				return response()->json(['success' => $success], 200); 
				exit();
			}
			
			if($user->role_id==4)
			{
				$data=Kyc::where('user_id',$user->id)->count();
				if(!$data)
				{
					$success['massege'] = "Kyc Not complete!";
					$success['status'] = 3;
					return response()->json(['success' => $success], 200); 
					exit();
				}
			}
			
				$success['menulist'] = $menulist;
				$success['status'] = 1;
				$success['token'] =  $user->createToken('MyApp')-> accessToken; 
				return response()->json(['success' => $success], $this-> successStatus); 
			
        } 
        else
		{ 
			$success['massege'] = "Worn Creadentials or account not verified!";
			$success['status'] = 0;
            return response()->json(['success' => $success], 200); 
        } 
    }
	
	
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function registeruser(Request $request) 
    { 

		 
			$data=User::where('email',$request->email)->count();
			
			if($data>0)
			{
				$success['massege'] = "Email Id Already Exits!";
				$success['status'] = 0;
			}
			else
			{
				
			$User = new User;	  	  
			$User->name = $request->name;	  	  
			$User->email = $request->email;		  
			$User->mobile = $request->mobile; 
			$User->role_id = 4;
			$User->status = 1;
			$User->admin_id = ($request->user_id)?$request->user_id:27;
			$User->password =  bcrypt($request->password);
			$Users= $User->save();
				if($Users)
				{
					$success['status'] = 1;
					$success['user_id'] = $User->id;
					$success['massege'] = "User Successfully Created!";					

				}
				else
				{
					$success['massege'] = "Oops.. Something wrong! try again!";
					$success['status'] = 0;
				}
			}	

		return response()->json(['success'=>$success], $this-> successStatus); 
    }
/*   
	 * 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
	 *
*/ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
	
	 public function edit(Request $request) 
    { 
       $data=User::find($request->id);
            
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
	
	public function update(Request $request) 
    { 
			$User =User::find($request->user_id);

			$User->name = $request->name;	  	  
			$User->email = $request->email;		  
			$User->mobile = $request->mobile; 

			if($request->password!='')
			{
			$User->password =  bcrypt($request->password);
			}		 
			$User->status = $request->status;
			$User->updated_at = date('Y-m-d');
			$data= $User->update();


		  
		  if($data)
			{
			$success['status'] = 1;
			
			$success['massege'] = "Profile successfully updated please logout and login again to view updated!";

			}
			else
			{
				$success['massege'] = "Profile not Update!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200);  
    }

	public function view(Request $request) 
    { 
        $data=User::select('id','name','email','mobile','status','created_at','updated_at') 
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

	 public function change_password(Request $request) 
    { 
			
			
			$User =User::find($request->user_id);
			
			if(empty($User))
			{
				$success['massege'] = "User Id not Exits!";
				$success['status'] = 0;
			}
			elseif($request->password!=$request->c_password)
			{			
				$success['massege'] = "Confirm Password not Match!";
				$success['status'] = 0;
			}
			else
			{
				
				$User->password =  bcrypt($request->password);
				$User->updated_at = date('Y-m-d');
				$data= $User->update();
				$success['status'] = 1;
			$success['massege'] = "Password Successfully Update!";
			}

		  
		  
			
				
            return response()->json(['success' => $success], 200);  
    }
	
	public function sendotp(Request $request) 
    { 
	
		$data=User::where('email',$request->email)->count();
			
			if($data>0)
			{
				$success['massege'] = "Email Id Already Exits!";
				$success['status'] = 0;
			}
			else
			{
        $otp=rand(10000,99999);
		
			$to = $request->email;
			$subject = "OTP fo registration!";
			$txt = "You OTP $otp ";
			$headers = "From: WPS <mails@wps-dev.com>" . "\r\n";
			
			$data=mail($to,$subject,$txt,$headers);
			
			  if($data)
				{
				$success['status'] = 1;
				$success['data'] = $otp;
				$success['massege'] = "OTP has been send on your Email.";

				}
				else
				{
					$success['massege'] = "OTP not been send!";
					$success['status'] = 0;
				}
			}
            return response()->json(['success' => $success], 200); 
    } 
	
	public function verifyotp(Request $request) 
    { 
        
		$otp=Session::get('otp');
		echo $otp;
		  if($otp)
			{
			$success['status'] = 1;
			$success['massege'] = "Success";

			}
			else
			{
				$success['massege'] = "Invalid OTP!";
				$success['status'] = 0;
			}
				
            return response()->json(['success' => $success], 200); 
    } 
	public function kycsave(Request $request) 
    { 
        
			
	        $Kyc = new Kyc;
			$Kyc->user_id =$request->user_id; 
			$Kyc->company_name = $request->company_name; 
			$Kyc->postal_address = $request->postal_address; 
			$Kyc->physical_addess = $request->physical_addess; 
			$Kyc->phone_no =  $request->phone_no; 
			$Kyc->contact_name = $request->contact_name; 
			$Kyc->contact_person = $request->contact_person; 
			$Kyc->contact_mobile = $request->contact_mobile; 
			$Kyc->contact_email = $request->contact_email; 
			$Kyc->name_builing = $request->name_builing; 
			$Kyc->location_lr_no = $request->location_lr_no; 
			$Kyc->street = $request->street; 
			$Kyc->company_status = $request->company_status; 
			
			
		$userid=$request->user_id;	
		$pdate=date("d-m-Y");
		$edate=date('d-m-Y',strtotime("+14 day")); 
		$packages= PlanPrice::where('id',14)->get()->first();
		$Plan= Plan::find($packages->plan_id);
		$PurchagePlan= PurchagePlan::where('user_id',$userid)->count();
		
		
		if($PurchagePlan<1)
		{
		$data['plan_id']=$packages->plan_id;
		$data['duration_value']=$packages->duration_value;
		$data['duration_name']=$packages->duration_name;
		$data['price']=$packages->price;
		$data['payment_status']="failed";
		$data['payment_data']='';
		$data['user_id']=$userid ;
		$data['purchage_date']=$pdate;
		$data['package_id']=$packages->id;
		$data['expire_date']=$edate;
		$data['status']="active";
		$data['no_of_security']=$Plan->gaurd;
		$data['purchage_type']="Trial";
		DB::table('purchage_plans')->insert($data);
		
		$data['purchage_type']="Trial";
		DB::table('purchage_log')->insert($data);
			$to = $user->email;
		$subject = "Trail Plan";
		$txt = "Hello, ".$user->name ."thank you for complete your KYC. \n 14 day Trail Plan actived in account!";
		$headers = "From: info@wps-dev-com" . "\r\n" ;
		
		mail($to,$subject,$txt,$headers);
		}	
		  if($Kyc->save())
			{
				$success['status'] = 1;
				$success['massege'] = "Success";

			}
			else
			{
				$success['massege'] = "Try again!";
				$success['status'] = 0;
			}
			
            return response()->json(['success' => $success], 200); 
    } 

}