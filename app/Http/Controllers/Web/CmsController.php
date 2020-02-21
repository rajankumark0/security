<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DB;
use Redirect;

class CmsController extends Controller
{
   
    public function index($url)
    {	
		$data['page']=DB::table('cms')->where('slug',$url)->where('status',1)->first();
		
		if(!empty($data['page']))
		{
         return view('web.page',$data);
		}else
		{
			return redirect('/');
		}	
		
    }
	
	
	public function faq()
    {	
		$data['faqs']=DB::table('faqs')->where('status',1)->get();
        return view('web.faq',$data);
    }
	
	
	
}
