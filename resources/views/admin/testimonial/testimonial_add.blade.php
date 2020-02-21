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
                                <h5 class="">Testimonial</h5>
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
				  <form action="{{ url('/admin/testimonial/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="testimonialform" autocomplete="off">
							{{ csrf_field() }}
						
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" id="name" value="{{ old('name')}}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Designation</label>
							<input type="text" name="designation" id="designation" value="{{ old('designation')}}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>content</label>
							<textarea name="content" id="content" value="{{ old('content')}}" class="form-control"  required="required">
							</textarea>
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="image" id="image" >
						</div>
					</div>
					
                   				   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/testimonial') }}';" class="btn btn-block">Cancel</button>
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