<!doctype html>

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Security Guard</title>

    <link rel="stylesheet" href="{{ URL::asset('backend/css/font-awesome.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/mycss.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/bootstrap.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/animate.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/waves.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/layout.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/components.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/plugins.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/common-styles.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/pages.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/responsive.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('backend/css/matmix-iconfont.css')}}" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" type="text/css">

</head>

<body style="background-image: url({{ URL::asset('backend/Picture1.jpg')}});">
<script>
  var BASE_URL='<?php echo url('/'); ?>';
</script>
<div class="page-container iconic-view">
@include('admin.layouts.left_navigation')	

<div class="page-content">
<header class="top-bar">
    <div class="container-fluid top-nav">
        <div class="search-form search-bar">
            <form>
                <input name="searchbox" value="" placeholder="Search Topic..." class="search-input">
            </form>
            <span class="search-close waves-effect"><i class="ico-cross"></i></span>
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img title="Home Page" class="img-fluid" src="{{ URL::asset('backend/images/das-logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            
                <div class="col-md-10">
                    <div class="das-user-profile">
                        <div class="des-bord-notification">
                                <span> <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i></a> </span>
                        </div>
													
                        <div class="des-bord-profile">
                            <a href="#"> <span class="das-user-icon"> <i class="fa fa-user" aria-hidden="true"></i></span> <span>{{Auth::user()->name}}</span></a>

                            <div class="des-dropdown">
                                <div class="des-dropdown-list">
                                    <ul>
                                        <li><a href="{{ url('/admin/profile') }}"><span><i class="fa fa-user" aria-hidden="true"></i></span><span> My Profile</span> </a></li>
                                        <li><a href="{{ url('/admin/logout') }}"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span><span> Logout</span> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</header>


