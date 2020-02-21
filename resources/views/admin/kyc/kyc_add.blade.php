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

                                        <li class="active-page">KYC</li>
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
				  <form action="{{ url('/admin/kyc/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
							
					  <div class="form-group">
					     <label>Company Name</label>
					   <input type="text" name="company_name" id="company_name" value="{{ old('company_name')}}" class="form-control" placeholder="Company Name" required="required">
					  </div>			 
					  <div class="form-group">
					     <label>Phone No</label>
					   <input type="text" name="phone_no" id="phone_no" value="{{ old('phone_no')}}" class="form-control" placeholder="Phone No" required="required">
					  </div>			 
					 
					
					  <div class="form-group">
					   <label>Postal Address</label>
					   <input type="text" class="form-control" name="postal_address"  id="postal_address" value="{{ old('postal_address')}}" placeholder="Postal Address" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>
					  
					  <div class="form-group">
					   <label>Physical Addess</label>
					   <input type="text" class="form-control" name="physical_addess"  id="physical_addess" value="{{ old('physical_addess')}}" placeholder="Physical Address" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>
					  
					  <div class="form-group">
					   <label>contact name</label>
					   <input type="text" class="form-control" name="contact_name"  id="contact_name" value="{{ old('contact_name')}}" placeholder="Contact Name" required="required">
					   <span class="text-danger error-email"></span> 
					  </div> 
					  
					  <div class="form-group">
					   <label>Contact Person</label>
					   <input type="text" class="form-control" name="contact_person"  id="contact_person" value="{{ old('contact_person')}}" placeholder="Contact Person" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>
					  
					  <div class="form-group">
					   <label>Contact Mobile</label>
					   <input type="text" class="form-control" name="contact_mobile"  id="contact_mobile" value="{{ old('contact_mobile')}}" placeholder="Contact Mobile" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>
					  
					  <div class="form-group">
					   <label>Contact Email</label>
					   <input type="email" class="form-control" name="contact_email"  id="contact_email" value="{{ old('contact_email')}}" placeholder="Contact Email" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>				 
					
					
					
						 <div class="form-group">
						   <label> Builing Name</label>
					      <input type="text" class="form-control" name="name_builing" id="name_builing" value="{{ old('name_builing')}}" placeholder="Building Name">
					     </div>			 
					 
						<div class="form-group">
						   <label> Location LR Number</label>
					      <input type="text" class="form-control" name="location_lr_no" id="location_lr_no" value="{{ old('location_lr_no')}}" placeholder="Location LR Number">
					     </div>			 
					 
						<div class="form-group">
						   <label> Street</label>
					      <input type="text" class="form-control" name="street" id="street" value="{{ old('street')}}" placeholder="Street">
					     </div>
						 
						 <div class="form-group">
						   <label> Company Status</label>
					      <input type="text" class="form-control" name="company_status" id="company_status" value="{{ old('company_status')}}" placeholder="Company Status">
					     </div>			 
					 
					 
					

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin') }}';" class="btn btn-block">Cancel</button>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button class="btn btn-info btn-block">Submit</button>
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

@endsection