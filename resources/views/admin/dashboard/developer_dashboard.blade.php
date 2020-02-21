@extends('admin.layouts.app')

@section('content')
<!-- Main Content -->

<style>
body,html{margin:0 padding:0; background-color: #f5f5f5;}
    .ml-menu {margin-left:0px; float:left; height:100px; width:100%; background:#F5F5F5; overflow-y:scroll; overflow-x:hidden; }    
    .ml-menu::-webkit-scrollbar {width:6px; background-color:#F5F5F5;}    
    .ml-menu::-webkit-scrollbar-thumb {background-color:#000000;}   
    .ml-menu::-webkit-scrollbar-track {-webkit-box-shadow:inset 0 0 6px rgba(0, 0, 0, 0.3); background-color:#F5F5F5;}
	.h_bg-bgr{background: #f5f5f5 !important;}
	
	.ftsets {
    color: #fff !important;
    font-weight: 500;
    font-size: 13px;
    text-decoration: underline;
    }
	
	.flx{display:flex;}
.butonus{padding:1px 15px 2px 5px; background:#fff; font-size:13px; text-transform:capitalize; min-height:23px; line-height:23px; width:120px !important;
    margin-left: 10px;}
.listlia{padding:7px 10px 4px 10px !important;}
.listlia li{border-bottom:#f7f7f7 dotted 1px;}
.listlia li:last-child{border:none;}
.listlia li a{font-size:13px; color:#333;}
.listlia li a:hover{padding-left:3px; color:#1e529c;}

.bgx1 {text-align:center; margin:0;  padding:10px 0; /* border-right:#ccc solid 1px; */}
.bgx1 h5 {font-size:13px; margin:0 0 10px 0; padding: 0; text-transform: uppercase;}
.bgx1 h3 {font-size:30px; margin:6px 0; padding:0;  font-weight: 600;}
.bgx1 span {border-bottom: #8a8a8a dotted 1px;}
.bgx1 p {font-size:12px;  margin:0;  padding:0;}
.borddr{border:1px solid #dee2e6;}
.table thead th {vertical-align:bottom; border-bottom:1px solid #dee2e6; background:#1e529c; color:#fff;}

.table tr td {background:#fff; color:#333;}
.table td a {color:#333; font-weight:600; text-decoration:underline;}
.table td a:hover {text-decoration:none;}
.wd {height:131px;}
.block-header {padding: 0px 15px 15px;}
.textfdz{}
.textfdz h6{font-size:17px; font-weight:normal;  margin:0;}
.textfdz h3{margin:0; font-weight:800;}



@media screen and (max-width:767px){
 .mobile_none {display:none;}
}


</style>

<link rel="stylesheet" href="{{ URL::asset('backend/developer/main.css')}}">
<section class="content home h_bg-bgr">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 mb_70">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        
		<div class="con_main_d">
		 
                        <!--- Account Status --->
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
									<form method="get">
                                        <tr>
                                            <th colspan="3">Account Status
                                                <select class="classic butonus" name="count_data" onchange="this.form.submit();">
                                                  <option>All time</option>
												  <option <?php if($day_count == 'today'){echo 'selected';} ?> value="today">Today</option>
                                                  <option <?php if($day_count == 'yesterday'){echo 'selected';} ?> value="yesterday">Yesterday</option>
                                                  <option <?php if($day_count == 'last_7'){echo 'selected';} ?> value="last_7">Last 7 days</option>
                                                  <option <?php if($day_count == 'last_30'){echo 'selected';} ?>    value="last_30">Last 30 days</option>
                                                  <option <?php if($day_count == 'this_month'){echo 'selected';} ?>  value="this_month">This month</option>
                                                  <option <?php if($day_count == 'this_year'){echo 'selected';} ?> value="this_year">This year</option>
                                                  <option <?php if($day_count == 'last_year'){echo 'selected';} ?> value="last_year">Last year</option>
                                                </select>
                                            </th>
                                            <th class="text-right"><!--<a href="javascript:void(0);" class="ftsets">View detailed stats</a>--></th>
                                        </tr>
									</form>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="borddr">
                                                <div class="bgx1">
                                                    <h5>Total Development</h5>
                                                    <h3>{{ $developer_developments[0]->daycount }}</h3>
                                                </div>
                                            </td>

                                            <td class="borddr">
                                                <div class="bgx1">
                                                    <h5>Total Development View</h5>
                                                    <h3>{{ $dev_viewcount[0]->daycount }}</h3>
                                                </div>
                                            </td>

                                            <td class="borddr">
                                                <div class="bgx1">
                                                    <h5>Total favorite</h5>
                                                    <h3>{{ $dev_wishlist[0]->daycount }}</h3>
                                                </div>
                                            </td>



                                            <td>
                                                <div class="bgx1">
                                                    <h5>Total REVENUE</h5>
													@php $total = number_format((float)$dev_revenue->total_price, 2,'.', ''); @endphp
                                                    <h3>USD @if($dev_revenue->total_price){{ $total }} @else 0 @endif</h3>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--- Account Status--->
						
						<div class="col-lg-12">
						<div class="row">
						<div class="col-lg-5">
					  <div class="table-responsive">          
						  <table class="table">
							<thead>
							  <tr>
								<th colspan="2" class="text-center pt-3 pb-3 textfdz">
								 <h6>Bookings</h6>
								 <h3 class="wait">{{ $devpay_total[0]->daycount }}</h3>
								</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td><span style="font-weight: 600;">Completed Bookings</span></td>
								<td class="text-right fntsz" id="complete">{{ $devpay_completed[0]->daycount }}</td>
							  </tr>
							  <tr>
								<td><span style="font-weight: 600;">Pending Bookings</span></td>
								<td class="text-right fntsz" id="pending">{{ $devpay_pending[0]->daycount }}</td>
							  </tr>
							  <tr>
								<td><span style="font-weight: 600;">Cancelled Bookings</span></td>
								<td class="text-right fntsz">0</td>
							  </tr>
							 
							  <tr>
								<td><span style="font-weight: 600;">Total Bookings</span></td>
								<td class="text-right fntsz">{{ $devpay_total[0]->daycount }}</td>
							  </tr>
							  
							  <tr class="wd mobile_none">
							   <td colspan="2">&nbsp;</td>
							  </tr>
							  
							</tbody>
						  </table>
						  </div>
						  
						  <div class="twekbut text-center mt-2 mb-4 clearfix">
					       <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">Day</a>
					       <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">Week</a>
					       <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">Month</a>
					       <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">All</a>
					      </div>
						  
					 </div>
					 
                     <div class="col-lg-7">
					  <div id="container"></div>					  
					  <div class="twekbut text-center mt-2 clearfix">
					   <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">Day</a>
					   <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">Week</a>
					   <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">1 Month</a>
					   <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">3 Months</a>
					   <a href="javascript:void(0);" class="btn btn-danger btn-sm nvlist bupd3">6 Months</a>
					  </div>
					 </div>
						
                    </div>
					</div>
					</div>
                
		
		
		
		
	</section>
   
@endsection

@section('footer_script')

	<script src="{{ URL::asset('backend/developer/js/highcharts.js')}}"></script>
	
	<script>
	         $(function() {
            $('#container').highcharts({
                title: {
                    text: 'Total Sale Of The Week',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: [<?php $date = date('Y-m-d');
										$i = 7;
										while($i>=0){
											$prev_date = date('j F Y', strtotime($date .'-'.$i--.' day'));
										echo "'".$prev_date."', ";
										}
								?> ]
                },
                yAxis: {
                    title: {
                        text: ''
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '°C'
                },

                series: [{
                    name: 'Date',
                    data: [7.0, 16.9, 19.5, 24.5, 38.2, 41.5, 55.2, 66.5]
                }]

            }, function(chart) { // on complete

                chart.renderer.text('', 140, 150)
                    .attr({
                        rotation: -25
                    })
                    .css({
                        color: '#4572A7',
                        fontSize: '16px'
                    })
                    .add();

            });
        });
	</script>
	
 	
@endsection