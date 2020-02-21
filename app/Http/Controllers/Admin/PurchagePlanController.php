<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\PlanPrice;
use App\Admin\PurchagePlan;
use App\Admin\Plan;
use App\Admin\Admin;
use Redirect;
use Auth;
use Validator;
use Storage;
use DB;
class PurchagePlanController extends Controller
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
		 $auth=Auth::user();
		 
		 
		 
		 if($auth->role_id==1)
		 {
		 
		  $data['purchagelist'] = 	DB::table('plans')
			->select('*')
			->join('purchage_plans','plans.id','=','purchage_plans.plan_id')->paginate(15); 
		 }
		 else
		 {
			 $data['purchagelist'] = 	DB::table('plans')
			->select('*')
			->join('purchage_plans','plans.id','=','purchage_plans.plan_id')->where('user_id','=',$auth->id)->paginate(15); 
		 }
       		 /* echo "<pre>";
			 print_r( $data['purchagelist']);
			 die(); */
       return view('admin.purchage_plan.purchage_list',$data);
       
    }
	
	public function addmoresecurity($purchageid=null)
	{
		
	
		$user = Auth::user();
		$purchage=PurchagePlan::find($purchageid);
		$plan=Plan::find($purchage->plan_id);
		
		$pdate=date("d-m-Y");
		
		$month=$purchage->duration_value;
		$edate=date('d-m-Y',strtotime("+$month months"));
		
		$price=($purchage->price/2);
		$totalguard=($purchage->no_of_security+$plan->gaurd);
		 $visitor =PurchagePlan::find($purchageid);

		  $visitor->no_of_security = $totalguard; 	
		  $visitor->update();
		 
		$packages= PlanPrice::find($purchage->package_id);
		$data['plan_id']=$packages->plan_id;
		$data['duration_value']=$packages->duration_value;
		$data['duration_name']=$packages->duration_name;
		$data['price']=$price;
		$data['payment_status']="failed";
		$data['payment_data']='';
		$data['no_of_security']=1;
		$data['user_id']=$purchage->user_id ;
		$data['purchage_date']=$purchage->purchage_date;
		$data['package_id']=$purchage->package_id;
		$data['expire_date']=$purchage->expire_date;
		$data['status']="active";
		$data['purchage_type']="Additional 1 Security";
		DB::table('purchage_log')->insert($data);
		  
		$to = $user->email;
		$subject = "Additional Package In Plan";
		$txt = "Hello, ".$user->name ." thank you for purchasing Additional Package!";
		$headers = "From: info@wps-dev-com" . "\r\n" ;
			return redirect('admin/purchange-plan')->with('message', 'Addition Guard successfully Added!');

	}
	public function renew($purchageid=null)
	{
		
		$purchage=PurchagePlan::find($purchageid);
		$userid = Auth::user()->id;
		$user = Auth::user();
		$pdate=date("d-m-Y");
	
		$packages= PlanPrice::where('id',$purchage->package_id)->get()->first();
		$month=$packages->duration_value;
		$edate=date('d-m-Y',strtotime("+$month months"));
		
		
		$data['plan_id']=$packages->plan_id;
		$data['duration_value']=$packages->duration_value;
		$data['duration_name']=$packages->duration_name;
		$data['price']=$packages->price;
		$data['payment_status']="failed";
		$data['payment_data']='';
		$data['user_id']=$purchage->user_id ;
		$data['no_of_security']=$purchage->no_of_security;
		$data['purchage_date']=$pdate;
		$data['package_id']=$purchage->package_id;
		$data['expire_date']=$edate;
		$data['status']="active";
		$data['purchage_type']="Renew";
		DB::table('purchage_plans')->where('id',$purchageid)->update($data);
		
		$data['purchage_type']="Renew";
		DB::table('purchage_log')->insert($data);
		
		$to = $user->email;
		$subject = "Renew Package";
		$txt = "Hello, ".$user->name ." thank you for purchasing Additional Package!";
		$headers = "From: info@wps-dev-com" . "\r\n" ;
		
		return redirect('admin/purchange-plan')->with('message', 'Your Plan successfully Renewed!');
	}
	
	public function purchage_log()
	{
		 $auth=Auth::user();
		 
		 
		 
		 if($auth->role_id==1)
		 {
		 
		  $data['purchagelist'] = 	DB::table('plans')
			->select('*')
			->join('purchage_log','plans.id','=','purchage_log.plan_id')->paginate(15); 
		 }
		 else
		 {
			 $data['purchagelist'] = 	DB::table('plans')
			->select('*')
			->join('purchage_log','plans.id','=','purchage_log.plan_id')->where('user_id','=',$auth->id)->paginate(15); 
		 }
       		 /* echo "<pre>";
			 print_r( $data['purchagelist']);
			 die(); */
       return view('admin.purchage_plan.purchage_logs',$data);
       
	}
	public function download(Request $request)
	{
		$auth=Auth::User();
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";
		
		$builders=DB::table('purchage_log')->where('created_at','>=', $from)->where('created_at','<=',$to);
		if($auth->role_id!=1)
		{
		$builders->where('user_id','=',$auth->id);
		
		}
			
		$builder=$builders ->get()->toArray();
		 
	$fp = fopen('php://output', 'w');
   $flag=1;
    foreach ($builder as $value)
		{
			if( $flag==1)
			{
				$row[]='S.NO.';
				if($auth->role_id==1)
				{
				$row[]='Customer Name';
				$row[]='Customer Mobile';
				}
				$row[]='Plan Name';
				$row[]='Package Name';
				$row[]='Valid For';
				$row[]='price';
				
				$row[]='Purchage Date';
				$row[]='No Of Security';
				$row[]='Expire Date';
				$row[]='Payment Status';
				$row[]='Purchase Type';
				$row[]='Date';
				fputcsv($fp, array_values($row));
				unset($row);
			}
			
			
			$Plan= Plan::where('id',$value->plan_id)->first(); 
			$cus= Admin::where('id',$value->user_id)->first(); 
				$row[]=$flag;
				if($auth->role_id==1)
				{
				$row[]=$cus?$cus->name:"NA";
				$row[]=$cus?$cus->mobile:"NA";
				}
				$row[]=$Plan?$Plan->plan_name:"NA";
				$row[]=$value->duration_name ;
				$row[]=$value->duration_value ;
				$row[]=$value->price ;
				$row[]=$value->purchage_date ;
				$row[]=$value->no_of_security ;
				$row[]=$value->expire_date ;
				$row[]=$value->payment_status ;
				$row[]=$value->purchage_type ;
				$row[]=$value->created_at ;
        fputcsv($fp, array_values($row));
		unset($row);
		$flag++;
		}
	header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Building-owner-report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
		 exit;
		 
		
		
	}
    
}
