<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Admin\Faq;
use Auth;
use DB;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqlist=Faq::paginate(10); 		      
        return view('admin.faq.faq_list',compact('faqlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         return view('admin.faq.faq_add');
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
				'question' => 'required',
				'answer' => 'required'
			]);			
			
          $faq = new Faq;
          $faq->question = $request->question;		  	 
		  $faq->answer = $request->answer;		  
		  $faq->status = $request->status;
		  $faq->created_by = Auth::user()->id;
		  $faq->save();

          return redirect('/admin/faq')->with('message', 'Faq successfully saved!');
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
        $faq=Faq::find($id);         
		return view('admin.faq.faq_edit',compact('faq'));
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
				'question' => 'required',
				'answer' => 'required'
			]);			
		
          $faq=Faq::find($id);		
		  $faq->question = $request->question;		  	 
		  $faq->answer = $request->answer;	  
		  $faq->status = $request->status;
		  $faq->created_by = Auth::user()->id;
		  $faq->update();	
		  
		 return redirect('/admin/faq')->with('message', 'Faq successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $faq =Faq::find($id);
		 $faq->delete();
		 return redirect('/admin/faq')->with('message', 'Faq successfully deleted!');
    }
}
