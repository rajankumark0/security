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

                                        <li class="active-page"> Edit Users</li>
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
				  <form action="{{ url('/admin/admin/edit/'.$admin->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
							
					  <div class="form-group">
					     <label>Name</label>
					   <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control" placeholder="Name" required="required">
					  </div>			 
					 
					
					  <div class="form-group">
					   <label>Email</label>
					   <input type="email" class="form-control" name="email"  id="email" value="{{ $admin->email }}" placeholder="Email" required="required">
					   <span class="text-danger error-email"></span> 
					  </div>				 
					
					
					
						 <div class="form-group">
						   <label>Mobile</label>
					      <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $admin->mobile }}" placeholder="Mobile">
					     </div>			 
					 
					 
					
					  <div class="form-group">
					      <label>Password</label>
					   <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password (Minimum 6 characters)">
					  </div>	
						
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option @if($admin->status==1) selected @endif  value="1">Active</option>
							<option @if($admin->status==0) selected @endif value="0">Inactive</option>
							</select>
						</div>

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/admin') }}';" class="btn btn-block">Cancel</button>
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
