<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <title>Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ url('backend/assets/images/fav.png') }}" type="image/x-icon">
    <!-- Custom Css -->
   
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<style type="text/css">
		/* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('<?php echo  URL::asset('backend/Picture1.jpg'); ?>');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 270px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
	</style>

</head>

<body >

<div class="container">    
	<div class="d-flex justify-content-center h-100">	
		<div class="card">
		<div class="card-header" style="text-align:center;">
			Login
				
			</div>
		
            <div class="card-body">
               <form method="POST" action="{{ route('login') }}">
                        @csrf
                    
                    <div class="content"> 
					   @error('email')
					   <div class="input-group form-group">
						<span  role="alert" style="color:red;">
							<strong>{{ $message }}</strong>
						</span>
						</div>
					 @enderror	
					 @error('password')
					    <div class="input-group form-group">
							<span  role="alert" style="color:red;">
								<strong>{{ $message }}</strong>
							</span>
						</div>	
						@enderror	
						
                        <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
                            <input id="email" type="email" class="form-control bgwhit @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Enter Email"  />
							
                        </div>
                        <div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
                            <input id="password" type="password" name="password" required placeholder="Password" class="form-control" class="bgwhit" />
                          </div>
                    </div>
                    <div class="form-group">
                       
						 <a href="{{ route('login') }}" class="btn btn-info ">Forgot Password</a>
						 <button type="submit" class="btn float-right login_btn">SIGN IN</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</div>

</body>
</html>