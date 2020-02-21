<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Admin\Visitor;
use App\Admin\Kyc;
use App\Admin\Admin;
use App\Admin\Saleslead;
use App\Helpers\Helper;
use Session;
use Redirect;
use Storage;
use Auth;
use Validator;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$condition="";
		if(!empty($_GET['filter']))
		{
			
			if($_GET['filter']=="monthly")
			{
				$week=date("Y-m-d", strtotime('monday this week'));
				$condition="'created_at','>','$week. 00:00:00'"; 
			}
			elseif($_GET['filter']=="weekly")
			{
				$month=date("Y-01-d", strtotime('monday this week'));
				$condition="'created_at','>','$month 00:00:00'"; 
			}
			elseif($_GET['filter']=="today")
			{
				$today=date("Y-m-d");
				$condition="'created_at','>','$today 00:00:00'"; 
			}
		
		}
		
		$data=array();
		$role_id= Auth::user()->role_id;
		$id= Auth::user()->id;
		$kyc=Helper::is_kyc();
		if($role_id==4 || $role_id==1)
		{
			if($role_id==1)
			{
				$data['total_visitor']=Visitor::count();
				$data['total_securtitygard']=Admin::Where('role_id',3)->get();	
				$data['check_in_vistior']=Visitor::get();
				$data['flats']=Admin::Where(['role_id'=>5])->get();
				$data['totol_building']=Admin::Where(['role_id'=>4])->count();
				$data['totol_sales_manager']=Admin::Where(['role_id'=>7])->count();
				$data['totol_sales_person']=Admin::Where(['role_id'=>6])->count();
				$data['totol_leads']=Saleslead::count();
				$data['check_out_vistior']=Visitor::Where('exit_date','!=','')->get();
				$data['totol_vip']=Visitor::Where('vip_visitor','=','yes')->count();
				$$kyc=1;
			}
			else
			{
				$data['total_visitor']=Visitor::Where('added_by',$id)->count();
				$data['total_securtitygard']=Admin::Where(['role_id'=>3,'admin_id'=>$id])->get();	
				$data['flats']=Admin::Where(['role_id'=>5,'admin_id'=>$id])->get();	
				$data['check_in_vistior']=Visitor::Where('added_by',$id)->get();
				$data['check_out_vistior']=Visitor::Where('exit_date','!=','')->Where('added_by',$id)->get();
				$data['totol_vip']=Visitor::Where(['vip_visitor'=>'yes','added_by'=>$id])->count();
				
			}
				
			if(empty($kyc) && $role_id==4)
			{
				return view('admin.dashboard.kyc',$data); 	
			}
			else
			{
				return view('admin.dashboard.dashboard',$data); 
			}	   
		}
		else
		{
         
	   return Redirect::to('/admin/profile');
		}
    }

   public function login()
    {		
        if(Auth::check()){
            return Redirect::to('/admin/dashboard');            
        }
        else
        {
            return view('admin.login');
        } 
    }
	public function logout()
	{
	/* 	if(Auth::user()->role_id == 555){
		Auth::logout();
		Session::flush();
		return Redirect::to('/developer/login'); 
	}else{
		Auth::logout();
		Session::flush();
		return Redirect::to('/admin');
	} */
		Auth::logout();
		Session::flush();
		return Redirect::to('/admin');
	}

    public function forgotPassword(){
		
		return view('admin.forgot_password');
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	 public function profile() {	   
        return view('admin.dashboard.profile');
    }
	
	public function updateProfile(Request $request, $id) {
		
        $validatedData = $request->validate(
		             ['firstname' => 'required',
					  'profile_url' => 'image|mimes:jpeg,png,jpg',
					  'email' => 'required|unique:users,email,'.$id,
					  ]);
        $uploadImageName = '';
            if(Input::hasFile('profile_url'))
              {
            $uploadImageName = $request->file('profile_url');
            $uploadImageName = time().'.'.$request->profile_url->getClientOriginalExtension();
            $image = $request->file('profile_url');
            Storage::disk('s3')->put('uploads/user/'.$uploadImageName, file_get_contents($image), 'public');
            }
        $developer = developer::find($id);
        $developer->firstname = $request->firstname;
        $developer->lastname = '';
        $developer->reg_no =  $request->lastname;
		$developer->countryCode = $request->countryCode;
		$developer->phone = $request->phone;
        $developer->email = $request->email;
		$developer->address = $request->address;
        $developer->country = $request->country;
        $developer->company_background = $request->c_background;
		$developer->contact_name = $request->contact_name;
		$developer->contact_countryCode = $request->contact_countryCode;
        $developer->contact_number = $request->contact_number;
        $developer->contact_email = $request->contact_email;
        
		$developer->status = $request->status;
        if ($uploadImageName != '') {
            $developer->profile_url = $uploadImageName;
        }
        $developer->save();
        return redirect('admin/profile')->with('message', 'Profile  successfully updated!');
    }
		
		public static function updatenotificationcount()
    {
		    $notification['isread']=1;
		  $result =  DB::table('notifications')
						->where('isread',0)
						->update($notification); 
		
		echo 'true';			
	}
}
