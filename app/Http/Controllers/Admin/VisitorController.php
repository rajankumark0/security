<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Visitor;
use App\Admin\Country;
use App\Admin\Admin;
use Redirect;
use Auth;
use DB;
use Validator;
use Storage;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$added_by=Auth::user()->id;
		/*  $param['search']=$request->input('search');
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
		  $data['adminlist'] = Visitor::getList($param); */	
       		if(Auth::user()->role_id==1)
			{
				$data['adminlist'] = Visitor::getList();	
			}
			else
			{
				$data['adminlist'] = Visitor::getList(array("added_by"=>$added_by));
			}
			 
			 
         return view('admin.visitor.visitor_list',$data);
       
    }
	
	public function vip(Request $request)
    {
		$added_by=Auth::user()->id;
	/* 	 $param['search']=$request->input('search');
         $param['type']=$request->input('type');
		 if(!empty($request->input('country')))
		 {
		     $param['country']=$request->input('country');
		 }else
		 {
			 $param['country']=array();
		 }		 
	
		 $data['param']=$param;
		   */
		 
			if(Auth::user()->role_id==1)
			{
				$data['adminlist'] = Visitor::getList(array("vip_visitor"=>"yes"));	
			}
			else
			{
				$data['adminlist'] = Visitor::getList(array("vip_visitor"=>"yes","added_by"=>$added_by));
			}
	
         return view('admin.visitor.vip_visitor_list',$data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $countries= Country::where('status', 1)->get();	     
          return view('admin.visitor.visitor_add',compact('countries'));
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
				'name' => 'required',
				'email' => 'required',
				'mobile'=>'required'
			]);			
				if(empty($request->vip_status))
				{
					$request->vip_status="Unaproved";
				}
				
				
					
	          $visitor = new Visitor;
	          $visitor->name = $request->name;			
			  $visitor->email = $request->email;
			  $visitor->vehicle_no = $request->vehicle_no;
			  $visitor->id_no = $request->id_no;
			  $visitor->mobile = $request->mobile; 
			  $visitor->building = $request->building; 
			  $visitor->vip_status = $request->vip_status; 
			  $visitor->flat = $request->flat; 
			  $visitor->meet_person = $request->meet_person; 
			  $visitor->vip_visitor = $request->vip_visitor; 
			  $visitor->entry_date = $request->entry_date; 
			  $visitor->entry_time = $request->entry_time; 	
              $visitor->added_by = Auth::user()->id; 				  
		      $visitor->save();
		 
		 return redirect('/admin/visitor')->with('message', 'Visitor successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $visitor=Visitor::leftJoin('users', function($join){ $join->on('visitors.added_by','=','users.id'); })
	            ->where('visitors.id',$id)
	            ->first(['visitors.*','users.name as uname']);
	   
	   return view('admin.visitor.visitor_view',compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$visitor=Visitor::find($id);         
        return view('admin.visitor.visitor_edit',compact('visitor'));
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
                'mobile'=>'required'

			]);
			
			
			if(empty($request->vip_status))
				{
					$request->vip_status="Unaproved";
				}
          $visitor =Visitor::find($id);
          $visitor->name = $request->name;			
		  $visitor->email = $request->email;
		  $visitor->vehicle_no = $request->vehicle_no;
		  $visitor->id_no = $request->id_no;
		  $visitor->mobile = $request->mobile; 
		  $visitor->building = $request->building; 
		  $visitor->flat = $request->flat; 
		    $visitor->vip_status = $request->vip_status; 
		  $visitor->meet_person = $request->meet_person; 
		  $visitor->entry_date = $request->entry_date; 
		  $visitor->entry_time = $request->entry_time; 	
		  $visitor->exit_date = $request->exit_date; 
		  $visitor->exit_time = $request->exit_time; 	
		  $visitor->updated_by = Auth::user()->id;
		  $visitor->update();

		  
		 return redirect('/admin/visitor')->with('message', 'Visitor successfully updated!');
       }
     
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $visitor =Visitor::find($id);
		 $visitor->delete();
		  return redirect('/admin/visitor')->with('message', 'Visitor successfully deleted!');
    }
	
    public function download(Request $request)
	{
		$auth=Auth::User();
		
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";

		$builder= Visitor::where("vip_visitor","!=", "yes")
		 ->where('created_at','>=', $from)
		 ->where('created_at','<=',$to);
		if($auth->role_id!=1)
		{
		$builder->where('added_by','=',$auth->id);
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
				$row[]='Mobile';
				$row[]='vehicle_no';
				$row[]='building';
				$row[]='Flat';
				$row[]='Meet Person';
				$row[]='ID No';
				$row[]='Vip Visitor';
				$row[]='Vip Status';
				$row[]='Entry Date';
				$row[]='Entry Tme';
				$row[]='Exit Date';
				$row[]='Exit Time';
				$row[]='Flat Response';
				$row[]='Added By';
				$row[]='Added At';
				
				
				fputcsv($fp, array_values($row));
				unset($row);
			}
			
			$added_by=Admin::find($value['added_by']);
				$row[]=$flag;
				$row[]=$value['name'];
				$row[]=$value['email'];
				$row[]=$value['mobile'];
				$row[]=$value['vehicle_no'];
				$row[]=$value['building'];
				$row[]=$value['flat'];
				$row[]=$value['meet_person'];
				$row[]=$value['id_no'];
				$row[]=$value['vip_visitor'];
				$row[]=$value['vip_status'];
				$row[]=$value['entry_date'];
				$row[]=$value['entry_time'];
				$row[]=$value['exit_date'];
				$row[]=$value['exit_time'];
				$row[]=$value['flat_response'];
				$row[]=$added_by->name;
				$row[]=$value['created_at'];
        fputcsv($fp, array_values($row));
		unset($row);
		$flag++;
		}
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="visitor-report.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		exit;
		  
		
		
	}
	
	public function vip_download(Request $request)
	{
		$auth=Auth::User();
		
		$from=$request->from_date ." 00:00:00";
		$to=$request->to_date ." 23:23:59";

		$builders= Visitor::where('vip_visitor', "yes")
		 ->where('created_at','>=', $from)
		 ->where('created_at','<=',$to);
		if($auth->role_id!=1)
		{
		$builders->where('added_by','=',$auth->id);
		}
	
		$builder=$builders ->get()->toArray();
		 
	$fp = fopen('php://output', 'w');
   $flag=1;
    foreach ($builder as $value)
		{
			if( $flag==1)
			{
				$row[]='S.NO.';
				$row[]='Name';
				$row[]='Email';
				$row[]='Mobile';
				$row[]='vehicle_no';
				$row[]='building';
				$row[]='Flat';
				$row[]='Meet Person';
				$row[]='ID No';
				$row[]='Vip Visitor';
				$row[]='Vip Status';
				$row[]='Entry Date';
				$row[]='Entry Tme';
				$row[]='Exit Date';
				$row[]='Exit Time';
				$row[]='Flat Response';
				$row[]='Added By';
				$row[]='Added At';
				
				fputcsv($fp, array_values($row));
				unset($row);
			}
				$added_by=Admin::find($value['added_by']);
				$row[]=$flag;
				$row[]=$value['name'];
				$row[]=$value['email'];
				$row[]=$value['mobile'];
				$row[]=$value['vehicle_no'];
				$row[]=$value['building'];
				$row[]=$value['flat'];
				$row[]=$value['meet_person'];
				$row[]=$value['id_no'];
				$row[]=$value['vip_visitor'];
				$row[]=$value['vip_status'];
				$row[]=$value['entry_date'];
				$row[]=$value['entry_time'];
				$row[]=$value['exit_date'];
				$row[]=$value['exit_time'];
				$row[]=$value['flat_response'];
				$row[]=$added_by->name;
				$row[]=$value['created_at'];
        fputcsv($fp, array_values($row));
		unset($row);
		$flag++;
		}
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="vip-visitor-report.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		exit;
		 
		
		
	}
}
