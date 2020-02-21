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
                                        <li class="active-page">KYC</li>

                                    </ul>

                                </div>

                            </div>

                        </div>
						 <div class="col-md-7" style="margin-top:15px;"> 
						 <form type="post" class="" enctype="multipart/form-data" action="{{ url('/admin/kyc/download') }}"   autocomplete="off" >
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
								@php
									$auth=Auth::user();
									@endphp
					    @if(count($kyc)>0)
                         <table class="table table-bordered">

                                                <thead>

                                                    <tr>
                                                         <th>Id</th>
                                                        <th>Company Name</th>

                                                        <th>Contact Email</th>

                                                        <th>Contact Mobile</th>
														
                                                        <th>Builing Name</th>
                                                        <th> Company Status</th>

                                                        <th>Action</th>

                                                    </tr>

                                                </thead>



                                                <tbody>
								@foreach ($kyc as $kycs)
								
                                <tr>
                                    <td >{{$kycs->id}}</td>
									<td >{{$kycs->company_name}}</td>                                   
                                    <td >{{$kycs->contact_email}}</td>
									<td >{{$kycs->contact_mobile}}</td>
									
									<td >{{$kycs->name_builing}}</td>
									
									<td >
									{{$kycs->company_status}}
									</td>
									
									
									
                                    <td>
									                                       <a href="{{ url('/admin/kyc/view/'.$kycs->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a> 
@if($auth->role_id==1)
									<!--<a href="{{ url('/admin/kyc/edit/'.$kycs->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>-->
                                  
                                     <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/kyc/delete/'.$kycs->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
@endif
									
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