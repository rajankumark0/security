<!DOCTYPE html>
<html lang="en">
<head>
    <title>ASQARI</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">    
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/lightbox.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,100i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
</head>
<body>
<script>
  var BASE_URL='<?php echo url('/'); ?>';
</script>
  <!-- Login section start -->
    <div id="mySidenavR" class="sidenavR" >
	
        <div class="login-box">		
		   <form method="POST" action="{{ route('login') }}" id="loginform">
		   <a href="javascript:void(0)" class="closebtn" onclick="closeNavR()" class="multipl"><img class="multipl"
                        src="{{ URL::asset('images/multipl.png')}}" alt=""></a>
                        @csrf
                   <div class="loginboxInner">
                    <h1>Login</h1>
					<span class="or-color">or</span> <a class="account" href="javascript:void(0)">create an account</a>
                     <div class="print-success-msg success" >
                                           
                     </div>
					 <div class="print-login-error-msg error" >
                                           
                     </div>
                        <div class="form-group form-mrg">                          
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                     <label class="form-control-placeholder" for="name">Mobile Number</label>
                                @error('email')
								     @if($message =='These credentials do not match our records.')
                                     <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
									 @endif
                                @enderror
                           
                        </div>

                        <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                  <label class="form-control-placeholder" for="name">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                           
                        </div>
						<a class="forget" href="{{ route('password.request') }}">forget password?</a>
                    <input type="button" class="login-botn" value="login" onclick="login()">
                  
						
					</div>
            </form>
		
		    <form method="post" id="signup-form"  action="{{ route('register') }}" >
			  @csrf
                <div class="signboxInner">
                    <h1>SIGN UP</h1>
                    <span class="or-color">or</span> <a class="accountlogin" href="javascript:void(0)">login to your
                        account</a>
                    <div class="print-error-msg errormsg" >
                                               <ul></ul>
                    </div>
                    <div class="form-group form-mrg">
                        <input type="text" id="name" name="name" class="form-control inputLableUp" placeholder="Name">
                        <label class="form-control-placeholder" for="name"></label>
						<span id="ename" class="error"></span>
                    </div>
                   <div class="form-group form-all-mrg">
                        <input type="text" id="email" name="email" class="form-control inputLableUp">
                        <label class="form-control-placeholder" for="email">email</label>
                    <span id="eemail" class="error"></span>
					</div>
                    <div class="form-group form-all-mrg">
                        <input type="text" id="mobile" name="mobile" class="form-control inputLableUp" placeholder="Mobile Number">
                        <label class="form-control-placeholder" for="mobile"></label>
					<span id="emobile" class="error"></span>
                    </div>
                    
				<!--	<div class="form-group lableup">
						
                        <select id="role" name="role_id" class="form-control inputLableUp" required="">
                        
						<option value="" selected="" disabled="">--Select Occupation--</option>
						
						<option value="4">Building Owner</option>
						<option value="5">Flat/Office owner</option>
						<option value="6">Sales person</option>
						<option value="7">Sales Manager</option>
						</select>
						<span id="erole" class="error"></span>
					</div>
					-->
					
                    <div class="form-group form-all-mrg">
                        <input type="password" id="password" name="password" class="form-control inputLableUp" placeholder="Password">
                        <label class="form-control-placeholder" for="password"></label>
						<span id="epassword" class="error"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control inputLableUp" placeholder="Confirm Password">
                        <label class="form-control-placeholder" for="confirm_password"></label>
						<span id="ec_pass" class="error"></span>
                    </div>			

                    <div class="login-check">
                        <input type="checkbox" name="term" class="check" required >
                        <label class="form-check-label" for="exampleCheck1">By creating an account, I accept the <a class="terms" href="#">Terms & Conditions</a></label>
								
                    </div>



                    <input type="button" id="signupbtn" onclick="register()" class="login-botn" value="Sign up">
                </div>
				 <div class="lodingsection" style="position: absolute;top: 31%;left: 34%;display:none;">
				   <img width="150" src="{{ URL::asset('images/loding.gif')}}">
				 </div>
				</form>
          
        </div>
    </div>
    <!-- Login section start -->

	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-6">
					<div class="logo">
						<a href="{{url('/')}}">
							<img title="Home Page" class="img-fluid" src="{{ URL::asset('images/logo.png')}}" alt="">
						</a>
					</div>
				</div>
				<div class="col-6 des-none">
					<div class="login-link mob-block before-login">
					@if (Auth::user())
						<a class="link" href="{{ url('/logout') }}">
							<img class="img-fluid" src="{{ URL::asset('images/login.png')}}" alt=""><span>LOGOUT</span>
						</a>
						<a class="link" href="{{ url('/admin') }}">
							<i class="fa fa-tachometer"></i><span>Dashboard</span>
						</a>
						
						@else
							<a class="link befor-login" href="javascript:void(0)" onclick="openNavR()">
							<img class="img-fluid" src="{{ URL::asset('images/login.png')}}" alt=""><span>LOGIN</span>
						</a>
					   @endif
					</div>
				</div>
				
				<div class="col-lg-6  col-sm-6 col-12">
					<div class="header-text">
						<p class="para">PAY NOW AND</p>
						<dl class="save">
							<dt class="red">SAVE</dt>
							<dd class="up">
								<p>UP</p>
								<p>TO</p>
						   </dd>
						   <dt class="red">50%</dt>
						   <dd>OFF</dd>
					   </dl>
					</div>	
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 pl-md-0">
					<div class="login-link mob-none before-login">
						
						
						@if (Auth::user())
						<a class="link" href="{{ url('/logout') }}">
							<img class="img-fluid" src="{{ URL::asset('images/login.png')}}" alt=""><span>LOGOUT</span>
						</a>
						<a class="link" href="{{ url('/admin') }}">
						<i class="fa fa-tachometer"></i><span>Dashboard</span>
						</a>
						@else
							<a class="link befor-login" href="javascript:void(0)" onclick="openNavR()">
							<img class="img-fluid" src="{{ URL::asset('images/login.png')}}" alt=""><span>LOGIN</span>
						</a>
					   @endif
					</div>
				</div>
			</div>
		</div>
	</header>

