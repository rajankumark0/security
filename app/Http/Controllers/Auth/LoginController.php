<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	 protected function credentials($request)
        {
          if(is_numeric($request->get('email'))){
            return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
          }
          return ['email' => $request->get('email'), 'password'=>$request->get('password')];
          
        }
		
	public function signin(Request $request)
	{
		$validator = Validator::make($request->all(), [	
			'email' => 'required',
			'password'=> 'required'
         ]);
		 if ($validator->passes()) { 
		 
		     if(is_numeric($request->get('email'))){
              $credn['mobile']=$request->get('email'); 
			  $credn['password']=$request->get('password');
			
            }else
			{
              $credn['email']=$request->get('email'); 
			  $credn['password']=$request->get('password');
			}
		  $credn['status']=1;
		   if (Auth::attempt($credn)) {


					return response()->json(['redirect' => '', 'success' => true], 200);
				} else {
					$message = 'These credentials do not match or account not Activated.';

					return response()->json(['error' => $message], 200);
				}
		 
		 }else
		 {
			   return response()->json(['error'=>'Please enter credentials']);
		 }
		
	}	
    		
}
