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
                                <h2 class="breadcrumb-titles">Dashboard </h2>
                            </div>      
                        </div>
						
						
                        <div class="des-input-fill">
                            <form action="{{ URL::asset('admin/dashboard')}}"  >
                            <div class="form-row">
                                    <div class="form-group col-md-5">
                                    <input type="text" name="visitor" class="form-control" id="inputCity" placeholder="Visitor name">
                                    </div>
                                    <div class="form-group col-md-5">
                                    <select id="inputState" name="filter" class="form-control">
                                        <option  value="">--select--</option>
                                        <option  value="today">Today</option>
										 <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                       
                                       
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
					


                    <div class="main">
                            
                        <div class="row">

                            <div class="col-md-12">
                                <div class="iconic-title">
                                    <h4>
                                        <b>Live Tracking</b>
                                    </h4>
                                </div>
                            </div>
                                
                            <div class="col-md-12">
                                <div class="item-box">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $total_visitor }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">VISITORS</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon2.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b><?=count($total_securtitygard)?></b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">GUARDS</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon2.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b><?=count($flats);?></b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Total Tenant</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $totol_vip }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Total VIP</span>

                                                </div>

                                            </div>

                                        </div>

										
										@php
										$user=Auth::user();

										@endphp
										@if($user->role_id==1)

										<div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $totol_building }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Buiding Owner</span>

                                                </div>

                                            </div>

                                        </div>
										
										
                                        <div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $totol_sales_manager }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Sales Manager</span>

                                                </div>

                                            </div>

                                        </div>
										
										<div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $totol_sales_person }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Sales Person</span>

                                                </div>

                                            </div>

                                        </div>

									<div class="col-md-3 col-sm-6">

                                            <div class="iconic-w-wrap number-rotate">

                                                <div class="main-img">
                                                    <img src="{{ URL::asset('backend/images/admin/icon1.png')}}" alt="">
                                                </div>

                                                <div class="w-meta-info">

                                                    <span class="w-meta-value number-animate bold">
                                                        <b>{{ $totol_leads }}</b>
                                                    </span>
                                                    <span class="w-meta-value number-animate">Sales Leads</span>

                                                </div>

                                            </div>

                                        </div>
									
									@endif
									</div>

                                </div>

                            </div>

                        </div>
                            
                    </div>
					
					
					@if($user->role_id==4)
            <div class="row">
			
                <div class="col-md-6">
				<div class="box-widget widget-module">

                        <div class="widget-head clearfix">

                            <h4>Check In</h4>

                        </div>

                        <div class="widget-container">

                            <div class="table-responsive">

                                    <table class="table w-order-list table-striped">
                                        <thead>
                                        <tr>
										    <th>Sr/No.</th>
                                            <th>Name</th>
											<th>Flat/building</th>
                                            <th>Mobile</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                             @php
											 $i=1;
											 @endphp
												@foreach($check_in_vistior as $v)
													<tr>
													<td><span>{{$i++}}</span></td>
													<td><span>{{$v->name}}</span></td>
                                                    <td><span>{{$v->building}}&nbsp;{{$v->flat}}</span></td>
													<td><a href="#">{{$v->mobile}}</a></td>
													<td><span class="red">{{$v->entry_date}} &nbsp;{{$v->entry_time}}</span></td>		

													</tr>
                                              @endforeach                                      

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="box-widget widget-module">

                            <div class="widget-head clearfix">

                                <h4>Check Out</h4>

                            </div>
                            <div class="widget-container">
                                <div class="table-responsive">
                                    <table class="table w-order-list table-striped">
                                          <thead>
                                                <tr>
												    <th> Sr/No.</th>
                                                    <th> Name </th>
                                                    <th> Mobile</th>
													<th>Entry</th>
                                                    <th>Exit</th>
                                                </tr>

                                            </thead>

                                            <tbody>
												@php
											 $i=1;
											 @endphp
												@foreach($check_out_vistior as $v)
													<tr>
													<td><span>{{$i++}}</span></td>
													<td><span>{{$v->name}}</span></td>                                                   
													<td><a href="#">{{$v->mobile}}</a></td>
													<td><span class="red">{{$v->entry_date}} &nbsp;{{$v->entry_time}}</span></td>		
                                                    <td><span class="red">{{$v->exit_date}} &nbsp;{{$v->exit_time}}</span></td>		

													</tr>
                                              @endforeach  

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                

                    <div class="col-md-6">

                        <div class="box-widget widget-module">

                            <div class="widget-head clearfix">

                                <h4 class="duty-title">GUARDS ON DUTY</h4>


                            </div>

                            <div class="widget-container">

                                <div class="table-responsive table-over">

                                    <table class="table w-order-list table-striped">

                                        <thead>

                                                <tr>

                                                    <th>

                                                        Sr.No.

                                                    </th>

                                                    <th>

                                                        Name

                                                    </th>


                                                </tr>

                                            </thead>

                                            <tbody>
<?php
$sn=1;
foreach($total_securtitygard as $securtitygard)
{
?>
                                                <tr>
                                                    <td>

                                                       <?=$sn++;?>

                                                    </td>

                                                    <td>

                                                        <span><?=$securtitygard->name;?></span>

                                                    </td>

                                                </tr>

<?php
}
?>                                       
                                               

                                              

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                   
                    <div class="col-md-6">

                        <div class="box-widget widget-module">

                            <div class="widget-head clearfix">

                                <h4 class="duty-title">Tenant Lists</h4>


                            </div>

                            <div class="widget-container">

                                <div class="table-responsive table-over">

                                    <table class="table w-order-list table-striped">

                                        <thead>

                                                <tr>

                                                    <th>

                                                        Sr.No.

                                                    </th>

                                                    <th>

                                                        Name

                                                    </th>


                                                </tr>

                                            </thead>

                                            <tbody>
<?php
$sn=1;
foreach($flats as $flat)
{
?>
                                                <tr>
                                                    <td>

                                                       <?=$sn++;?>

                                                    </td>

                                                    <td>

                                                        <span><?=$flat->name;?></span>

                                                    </td>

                                                </tr>

<?php
}
?>                                       
                                               

                                              

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>


			</div>
					
				@endif	

			
            </div>


@endsection

@section('footer_script')


@endsection