<script>
function register()
{  
     jQuery('.lodingsection').show();
	  jQuery('#signupbtn').prop("disabled", true);
	  jQuery(".print-error-msg").find("ul").html('');
        $.ajax({
				type: 'POST',	
				url:BASE_URL+'/signup',
				dataType: "json",
				data: $('#signup-form').serialize(),
				cache: false,
				success: function(response) {
                  			
                  jQuery('.lodingsection').hide();
				  jQuery('#signupbtn').prop("disabled", false);
                  if(response.error)
				  {			  
					$.each( response.error, function( key, value ) {
								$(".print-error-msg").find("ul").append('<li style="color:red">'+value+'</li>');
							});					
				  }else
				  {
					   jQuery(".print-error-msg").find("ul").html('');
					   jQuery('.accountlogin').click();
					   jQuery('.print-success-msg').html('<span style="color:green">Account successfully created.Verification link has been sent on your mail.</span>');
					   
					   setTimeout(function(){ jQuery('.print-success-msg').html(''); }, 3000);
					   
					   jQuery('#name').val('');
					   jQuery('#email').val('');
					   jQuery('#mobile').val('');
					   jQuery('#password').val('');
					   jQuery('#password_confirmation').val('');
				  }
				}						
				}); 
       
}
function login()
{
	 jQuery('.lodingsection').show();  
        $.ajax({
				type: 'POST',	
				url:BASE_URL+'/signin',
				dataType: "json",
				data: $('#loginform').serialize(),
				cache: false,
				success: function(response) {
                  				
                  jQuery('.lodingsection').hide();
				  
                  if(response.success)
				  {			  
					window.location.href=BASE_URL+'/'+response.redirect;				
				  }else
				  {
					  jQuery('.print-login-error-msg').show();
					  jQuery('.print-login-error-msg').html('<span style="color:red">'+response.error+'</span>');
					  setTimeout(function(){ jQuery('.print-login-error-msg').hide(); }, 3000);
				  }
				}						
				}); 
       
	
	
}

</script>