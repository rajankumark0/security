@extends('admin.layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-container">

 

            <div class="page-breadcrumb">

                <div class="row">

                <div class="col-md-12">
                    <div class="des-form">
                        <div class="page-breadcrumb-wrap">                           
                             <div class="page-breadcrumb-info">
                                <h2 class="breadcrumb-titles">Profile </h2>
                            </div>      
                        </div>
						
						
                        
                   
				   </div>
                        </div>

                    </div>

                    

                </div>
					
				
				
                    <div class="main">
                            
                        <div class="row">

                            <div class="col-md-12">
                                <div class="iconic-title">
                                    <h4>
                                        <b>Profile</b>
                                    </h4>
                                </div>
                            </div>
                                <div class="col-md-2 " > <img title="Home Page" class="img-fluid" src="{{ URL::asset('images/img.png')}}" alt=""></div>							
                            <div class="col-md-8" >
                                <div class="item-box">                           
                        <div class="widget-container">
                            <div class="table-responsive">
                                    <table class="table w-order-list table-striped">                                        
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span>Name</span>
                                                </td>
                                                <td>{{Auth::user()->name}}</td>                               

                                            </tr>
											<tr>
                                                <td>
                                                    <span>Email</span>

                                                </td>
                                                <td>{{Auth::user()->email}}</td>                                 

                                            </tr>
											<tr>
											<td>
                                                    <span>Mobile</span>
                                                </td>

                                                <td>{{Auth::user()->mobile}}</td>                                              

                                            </tr>                         

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                                </div>

                            </div>

                        </div>
                            
                    </div>

        
            </div>


@endsection

@section('footer_script')


@endsection