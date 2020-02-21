@extends('admin.layouts.app')

@section('content')




        <div class="main-container">

            <div class="container-fluid">

                <div class="page-breadcrumb">

                    <div class="row">

                        <div class="col-md-7">

                            <div class="page-breadcrumb-wrap">

                                <div class="page-breadcrumb-info">                          

                                    <ul class="list-page-breadcrumb">
                                        <li class="active-page">KYC</li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">
 <!--<a href="{{ url('/admin/building-owner/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Building Owner</button></a>
                           -->
                        </div>

                    </div>

                </div>

    
	
    <div class="col-lg-12 mb-2">
	   @if(session()->has('message'))
				<div class="alert alert-success">
				{{ session()->get('message')}}
				</div>
			@endif          
    </div>

	
	
	 <div class="row">
                    <div class="col-md-12 ">
                    <div class="box-widget widget-module">
                          
                            <div class="widget-container">
                                <div class=" widget-block">
								<div class="kyc-content" style="text-align:center;">
								<h3>KYC is not complete Please complete Your kyc for active your account!</h3>
								<p style="    display: inline-block;
    margin-top: 22px;"><a href="{{ url('/admin/kyc/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Complete KYC</button></a></p>
                         	 
							 </div>
							 <div class="dt-pagination">
							 
							 </div>
						
							

                                </div>

                            </div>

                        </div>

                    </div>

                    </div>


@endsection

@section('footer_script')
 	
@endsection