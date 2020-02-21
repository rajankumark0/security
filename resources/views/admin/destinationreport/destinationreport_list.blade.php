@extends('admin.layouts.app')

@section('content')
        <div class="main-container">

            <div class="container-fluid">

                <div class="page-breadcrumb">

                    <div class="row">
					
					<div class="col-md-12">
                    <div class="des-form">
                        <div class="page-breadcrumb-wrap"  style="width: 247px;">                           
                             <div class="page-breadcrumb-info">
                                <h5 class="">DESTINATION REPORT</h5>
                            </div>      
                        </div>
						
						
                        <div class="des-input-fill">
                            <form>
                            <div class="form-row">
                                    <div class="form-group col-md-5">
                                    <input type="text" class="form-control" id="inputCity" placeholder="Search Visitor">
                                    </div>
                                    <div class="form-group col-md-5">
                                    <select id="inputState" class="form-control">
                                        <option selected="">Today</option>
                                       
                                    </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="des-head-btn">
                                <button type="submit" class="btn btn-primary">SEARCH</button>
                                </div>
                                </div>
                            </div>
                            </form>
                            </div>
                   
				            </div>
                        </div>

                        
                    </div>

                </div>

    
	
   	
	 <div class="row">
	                     <div class="col-md-12 ">
                    <div class="box-widget widget-module">
                           						 
                            <div class="widget-container">
                                <div class=" widget-block">
					          
                                  <table class="table table-bordered">
                                                <thead>
                                                    <tr>                                                        
														<th>Destination</th>
														<th>Check In</th>
                                                        <th>Check Out</th>                                                       
                                                        <th>Rejected</th>
                                                      											   
                                                    </tr>

                                                </thead>
                                                <tbody>
							
								
                                <tr>
                                  
									<td >New Delhi</td>
									<td >06:00 AM</td>
									<td >10:00AM</td>
									<td >Done</td>
																
                                   
                                </tr>
								
								<tr>                                  
									<td >New Delhi</td>
									<td >06:00 AM</td>
									<td >----</td>
									<td >Not Done</td>															
                                   
                                </tr>
								 								
                                
							</tbody>
                        </table>
                         	

                                </div>

                            </div>

                        </div>

                    </div>

                    </div>


@endsection

@section('footer_script')
 	
@endsection