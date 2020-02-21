<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin\Testimonial;

use Redirect; 
use Auth;
use Validator;
use Storage;
//use Intervention\Image\Facades\Image;
use DB;
class TestimonialController extends Controller
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
		  $data['testimonial']= Testimonial::get();
		  /* print_r($data['testimonial']);die; */
		  
        return view('admin.testimonial.testimonial_list',$data);
       
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $testimonial= Testimonial::where('status', 1)->get();	     
          return view('admin.testimonial.testimonial_add',compact('testimonial'));
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
				'designation' => 'required',
				'content' => 'required',
				//'image' => 'required',
			]);			  

           /* $image = $request->file('image'); 
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/thumbnail'); 
            $img = Image::make($image->getRealPath()); 
            $img->resize(100, 100, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath.'/'.$input['imagename']); 
            $destinationPath = public_path('/images'); 
            $testimg = $image->move($destinationPath, $input['imagename']);*/
				
	        $testimonial = new testimonial;
			$testimonial->name = $request->name; 
			$testimonial->designation = $request->designation; 
			$testimonial->content = $request->content; 
			$testimonial->image = $request->image;  
			$testimonial->status = 1; 
			 
			  	
		    $testimonial->save();
		 
		 return redirect('/admin/testimonial')->with('message', 'Testimonial successfully created!');
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
		
		$data['testimonial']= Testimonial::find($id); 
	    //print_r($data['testimonial']);die;
        return view('admin.testimonial.testimonial_edit',$data);
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
				'designation' => 'required',
				'content' => 'required',
				'status' => 'required',
			]);
			
			$testimonial = Testimonial::find($id);
			$testimonial->name = $request->name; 
			$testimonial->designation = $request->designation; 
			$testimonial->content = $request->content; 
			$testimonial->image = $request->image; 
			$testimonial->status = $request->status; 
            $testimonial->updated_at = date('Y-m-d'); 
			$testimonial->update();

		  
		 return redirect('/admin/testimonial')->with('message', 'Testimonial successfully updated!');
       }
    public function show($id)
    {
       /* $complaint=complaint::leftJoin('users', function($join){ $join->on('complaints.added_by','=','users.id'); })
	            ->where('complaints.id',$id)
	            ->first(['complaints.*','users.name as uname']); */
	   $data['testimonial']= Testimonial::find($id); 
	   
	   return view('admin.testimonial.testimonial_view',$data);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $testimonial =Testimonial::find($id);
		 $testimonial->delete();
		  return redirect('/admin/testimonial')->with('message', 'Testimonial successfully deleted!');
    }
	
    
}
