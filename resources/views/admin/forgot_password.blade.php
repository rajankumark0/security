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
    <link rel="stylesheet" href="{{ url('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/css/authentication.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/css/color_skins.css') }}">
</head>

<body class="theme-purple authentication sidebar-collapse">
<div class="page-header">
    <div class="page-header-image" style="background-image:url({{ url('backend/assets/images/login.jpg') }})"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
			 @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <div class="header">
                        <div class="logo-container">
                            <img src="{{ url('backend/assets/images/logo.png') }}" alt="">
                        </div>
                        <h5>Forgot Password?</h5>
                        <span>Enter your e-mail address below to reset your password.</span>
                    </div>
                    <div class="content">
					
                        <div class="input-group input-lg">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Enter Email">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-email"></i>
                            </span>
                        </div>
						  @error('email')
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="footer text-center">
					
					 <button type="submit" class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light">SUBMIT</button>
                     
                        <h6 class="m-t-20"><a href="#" class="link">Need Help?</a></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <footer class="footer">
        <div class="container">
            <nav>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Privacy Policy </a></li>
                    <li><a href="#">Terms of Service</a></li>
					 
                </ul>
            </nav>
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>© All right reserved by Property Management App 2019 </span>
            </div>
        </div>
    </footer>
</div>

<!-- Jquery Core Js -->
<script src="{{ url('backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ url('backend/assets/bundles/vendorscripts.bundle.js') }}"></script> 
<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>
</body>
</html>