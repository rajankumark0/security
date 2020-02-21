<?php

namespace App\Http\Controllers\Web;
use App\Admin\Plan;
use App\Admin\PlanPrice;
use App\Admin\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Web\Home;
use Validator;
use Storage;
use DB;
use Auth;
use DateTime;
use App\Admin\PurchagePlan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		
		
		$data['plans']=Home::with(['planprice'])->get(); 
		$data['testimonial']=Testimonial::where('status',1)->get(); 
		//dd($data['testimonial']);			
        return view('web.home',$data);
		
			
    }
	
	public function buynow(Request $request)
	{
		 if (Auth::check()){
   
		$validatedData = $request->validate([	        
				'plan_id' => 'required',
				'plan_price_id' => 'required',
						
			]);	
			 
			 $data['plan_details'] = DB::table('plans')
			->select('*')
			->join('plan_prices','plan_prices.plan_id','=','plans.id')->where('plan_prices.id','=', $request->plan_price_id)->get(); 
		//dd($data['plan_details']);
		return view('web.buy',$data);
		 }
		 else
		 {
			 return redirect('/')->with('message', 'Login first for purchage Plan!');
		 }
		 
		
	}
	public function getplans(Request $request)
	{
		
		echo '<option value="">--Select Plan--</option>';
		
		$packages= PlanPrice::where(['plan_id'=> $request->id,'status'=>1])->get();
		foreach($packages as $package){
		?>
			<option value="<?=$package->id;?>"><?=$package->duration_name.' ( '.number_format(  $package->price ).' for '.$package->duration_value.' Month )'?></option>
		<?php
		}
	}
	public function confirm($id)
	{
		
		$userid = Auth::user()->id;
		$user = Auth::user();
		
		$pdate=date("d-m-Y");
	
		$packages= PlanPrice::where('id',$id)->get()->first();
		$Plan= Plan::where('id',$packages->plan_id)->first();
		$month=$packages->duration_value;
		$edate=date('d-m-Y',strtotime("+$month months"));
		
		//$PurchagePlan= PurchagePlan::where('user_id',$userid)->count();
		$PurchagePlan= PurchagePlan::where('user_id',$userid)->first();
		
		
		
		
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
		
		if(!empty($PurchagePlan))
		{
			
			$data['purchage_type']="Upgrade";
			DB::table('purchage_plans')->where('id',$PurchagePlan->id)->update($data);
				DB::table('purchage_log')->insert($data);
			$subject = "Upgrade Plan";
			$txt = "Hello, ".$user->name ." thank you for purchasing Plan!";
			$data['puchased']="upgrade";
		}
		else
		{
			$data['purchage_type']="New";
			DB::table('purchage_plans')->insert($data);
				DB::table('purchage_log')->insert($data);
			$subject = "Purchase Plan";
			$txt = "Hello, ".$user->name ." thank you for Upgrade Plan!";
			$data['puchased']="new";
		}
		
		
		
	
		
		$to = $user->email;
		
		$headers = "From: info@wps-dev-com" . "\r\n" ;

		mail($to,$subject,$txt,$headers);
		
		return view('web.thanks',$data);
		



	}
	
	public function trailnow($id)
	{
		$userid = Auth::user()->id;
		$user = Auth::user();
		$pdate=date("d-m-Y");
		
		$edate=date('d-m-Y',strtotime("+14 day")); 
	
		$packages= PlanPrice::where('id',$id)->get()->first();
		$Plan= Plan::find($packages->plan_id);
		$PurchagePlan= PurchagePlan::where('user_id',$userid)->count();
		
		
		if($PurchagePlan>0)
		{
			$data['puchased']="puchased";
			return view('web.thanks',$data);
			exit;
		}
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
		$subject = "Purchase Plan";
		$txt = "Hello, ".$user->name ." thank you for purchasing Plan!";
		$headers = "From: info@wps-dev-com" . "\r\n" ;
		$data['puchased']="notpuchased";
		return view('web.thanks',$data);
	}
	public function verifyaccount($email)
	{
		$email_id=base64_decode($email);
			DB::table('users')
            ->where('email', $email_id)
            ->update(['status' => 1]);
			return redirect('/')->with('message', 'Account Successfully verify!');
		
			

	}
}
