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
                                <h5 class="">Edit Subscribe Plan</h5>
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
				  <form action="{{ url('/admin/plan-price/edit/'.$planprice->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
											<div class="col-lg-12">	
						  <div class="form-group">
							 <label>Plan Name</label>
							<select class="form-control" name="plan_id" >
								@foreach($plan as $p)
								<option  <?php if($planprice->plan_id ==$p->id){ echo "selected"; } ?>  value="{{$p->id}}">{{$p->plan_name}}</option>
								@endforeach
							</select>				
							</div>			 
					    </div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Duration Month ( In Month Ex-1,2)</label>
							<input type="number" name="duration_value" id="duration_value" value="{{ $planprice->duration_value }}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Duration Name</label>
							<input type="text" name="duration_name" id="duration_name" value="{{ $planprice->duration_name}}" class="form-control"  required="required">
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<label>Price</label>
							<input type="number" name="price" id="price" value="{{ $planprice->price }}" class="form-control"  required="required">
						</div>
					</div>
		 
					  
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  @if($planprice->status ==1) selected @endif value="1">Active</option>
								<option @if($planprice->status ==0) selected @endif value="0">Inactive</option>
							</select>
						</div>
                       </div>

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/plan-price') }}';" class="btn btn-block">Cancel</button>
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