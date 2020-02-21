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
				  <form action="{{ url('/admin/cms/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
						<div class="col-lg-12">	
						  <div class="form-group">
							 <label>Name</label>
						   <input type="text" name="name" id="name" value="{{ old('name')}}" class="form-control"  required="required">
						  </div>			 
					    </div>
					
                  <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Slug</label>
							 <input type="text" name="slug" id="slug" class="form-control"  value="{{old('slug')}}" required>
							</div>					
                  </div>

                 <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Seo title</label>
							 <input type="text" name="seo_title" id="seo_title"  class="form-control"  value="{{old('seo_title')}}" >
							</div>					
                  </div>

                     <div class="col-lg-12">
                        
						<div class="form-group">
						 <label>Seo keyword</label>
							 <input type="text" name="seo_keyword" id="seo_keyword"  class="form-control"  value="{{old('seo_keyword')}}" >
							</div>					
                  </div>

                <div class="col-lg-12">
							<div class="form-group">
							 <label>Description</label>
								 <textarea class="form-control"  rows="5" id="description"  name="description">{{old('description')}}</textarea>
					      </div>
				 </div>				 
					  
                    <div class="col-lg-12">
					 <div class="form-group">
                        <label>Status</label>
							<select class="form-control" name="status" >
								<option  value="1">Active</option>
								<option @if(old('status')=='0') selected @endif value="0">Inactive</option>
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

	var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

$('#name').keyup(function() {
$('#slug').val(slug($('#name').val()));
});
</script>
@endsection