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

                                        <li class="active-page">Edit Visitor</li>
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
                                <h4>Visitor</h4>
                            </div>
				<div class="widget-container">
				 <div class="widget-block">
				 
				 
				 <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{ $visitor->name }}</td>
                                            </tr>
                                             <tr>
                                                <td>Email</td>
                                                <td>{{ $visitor->email }}</td>
                                            </tr>
                                             <tr>
                                                <td>Mobile</td>
                                                <td>{{ $visitor->mobile }}</td>
                                            </tr>
                                             <tr>
                                                <td>Building</td>
                                                <td>{{ $visitor->building }}</td>
                                            </tr>
                                            <tr>
                                                <td>Flat</td>
                                                <td>{{ $visitor->flat }}</td>
                                            </tr>
                                            <tr>
                                                <td>Meet Person</td>
                                                <td>{{ $visitor->meet_person }}</td>
                                            </tr>
                                            <tr>
                                                <td>Scan ID</td>
                                                <td>{{ $visitor->scan_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Entry Date/Time</td>
                                                <td>{{ $visitor->entry_date }}&nbsp; {{ $visitor->entry_time }}</td>
                                            </tr>
                                            <tr>
                                                <td>Exit Date/Time</td>
                                                <td>{{ $visitor->exit_date }}&nbsp; {{ $visitor->exit_time }}</td>
                                            </tr>
											
											<tr>
                                                <td>Added By</td>
                                                
												<td>{{ $visitor->uname }}</td>
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