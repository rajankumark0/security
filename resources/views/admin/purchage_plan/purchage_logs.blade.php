@extends('admin.layouts.app')

@section('content')

<div class="main-container">

            <div class="container-fluid">

                <div class="page-breadcrumb">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="page-breadcrumb-wrap">

                                <div class="page-breadcrumb-info">                                    

                                    <ul class="list-page-breadcrumb">
                                        <li class="active-page"> Plan Price List</li>

                                    </ul>

                                </div>

                            </div>

                        </div>
						 <div class="col-md-7" style="margin-top:15px;"> 
						 <form type="post" class="" enctype="multipart/form-data" action="{{ url('/admin/purchange-plan/download') }}"   autocomplete="off" >
						 <div class="col-md-12 col-sm-12">
							<div class="row">
								{{ csrf_field() }}

								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" name="from_date" id="from_date" value="{{ old('from_date')}}" class="form-control" placeholder="From Date" required="required">
									</div>			 
								</div>			 

								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" class="form-control" name="to_date"  id="to_date" value="{{ old('to_date')}}" placeholder="To Date" required="required">
									</div>	
								</div>	
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
									<button class="btn btn-primary btn-block">Download</button>
									</div>
								</div>
							</div>
						</div>
						 </form>
						
						
						</div >

                        <div class="col-md-2">
                          
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
					    @if(count($purchagelist)>0)
                         <table class="table table-bordered">
							<thead>
							   <tr>					
									<th>ID</th>
									<th>Plan Name</th> 
									
									<th>Plan Package Name</th> 
                                 							
									<th>Plan Price</th>																	   
																									   
									<th>No of Guard</th>
									<th>Log Type</th>
									
									<th>Purchage Date</th>																	   
									<th>Expiry Date</th>																	   
									<!--<th>status</th>																	   
									<th>Actions</th>-->

								</tr>

							</thead>
							<tbody>
								
								 @foreach($purchagelist as $p)
                                  <tr>
                                    <td >{{$p->id}}</td>
									<td >{{$p->plan_name}}</td>                                   
								                                
									<td >{{$p->duration_name}}( {{$p->duration_value}} M)</td>                                   
									<td >{{number_format($p->price)}}</td>                                   
									<td >{{number_format($p->no_of_security)}}</td>                                   
									<td >{{$p->purchage_type}}</td>                                   
									<td >{{$p->purchage_date}}</td>                                   
									<td >{{$p->expire_date}}</td>                                   
                                  
									<!--<td >
									@if($p->status=="active")
									<span class="btn btn-success bupd1" >Active</span>
								     @else
									 <span class="btn btn-danger bupd1" >Inactive</span>
									 @endif
									</td>
                                    <td>
									   
									<!--<a href="{{ url('/admin/purchange-plan/view-log/'.$p->id) }}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                     
									@if($p->status!="active")
								   <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/purchange-plan/log-delete/'.$p->id) }}" class="btn btn-primary">delete</a>
									@endif
									</td>-->
                                </tr>
								  @endforeach
								
								
                                
							</tbody>
                        </table>
                         	 <div class="dt-pagination">
							  {{ $purchagelist->appends(request()->input())->links() }}
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