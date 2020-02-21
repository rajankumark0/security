<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Kyc;

use Redirect; 
use Auth;
use Validator;
use Storage;
use DB;
class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		/* 
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
	
		  $data['param']=$param; */
		  
		  $role_id= Auth::user()->role_id;
		  $id= Auth::user()->id;
		  if($role_id==1)
			{
		 	 $data['kyc']= Kyc::get();
			}
			else
			{
				$data['kyc']= Kyc::where('user_id',$id)->get();
			}
		 
		  /* print_r($data['complaint']);die; */
		  
        return view('admin.kyc.kyc_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         	     
          return view('admin.kyc.kyc_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            /*  $validatedData = $request->validate([	        
				'subject' => 'required',
				'complaint' => 'required',
			
				
			]);	 */
			
			
              //	print_r($complaint_to);die;	
			$user_id=Auth::user()->id;
	        $Kyc = new Kyc;
			$Kyc->user_id =$user_id; 
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
			
			
	         // $planprice = new UserRole;
	         // $planprice->role_type = $request->role_type;			
	          
			 // $planprice->status = $request->status; 
			  	
		      $Kyc->save();
		 
		 return redirect('/admin/kyc')->with('message', 'KYC successfully created!');
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
    public function edit($id)
    {
		
		$data['kyc']= kyc::find($id); 
	//print_r($data['complaint']);die;
        return view('admin.kyc.kyc_edit',$data);
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
				'subject' => 'required',
				'complaint' => 'required',
				'status' => 'required'
			]);
			
					 
 
	
			
			$complaint = Complaint::find($id);
			$complaint->subject = $request->subject;			
			$complaint->complaint = $request->complaint;			
			$complaint->status = $request->status; 
			$complaint->update();

		  
		 return redirect('/admin/kyc')->with('message', 'KYC successfully updated!');
       }
    public function show($id)
    {
       /* $complaint=complaint::leftJoin('users', function($join){ $join->on('complaints.added_by','=','users.id'); })
	            ->where('complaints.id',$id)
	            ->first(['complaints.*','users.name as uname']); */
	   $data['kyc']= Kyc::find($id)->toArray(); 
	   
	   return view('admin.kyc.kyc_view',$data);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $kyc =Kyc::find($id);
		 $kyc->delete();
		  return redirect('/admin/kyc')->with('message', 'KYC successfully deleted!');
    }
	
    public function download(Request $request)
	{
		$auth=Auth::User();
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";

		$builder= Kyc::where('created_at','>=', $from)
		 ->where('created_at','<=',$to)
		 ->get()->toArray();
		 
	$fp = fopen('php://output', 'w');
   $flag=1;
    foreach ($builder as $value)
		{
			if( $flag==1)
			{
				$row[]='S.NO.';
				$row[]='company name';
				$row[]='postal address';
				$row[]='physical address';
				$row[]='phone no';
				$row[]='contact person';
				$row[]='contact mobile';
				$row[]='contact email';
				$row[]='name builing';
				$row[]='location lr no';
				$row[]='street';
				$row[]='company status';
				$row[]='Register Date';
				fputcsv($fp, array_values($row));
				unset($row);
			}
				$row[]=$flag;
				$row[]=$value['company_name'];
				$row[]=$value['postal_address'];
				$row[]=$value['physical_addess'];
				$row[]=$value['phone_no'];
				$row[]=$value['contact_person'];
				$row[]=$value['contact_mobile'];
				$row[]=$value['contact_email'];
				$row[]=$value['name_builing'];
				$row[]=$value['location_lr_no'];
				$row[]=$value['street'];
				$row[]=$value['company_status'];
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
