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
                                        <li class="active-page">Complaint List</li>

                                    </ul>

                                </div>

                            </div>

                        </div>
<div class="col-md-7" style="margin-top:15px;"> 
						 <form type="post" class="" enctype="multipart/form-data" action="{{ url('/admin/complaint/download') }}"  autocomplete="off" >
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
                              <a href="{{ url('/admin/complaint/create') }}" style="float: right;margin-top: 9px;"><button class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Complaint</button></a>
                          
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
					    @if(count($complaint)>0)
                         <table class="table table-bordered">
							<thead>
							   <tr>					
									<th>ID</th>
									<th>User Name</th> 
									<th>Subject</th>						
									<th>status</th>																	   
									<th>Actions</th>

								</tr>

							</thead>
							<tbody>
								
								 @foreach($complaint as $p)
                                  <tr>
                                    <td >{{$p->id}}</td>
									<td >{{$p->name}}</td>
									<td >{{$p->subject}}</td>                                         
                                  
									<td>
									@if($p->status=="Request")
									<span class="btn btn-danger bupd1" >Request</span>
								     @elseif($p->status=="Process")
									<span class="btn btn-info bupd1" >Process</span>
								     @else
									 <span class="btn btn-success bupd1" >Solved</span>
									 @endif
									</td>
                                    <td>
									   
									<!--<a href="{{ url('/admin/complaint/permission/'.$p->id) }}" class="btn btn-info">Add Access Permission</a>-->
									<a href="{{ url('/admin/complaint/edit/'.$p->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									<a href="{{ url('/admin/complaint/view/'.$p->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                     
								   <a onclick="return confirm('Are You Sure Want to delete')" href="{{ url('/admin/complaint/delete/'.$p->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
								
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