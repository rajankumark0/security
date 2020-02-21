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

                                        

                                        <li class="active-page"> <strong>Visitor List</strong></li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">
                             <a href="{{ url('/admin/visitor/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Visitor</button></a>
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
	<div class="col-lg-12 mb-2 search">
	         <span>Search Visitor</span>
			 <form>
			 <div class="col-lg-2">
			   
			  <input type="text" class="form-control" name="name" id="name" value="" placeholder="Visitor Name">
		    </div>	
			<div class="col-lg-2">
			   
			  <input type="text" class="form-control" name="mobile" id="mobile" value="" placeholder="Mobile No.">
		    </div>	
			
			<div class="col-lg-2">
			   
			  <input type="text" class="form-control" name="vehicle_no" id="vehicle_no" value="" placeholder="Vehicle No.">
		    </div>	
			
			<div class="col-lg-2">
			   
			  <input type="text" class="form-control" name="id_no" id="id_no" value="" placeholder="Id">
		    </div>

              <div class="col-lg-1">
			   
			  <input type="submit"  class="btn btn-primary srchbtn" name="search" id="search" value="Search">
		    </div>			
			
			</form>
			 <form type="post" class="" enctype="multipart/form-data" action="{{ url('/admin/visitor/download') }}"  autocomplete="off" >
						
							<div class="row">
								{{ csrf_field() }}

								<div class="col-lg-1">
									<div class="form-group">
										<input type="text" name="from_date" id="from_date" value="{{ old('from_date')}}" class="form-control" placeholder="From Date" required="required">
									</div>			 
								</div>			 

								<div class="col-lg-1">
									<div class="form-group">
										<input type="text" class="form-control" name="to_date"  id="to_date" value="{{ old('to_date')}}" placeholder="To Date" required="required">
									</div>	
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<button class="btn btn-primary btn-block">Download</button>
									</div>
								</div>
							</div>
					
						 </form>
						
     </div>
	 
	 
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
                                                        <th>ID</th>
														<th>Name</th>
														<th>Vehicle No.</th>
                                                        <th>Mobile</th>                                                       
                                                        <th>Destination</th>
                                                        <th>Meet Person</th>
													    <th>Check In</th>
													    <th>Check Out </th>														
														@if(Auth::user()->role_id==2)
													    <th>Action</th>
                                                        @endif
                                                    </tr>

                                                </thead>
                                                <tbody>
								@foreach ($adminlist as $admin)
								
                                <tr>
                                    <td id="adminid{{$admin->id}}">{{$admin->id}}</td>
									<td id="name{{$admin->id}}">{{$admin->name}}</td>
									<td id="name{{$admin->id}}">{{$admin->vehicle_no}}</td>
									<td id="mobile{{$admin->id}}">{{$admin->mobile}}</td>
									<td id="building{{$admin->id}}">{{$admin->building}}/{{$admin->flat}}</td>
									<td id="meet_person{{$admin->id}}">{{$admin->meet_person}}</td>
									<td id="entry_date{{$admin->id}}">{{$admin->entry_date}}&nbsp;{{$admin->entry_time}} </td>
									<td id="exit_date{{$admin->id}}">{{$admin->exit_date}}&nbsp;{{$admin->exit_time}} </td>								
									@if(Auth::user()->role_id==2)
                                    <td>
									   
									 <a href="{{ url('/admin/visitor/edit/'.$admin->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                     <a href="{{ url('/admin/visitor/view/'.$admin->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a> 
                                     <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/visitor/delete/'.$admin->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
									</td>
									 @endif
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