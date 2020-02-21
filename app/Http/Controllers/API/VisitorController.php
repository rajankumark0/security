<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Visitor;
use App\Admin\Country;
use Redirect;
use Auth;
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
	
    
}
