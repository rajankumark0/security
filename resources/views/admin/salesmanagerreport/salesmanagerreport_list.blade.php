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
                                <h5 class="">SALES MANAGER</h5>
                            </div>      
                        </div>
						
						
                        <div class="des-input-fill">
                            <form>
                            <div class="form-row">
                                    <div class="form-group col-md-5">
                                    <input type="text" class="form-control" id="inputCity" placeholder="Search">
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
														<th>Name of Sales agent</th>
														<th>Client</th>
                                                        <th>Asqari Types</th>                                                       
                                                        <th>Subscription</th>
														<th>Date of Entry</th>
                                                      	<th>Commission</th>
                                                      	<th>Status</th>
                                                      											   
                                                    </tr>

                                                </thead>
                                                <tbody>
							
								
                                <tr>                                  
									<td>Rohit Sharma</td>
									<td >Jansan Kumar</td>
									<td >Adharcard</td>
									<td >3 Moth</td>
									<td >11/10/2019</td>
									<td >20,0000.00</td>
									<td >Active</td>
																
                                   
                                </tr> 
								<tr>                                  
									<td>Rohit Sharma</td>
									<td >Jansan Kumar</td>
									<td >Adharcard</td>
									<td >Expire</td>
									<td >11/10/2019</td>
									<td >20,0000.00</td>
									<td >Inactive</td>
																
                                   
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