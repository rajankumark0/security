<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Complaint;
use App\Admin\Admin;

use Redirect; 
use Auth;
use Validator;
use Storage;
use DB;
class ComplaintController extends Controller
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
		  $Auth= Auth::user();
		  if($Auth->role_id==1)
			{
				 $data['complaint']= Complaint::get();
			}
			else
			{
				 $data['complaint']= Complaint::Where('user_id',$Auth->id)->orWhere('complaint_to', $Auth->id)->get();
			}
		 
		  /* print_r($data['complaint']);die; */
		  
        return view('admin.complaint.complaint_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $complaint= Complaint::where('status', 1)->get();	     
          return view('admin.complaint.complaint_add',compact('complaint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $validatedData = $request->validate([	        
				'subject' => 'required',
				'complaint' => 'required',
			
				
			]);	
			$user_id = Auth::user()->id;
			$user_name = Auth::user()->name;
			$user_email = Auth::user()->email;
			$user_mobile = Auth::user()->mobile;
			$complaint_to = Auth::user()->admin_id;
			
              //	print_r($complaint_to);die;			  
	        $complaint = new complaint;
			$complaint->user_id = $user_id; 
			$complaint->name = $user_name; 
			$complaint->email = $user_email; 
			$complaint->mobile = $user_mobile; 
			$complaint->subject = $request->subject; 
			$complaint->complaint = $request->complaint; 
			$complaint->complaint_to = $complaint_to; 
			$complaint->status = 'Request'; 
			
			
	         // $planprice = new UserRole;
	         // $planprice->role_type = $request->role_type;			
	          
			 // $planprice->status = $request->status; 
			  	
		      $complaint->save();
		 
		 return redirect('/admin/complaint')->with('message', 'Complaint successfully created!');
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
		
		$data['complaint']= Complaint::find($id); 
	//print_r($data['complaint']);die;
        return view('admin.complaint.complaint_edit',$data);
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

		  
		 return redirect('/admin/complaint')->with('message', 'Complaint successfully updated!');
       }
    public function show($id)
    {
       /* $complaint=complaint::leftJoin('users', function($join){ $join->on('complaints.added_by','=','users.id'); })
	            ->where('complaints.id',$id)
	            ->first(['complaints.*','users.name as uname']); */
	   $data['complaint']= Complaint::find($id); 
	   
	   return view('admin.complaint.complaint_view',$data);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $complaint =Complaint::find($id);
		 $complaint->delete();
		  return redirect('/admin/complaint')->with('message', 'Complaint successfully deleted!');
    }
	public function download(Request $request)
	{
		$auth=Auth::User();
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";
		
		$builder=Complaint:: ->where('created_at','>=', $from)->where('created_at','<=',$to);
		if($auth->role_id!=1)
		{
		$builder->where('user_id','=',$auth->id);
		$builder->orWhere('complaint_to','=',$auth->id);
		}
			
		$builder=$builder ->get()->toArray();
		 
	$fp = fopen('php://output', 'w');
   $flag=1;
    foreach ($builder as $value)
		{
			if( $flag==1)
			{
				$row[]='S.NO.';
				$row[]='Complaint From ';
				$row[]='Complaint To';
				$row[]='Email';
				$row[]='Mobile';
				$row[]='subject';
				$row[]='Complaint';
				$row[]='status';
				$row[]='Complaint Date';
				fputcsv($fp, array_values($row));
				unset($row);
			}
			
			$complaint_from= Admin::where('id',$value['user_id'])->first(); 
			
			$complaint_to= Admin::where('id',$value['complaint_to'])->first(); 
				$row[]=$flag;
				$row[]=$complaint_from?$complaint_from->name:"NA";
				$row[]=$complaint_to?$complaint_to->name:"NA";
				$row[]=$value['email'];
				$row[]=$value['mobile'];
				$row[]=$value['subject'];
				$row[]=$value['complaint'];
				$row[]=$value['status'];
				$row[]=$value['created_at'];
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
