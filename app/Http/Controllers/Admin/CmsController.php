<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Admin\Cms;
use Auth;
use DB;
class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cmslist=Cms::cms_list(); 		      
        return view('admin.cms.cms_list',compact('cmslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         return view('admin.cms.cms_add');
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
				'name' => 'required'
			]);			
			
          $cms = new Cms;
          $cms->name = $request->name;		  	 
		  $cms->seo_title = $request->seo_title;
		  $cms->seo_keyword = $request->seo_keyword;		  	 
		  $cms->description = $request->description;
          $cms->slug = $request->slug;		  
		  $cms->status = $request->status;
		  $cms->created_by = Auth::user()->id;
		  $cms->save();

          return redirect('/admin/cms')->with('message', 'Page successfully saved!');
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
        $cms=Cms::find($id);         
		return view('admin.cms.cms_edit',compact('cms'));
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
				'name' => 'required'
			]);			
		
          $cms=Cms::find($id);		
		  $cms->name = $request->name;		  	 
		  $cms->seo_title = $request->seo_title;
		  $cms->seo_keyword = $request->seo_keyword;		  	 
		  $cms->description = $request->description;
		  $cms->slug = $request->slug;		  
		  $cms->status = $request->status;
		  $cms->created_by = Auth::user()->id;
		  $cms->update();	
		  
		 return redirect('/admin/cms')->with('message', 'Page successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $cms =Cms::find($id);
		 $cms->delete();
		 return redirect('/admin/cms')->with('message', 'Page successfully deleted!');
    }
}
