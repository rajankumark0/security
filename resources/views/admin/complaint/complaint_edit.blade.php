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
                                <h5 class="">Edit Complaint</h5>
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
								//print_r($complaint);
							?>							
                       
<!-- Main Content -->
				  </div>

                <div class="row">

                    <div class="col-md-12">
                    <div class="box-widget widget-module">
                            
				<div class="widget-container">
				 <div class="widget-block">
				  <form action="{{ url('/admin/complaint/edit/'.$complaint->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
						
						
						<div class="col-lg-12">
						<div class="form-group">
							<label>Subject</label>
							<input type="text" name="subject" id="subject" value="{{ $complaint->subject }}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Complaint</label>
							<input type="text" name="complaint" id="complaint" value="{{ $complaint->complaint }}" class="form-control"  required="required">
						</div>
					</div>
					
                		 
					  
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  @if($complaint->status =="Request") selected @endif value="Request">Request</option>
								<option  @if($complaint->status =="Process") selected @endif value="Process">Process</option>
								<option  @if($complaint->status =="Solved") selected @endif value="Solved">Solved</option>
							</select>
						</div>
                       </div>

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/complaint') }}';" class="btn btn-block">Cancel</button>
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