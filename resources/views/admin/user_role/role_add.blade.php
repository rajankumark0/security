@extends('admin.layouts.app')

@section('content')
<div class="main-container">
            <div class="container-fluid">
                <div class="page-breadcrumb">
				<div class="row">
					
					<div class="col-md-12">
                    <div class="des-form">
                        <div class="page-breadcrumb-wrap" style="width: 247px;">                           
                             <div class="page-breadcrumb-info">
                                <h5 class="">ADD Role</h5>
                            </div>      
                        </div>						
                        <div class="des-input-fill">                            
                            </div>                   
				            </div>
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
				  <form action="{{ url('/admin/user-role/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
						<div class="col-lg-12">	
						  <div class="form-group">
							 <label>Role Name</label>
						   <input type="text" name="role_type" id="role_type" value="{{ old('plan_name')}}" class="form-control"  required="required">
						  </div>			 
					    </div>
					
					<!--<div class="col-lg-12">
						<div class="form-group">
							<label>Users</label>
							<input type="number" name="users" id="users" value="{{ old('users')}}" class="form-control"  required="required">
						</div>
					</div>-->
					
				

	
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  value="Active">Active</option>
								<option @if(old('status')=='InActive') selected @endif value="InActive">InActive</option>
							</select>
						</div>
                       </div>

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/user-role') }}';" class="btn btn-block">Cancel</button>
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