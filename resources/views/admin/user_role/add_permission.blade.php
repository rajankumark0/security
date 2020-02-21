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
                                <h5 class="">Add Permission</h5>
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
								//print_r($user_role);
							?>							
                       
<!-- Main Content -->
				  </div>

                <div class="row">

                    <div class="col-md-12">
                    <div class="box-widget widget-module">
                            
				<div class="widget-container">
				 <div class="widget-block">
				  <form action="{{ url('/admin/user-role/update-permision/'.$user_role->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
							{{ csrf_field() }}
					
					
                 
 
           <div class="col-lg-12"><div class="row">
		  <p> <h1>Permission For User Role {{$user_role->role_type}}</h1><div class="allckb"><input type="checkbox" id="ckbCheckAll">All </div></p>
		 
				<?php
				$permision=(array) json_decode($user_role->Permissions );
		$count=5;
				foreach($action as $r){
					
				$data=$r->action;
				
				
				$actiondata=explode('/',$data['prefix']);
				
				if( in_array('admin',$actiondata) and !empty($data['as']))
				{
					$data1[1]="";
					$data1=explode('-',$data['as']);
					
					if(!empty($data1[1]))
					{
					
					?>	
						
							
							<?php
								if($count%5==0){
									?>
									<div class='row'><div class='col-md-12'><h5>{{ $data1[0] }} &nbsp;&nbsp;&nbsp; <input type='checkbox'  <?php if(isset($permision) && in_array($data1[0],$permision)){echo "checked";} ?>  class='permisions'  value='{{ $data1[0] }}'   name='permision[]'></h5> </div></div> 
									
								<?php
								}
								$count++;
								?>
							
							<div class="col-md-2 checkboxper">
								<div class="form-group">
									<label>{{ ucfirst($data1[1])}}</label>
									 <input type="checkbox"  class="permisions" <?php if(isset($permision) && in_array($data['as'],$permision)){echo "checked";} ?> value="{{ $data['as'] }}"   name="permision[]">
								</div>
							</div>
						
						 
				<?php
					}
					
				}
				
				}	
				?>	
				<div class="row"><div class="col-md-12"><h5>Purchange Plan &nbsp;&nbsp;&nbsp; <input type="checkbox" class="permisions" value="purchange-plan" name="permision[]"></h5> </div></div>
                </div>
			</div>
				<hr>
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
 <script>

$(document).ready(function(){
$('#ckbCheckAll').click(function(event) { 
            if($(this).is(":checked")) {
                $('.permisions').each(function(){
                    $(this).prop("checked",true);
                });
            }
            else{
                $('.permisions').each(function(){
                    $(this).prop("checked",false);
                });
            }   
    }); 
    });
</script>
@endsection

