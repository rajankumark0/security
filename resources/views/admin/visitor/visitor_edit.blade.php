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
                            
				<div class="widget-container">
				 <div class="widget-block">
				  <form action="{{ url('/admin/visitor/edit/'.$visitor->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
						 <div class="form-group">			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
						
					  <div class="">
					     <label>Name</label>
					   <input type="text" name="name" id="name" value="{{ $visitor->name }}" class="form-control" placeholder="Name" required="required">
					  </div>			 
					 </div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					
					  <div class="">
					   <label>Email</label>
					   <input type="email" class="form-control" name="email"  id="email" value="{{ $visitor->email }}" placeholder="Email" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>				 
						</div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
								
						 <div class="">
						   <label>Mobile</label>
					      <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $visitor->mobile }}" placeholder="Mobile">
					     </div>
						 </div>			 
					 
					 </div>
					<div class="form-group">	
					<div class="col-lg-4 col-md-4 mt-3 w_50">
					
					   <div class="">
						   <label>Vehicle No.</label>
					      <input type="text" class="form-control" name="vehicle_no" id="vehicle_no" value="{{ $visitor->vehicle_no }}" placeholder="Vehicle No">
					   </div>
					   </div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					   <div class="">
						   <label>ID No.</label>
					      <input type="text" class="form-control" name="id_no" id="id_no" value="{{ $visitor->id_no }}" placeholder="ID No.">
					   </div>	
						</div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
						
					
					<div class="">

							<label>Building/Block No.</label>

							 <input type="text" name="building" value="{{ $visitor->building }}" class="form-control"  >

					 </div>
					 
					 </div>			 
					 
					  </div>
					<div class="form-group">
					 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					   <div class="">

						<label>Flat No</label>

						 <input type="flate" name="flat" value="{{ $visitor->flat }}" class="form-control"  >

					 </div>
					 
					 </div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					   <div class="">

						<label>Meet Person</label>

						 <input type="text" name="meet_person" value="{{ $visitor->meet_person }}" class="form-control"  >

					 </div> 
					 
					 </div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					  <div class="">

						<label>Entry Date</label>

						 <input type="text" id="datepicker" name="entry_date" value="{{ $visitor->entry_date }}" class="form-control datepicker"  >

					 </div>
					 
					 </div>			 
					 
					   </div>
					<div class="form-group">
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					

					 <div class="">

						<label>Entry Time</label>

						 <input type="text" id="timepicker" name="entry_time" value="{{ $visitor->entry_time }}" class="form-control timepicker"  >

					 </div>
					 
					 </div>			 
								 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					
					  <div class="">

						<label>Exit Date</label>

						 <input type="text" id="datepicker1" name="exit_date" value="{{ $visitor->exit_date }}" class="form-control datepicker"  >

					 </div>
					 
					 </div>			 
					 <div class="col-lg-4 col-md-4 mt-3 w_50">
					

					 <div class="">

						<label>Exit Time</label>

						 <input type="text" id="timepicker1" name="exit_time" value="{{ $visitor->exit_time }}" class="form-control timepicker"  >

					 </div>
					 
					 </div>			 
					
					  </div>
					<div class="form-group">
					
					
					<div class="col-lg-4 col-md-4 mt-3 w_50">
					
					 
					 	<div class="">
						<label>VIP Visitor</label>
							<select name="vip_status"  class="form-control">
							
							<option <?php if($visitor->vip_visitor=="Aproved"){ echo "selected";} ?> value="Aproved">Aproved</option>
							<option  value="Unaproved">Unaproved</option>
							</select>
						</div>
						</div>
						
						  </div>
					<div class="col-lg-12 col-md-12">
					
					<div class="col-lg-4 col-md-4 mt-3 w_50">
						<div class="">
							<button type="button" onclick="location.href = '{{ url('/admin/visitor') }}';" class="btn btn-block">Cancel</button>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 mt-3 w_50">
						<div class="">
							<button class="btn btn-info btn-block">Submit</button>
						</div>
					</div>
					
					</div>
					</form>
					
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

  $('#datepicker1').datepicker({ 
	format: "yyyy-mm-dd",
	minDate: '0'
	});	
 
$('#timepicker1').timepicker({
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