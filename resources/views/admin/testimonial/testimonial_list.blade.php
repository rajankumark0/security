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
                                        <li class="active-page">Testimonial List</li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">
                              <a href="{{ url('/admin/testimonial/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Testimonial</button></a>
                          
                        </div>

                    </div>

                </div>

    
	
    <div class="col-lg-12 mb-2">
	   @if(session()->has('message'))
				<div class="alert alert-success">
				{{ session()->get('message')}}
				</div>
			@endif          
    </div>

	
	
	 <div class="row">
                    <div class="col-md-12 ">
                    <div class="box-widget widget-module">
                           
                            <div class="widget-container">
                                <div class=" widget-block">
					    @if(count($testimonial)>0)
                         <table class="table table-bordered">
							<thead>
							   <tr>					
									<th>ID</th>
									<th>Name</th> 
									<th>Designation</th>						
									<th>Content</th>						
									<th>Image</th>						
									<th>status</th>																	   
									<th>Actions</th>

								</tr>

							</thead>
							<tbody>
								
								 @foreach($testimonial as $p)
								 <?php //$image = isset(!empty($p->image):$p->image?'No Image';)?>
                                  <tr>
                                    <td>{{$p->id}}</td>
									<td>{{$p->name}}</td>
									<td>{{$p->designation}}</td>                                         
									<td>{{$p->content}}</td>                                         
									<td>{{$p->image}}</td>                                         
                                  
									<td>
									@if($p->status == 1)
									<span class="btn btn-danger bupd1" >Active</span>
								    @else
									 <span class="btn btn-success bupd1" >Inactive</span>
									 @endif
									</td>
                                    <td>
									
									<a href="{{ url('/admin/testimonial/edit/'.$p->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									<a href="{{ url('/admin/testimonial/view/'.$p->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                     
								   <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/testimonial/delete/'.$p->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
								
									</td>
                                </tr>
								  @endforeach
								
								
                                
							</tbody>
                        </table>
                         	 <div class="dt-pagination">
							
							 </div>
						
							@else
							 <div class="col-lg-12 text-center">No result found </div>	
							@endif

                                </div>

                            </div>

                        </div>

                    </div>

                    </div>


@endsection

@section('footer_script')

 	
@endsection