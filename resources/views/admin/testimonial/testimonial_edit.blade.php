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
                                <h5 class="">Edit Testimonial</h5>
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
							<?php
								//print_r($testimonial);
							?>							
                       
<!-- Main Content -->
				  </div>

                <div class="row">

                    <div class="col-md-12">
                    <div class="box-widget widget-module">
                            
				<div class="widget-container">
				 <div class="widget-block">
				  <form action="{{ url('/admin/testimonial/edit/'.$testimonial->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="testimonialform" autocomplete="off">
							{{ csrf_field() }}
						
						
					<div class="col-lg-12">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" id="name" value="{{ $testimonial->name }}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Designation</label>
							<input type="text" name="designation" id="designation" value="{{ $testimonial->designation }}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Content</label>
							<textarea name="content" id="content" class="form-control"  required="required">
								{{ $testimonial->content }}
							</textarea> 
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="image" class="form-control">
							<img href="" title="{{ $testimonial->image }}" class="form-control">
						</div>
					</div>
					
                		 
					  
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  @if($testimonial->status == 1) selected @endif value= 1>Active</option>
								<option  @if($testimonial->status == 0) selected @endif value= 0>Inactive</option>
							</select>
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