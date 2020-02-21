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
                                <h5 class="">ADD PAGE</h5>
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
				  <form action="{{ url('/admin/cms/edit/'.$cms->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
						<div class="col-lg-12">	
						  <div class="form-group">
							 <label>Name</label>
						   <input type="text" name="name" id="name" value="{{ $cms->name }}" class="form-control"  required="required">
						  </div>			 
					    </div>
					
                  <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Slug</label>
							 <input type="text" name="slug" id="slug" class="form-control"  value="{{ $cms->slug }}" required>
							</div>					
                  </div>

                 <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Seo title</label>
							 <input type="text" name="seo_title" id="seo_title"  class="form-control"  value="{{ $cms->seo_title }}" >
							</div>					
                  </div>

                     <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Seo keyword</label>
							 <input type="text" name="seo_keyword" id="seo_keyword"  class="form-control"  value="{{ $cms->seo_keyword }}" >
							</div>					
                  </div>

                <div class="col-lg-12">
							<div class="form-group">
							 <label>Description</label>
								 <textarea class="form-control"  rows="5" id="description"  name="description">{{ $cms->description }}</textarea>
					      </div>
				 </div>				 
					  
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  @if($cms->status ==1) selected @endif value="1">Active</option>
								<option @if($cms->status ==0) selected @endif value="0">Inactive</option>
							</select>
						</div>
                       </div>

					   
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button type="button" onclick="location.href = '{{ url('/admin/cms') }}';" class="btn btn-block">Cancel</button>
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
 <script src="{{ asset('vendor/unisharp/tinymce/tinymce.js') }}"></script>
<script src="{{ asset('vendor/unisharp/tinymce/tinymce-config.js') }}"></script>
<script>
   
	loadreditor('description')
</script>
@endsection