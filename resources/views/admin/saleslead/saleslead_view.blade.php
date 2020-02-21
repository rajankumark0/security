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

                                        <li><a href="#">Home</a>
                                        </li>

                                        <li class="active-page">View Saleslead</li>
                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">
                       

                        </div>

                    </div>

                </div>

                  <div class="row">			 
							
							 @if ($errors->any())
								  <div class="alert alert-danger alert-dismissible">
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
								</div>
			                @endif
							 
                       
<!-- Main Content -->
				  </div>

                <div class="row">

                    <div class="col-md-12">
                    <div class="box-widget widget-module">
                             <div class="widget-head clearfix">
                                <span class="h-icon"><i class="fa fa-bars"></i></span>
                                <h4>Saleslead</h4>
                            </div>
				<div class="widget-container">
				 <div class="widget-block">
				 
				 
				 <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{ $saleslead->name }}</td>
                                            </tr>
                                             <tr>
                                                <td>Email</td>
                                                <td>{{ $saleslead->email }}</td>
                                            </tr>
                                             <tr>
                                                <td>Mobile</td>
                                                <td>{{ $saleslead->mobile }}</td>
                                            </tr>
                                             <tr>
                                                <td>Package Name</td>
                                                <td>{{ $saleslead->package_name }}</td>
                                            </tr>
                                             <tr>
                                                <td>Plan Name</td>
                                                <td>{{ $saleslead->plan_name }}</td>
                                            </tr>
                                             <tr>
                                                <td>Address</td>
                                                <td>{{ $saleslead->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{ $saleslead->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $saleslead->created_at }}</td>
                                            </tr>
											<tr>
                                                <td>Updated Date</td>
                                                <td>{{ $saleslead->updated_at }}</td>
                                            </tr>
                                                                                    
                                        </tbody>
                     </table>
				  			
									</div>

								</div>

							</div>

						</div>

						</div>

@endsection

@section('footer_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script> 
 $=jQuery;
//var today = new Date("Y-m-d");
  $('.datepicker').datepicker({ 
	format: "yyyy-mm-dd",
	minDate: '0'
	});	
 
$('.timepicker').timepicker({
    timeFormat: 'H:mm:ss',
    interval: 5,
    minTime: '6',
    maxTime: '9:00pm',
   
	 defaultTime: 'now',

    dynamic: false,
    dropdown: true,
    scrollbar: true
});
  </script>
@endsection