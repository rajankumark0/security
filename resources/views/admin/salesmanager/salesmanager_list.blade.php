@extends('admin.layouts.app')

@section('content')




        <div class="main-container">

            <div class="container-fluid">

                <div class="page-breadcrumb">

                    <div class="row">

                        <div class="col-md-2">

                            <div class="page-breadcrumb-wrap">

                                <div class="page-breadcrumb-info">                                

                                    <ul class="list-page-breadcrumb">                                     

                                        <li class="active-page">Sales Manager</li>

                                    </ul>

                                </div>

                            </div>

                        </div>
						 <div class="col-md-7" style="margin-top:15px;"> 
						 <form type="post" class="" enctype="multipart/form-data" action="{{ url('/admin/sales-manager/download') }}" autocomplete="off" >
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


                        <div class="col-md-3">
                         <a href="{{ url('/admin/sales-manager/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Sales Manager</button></a>
                           
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
					    @if(count($adminlist)>0)
                         <table class="table table-bordered">

                                                <thead>

                                                    <tr>
                                                         <th>Id</th>
                                                        <th>Name</th>

                                                        <th>Email</th>

                                                        <th>Mobile</th>
														
                                                        <th>Added Date</th>
                                                        <th>Status</th>

                                                        <th>Action</th>

                                                    </tr>

                                                </thead>



                                                <tbody>
								@foreach ($adminlist as $admin)
								
                                <tr>
                                    <td id="adminid{{$admin->id}}">{{$admin->id}}</td>
									<td id="name{{$admin->id}}">{{$admin->name}}</td>                                   
                                    <td id="email{{$admin->id}}">{{$admin->email}}</td>
									<td id="mobile{{$admin->id}}">{{$admin->mobile}}</td>
									
									<td id="country{{$admin->id}}">
									<?php  $date = strtotime($admin->created_at);
                                           echo  $dat = date('d/m/y', $date); ?>
								    </td>
									
									<td id="status{{$admin->id}}">
									@if($admin->status==1)
									<span class="btn btn-success bupd1" >Active</span>
								     @else
									 <span class="btn btn-danger bupd1" >Inactive</span>
									 @endif
									</td>
                                    <td>
									   
									<a href="{{ url('/admin/sales-manager/edit/'.$admin->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <!-- <a href="{{ url('/admin/admin/view/'.$admin->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a> 
                                     <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/sales-manager/delete/'.$admin->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>-->

									
									</td>
                                </tr>
								  @endforeach
								
								
                                
							</tbody>
                        </table>
                         	 <div class="dt-pagination">
							  {{ $adminlist->appends(request()->input())->links() }}
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