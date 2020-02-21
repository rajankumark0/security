<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'mobile' => ['required', 'string', 'max:20'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
	
  public function signup(Request $request)
    {
		$validator = Validator::make($request->all(), [	
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'mobile'=> 'required|unique:users,mobile',
			'password'=> 'required|min:6|confirmed',
			'password_confirmation'=> 'required|min:6',
			'term'=>'required'
         ]);
		 if($validator->passes())
			{ 
			$user= User::create([
				'name' => $request['name'],
				'email' => $request['email'], 
				'mobile' => $request['mobile'],
				'role_id' => 4,
				'admin_id' => 1,
				
				'password' => Hash::make($request['password']),
			]);
			
			$email=base64_encode($request['email']);
			$link=URL("/verify-account/".$email);
			$to = $request['email'];
			$subject = "Varificatoin Link";
			
			$txt = "Hello, ".$request['name'] ." <a href='".$link."'>Click Here</a> for verify your account!"; 
			$headers = "From:Security Gaurd <info@wps-dev-com>" . "\r\n" ;
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			mail($to,$subject,$txt,$headers);
			return $user;
		 }
		 else
		 {
			   return response()->json(['error'=>$validator->errors()->all()]);
		 }	 
		 
    }
	
	
}
