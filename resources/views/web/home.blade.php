@include('web.layouts.header')

	<section class="main-banner">
		<div class="container">
			<div class="hero-banner">
				<div class="row">
					<div class="col-lg-5 col-md-6">
						<div class="banner-left">	
							<h2>MAOBILE SECURITY APP,</h2>
							<!--<h2>Unique cloud based,</h2> -->
							<p>mobile phone operated digital access control and security data collection system.</p>
						</div>
					</div>

					<div class="col-lg-7 col-md-6">
						<div class="banner-right">
							<img class="img-fluid" src="{{ URL::asset('images/banner.png')}}" alt="">
						</div>
					</div>

					<div class="main-btn">
						<a class="buy-now link-btn" data-toggle="modal" data-target="#myModal" href="#">BUY NOW AND SAVE UP TO 50%</a>
						<a class="free-day link-btn" data-toggle="modal" data-target="#myModal"href="#">FREE 14 DAY TRIAL</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="product-banner">
		<div class="container">
			<div class="banner">
				<div class="row">
				
					<div class="col-md-12">
						<div class="product-title">
							<h3>PRODUCT DETAILS</h3>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="product-text-banner">
							<div class="row">
								<div class="col-lg-5 col-md-6">
									<div class="product-img">
										<img class="img-fluid" src="{{ URL::asset('images/banner1.JPG')}}" alt="">
									</div>
								</div>
								
								<div class="col-lg-6 col-md-6">	
									<div class="product-text">
										<ul>
											<li>Mobile phone based ID scanner.</li>
											<li>Cloud based application.</li>
											<li>Mobile device/desktop dashboard.</li>
											<li>No hardware needed.</li>
											<li>No capital costs.</li>
											<li>Monthly subscription, Quit anytime.</li>
											<li>14 days free trial.</li>
											<li>Host entry code.</li>
											<li>Sms entry code.</li>
											<li>Visit authentication.</li>
											<li>Periodic reports on excel.</li>
											<li>Download invoices/Statements.</li>
											<li>Pay using Mobile money/Cerdit card/Bank transfer.</li>
											<li>Cost efficient.</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</section>
	
	<section class="security-banner">
		<div class="container">
			<div class="banner">
				<div class="row">
					<div class="col-md-12">
						<div class="security">
							<p>Asqari digitizes your security data collection. No hardware, no capital costs, monthly subscription. Quit anytime easy for security staff easy for you. (For office blocks apartments, factories gated communities, institutions) (catch phrase)</p>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="security-text">
							<div class="row">
								<div class="col-lg-4 col-md-6 d-md-flex">
									<div class="security-box">
										<div class="box-img cloud-img">
											<img class="img-fluid" src="{{ URL::asset('images/cloud.png')}}" alt="">
										</div>
										<div class="box-text">
											<h4>Cloud Computing</h4>
											<p>Provides accessibility to modern information storage option. Paperless secure easy retrieval of data information</p>
										</div>
									</div>
								</div>

								<div class="col-lg-4 col-md-6 d-md-flex">
									<div class="security-box">
										<div class="box-img">
											<img class="img-fluid" src="{{ URL::asset('images/clock.png')}}" alt="">
										</div>
										<div class="box-text">
											<h4>Real time</h4>
											<p>Asqari ensures on reports are available. It has client dashboards that provide accurate client information and ensures faster and more reliable service for new visitors and repeat visitors to an establishment.</p>
										</div>
									</div>
								</div>

								<div class="col-lg-4 col-md-12 d-md-flex">
									<div class="security-box">
										<div class="box-img">
											<img class="img-fluid" src="{{ URL::asset('images/lock.png')}}" alt="">
										</div>
										<div class="box-text">
											<h4>Data Security</h4>
											<p>Today, security data collected at access control is available to anyone with access to the registers maintained at the point of entry. Asqari ensures that data is collected securely and is only available to the administrator. Data is safe and secure.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="list">
						
							<div class="security-list">
								<p class="para">PAY NOW AND</p>
									<dl class="save">
										<dt class="red">SAVE</dt>
										<dd class="up">
											<p>UP</p>
											<p>TO</p>
									   </dd>
									   <dt class="red">50%</dt>
									   <dd>OFF</dd>
								   </dl>
							</div>
							
							<div class="list-box d-md-flex">
							@php 
							$flag=1
							@endphp
							@foreach($plans as $plan)
							
							@if(!empty($plan->planprice))
							
								@php 
									$p_price=$plan->planprice 
								@endphp
								
								<div class="list-left">
									<div class="list-head">
										<p>{{$plan->plan_name}}</p>
										<span>KES {{number_format($p_price[0]->price)}}  <del class="discount">{{number_format($p_price[0]->price*2)}}</del> <sub>Per Month </sub></span>
										
									</div>
									<div class="list-table">
										<table class="table table-striped">
										
										@foreach($p_price as $price)
											<tr>
												<td>{{ $price->duration_name}}</td>
												<td class="red">KES {{ number_format( $price->price)}}</td>
											 </tr>
										@endforeach


										</table>
											<a class="<?php  if($flag==1){echo"left"; $flag=2;}else{ echo"right"; $flag=1;}?>-btn list-btn" data-toggle="modal" data-target="#myModal" href="javascript:void(0)"><?php if($plan->plan_name=="Trial Users"){ echo "Get Now";}else{ echo "Buy Now";} ?></a>

									</div>
									
								</div>
							@endif
							@endforeach
<!--
			<div class="list-right">
									<div class="list-head">
										<p>Light 1 Users</p>
										<span>75,000 <sub>Per month</sub></span>
									</div>
									<div class="list-table">
										<table class="table table-striped">
											 <tr>
												<td>Monthly</td>
												<td class="red">30,000</td>
											 </tr>
											 <tr>
												<td>Quarterly</td>
												<td class="red">75,000</td>
											 </tr>
											 <tr>
												<td>Half Yearly</td>
												<td class="red">180,000</td>
											 </tr>
											 <tr>
												<td>Annually</td>
												<td class="red">360,000</td>
											 </tr>
										 </table>
									</div>
									<a class="right-btn list-btn" href="#">Buy Now</a>
								</div>
				-->		
						</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</section>
	
	<section class="testimonials-banner">
		<div class="container">
			<div class="banner">
				<div class="row">
					<div class="col-md-12">
						<div class="testimonials-title">
							<h3>TESTIMONIALS</h3>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="user-banner">
						@foreach($testimonial as $testimonials)
							<div class="item">
								<div class="user-box">
									<div class="user-img">
										<img class="img-fluid" src="{{ URL::asset('images/img.png')}}" alt="">
									</div>
									<div class="user-text">
										<p>{{$testimonials->content}}</p>
										<h5>{{$testimonials->name}}</h5>
										<span>{{$testimonials->designation}}</span>
									</div>
								</div>
								<img class="user-bottom img-fluid" src="{{ URL::asset('images/bottom.png')}}" alt="">
							</div>
						@endforeach
						</div>
					</div>
											
				</div>
				
				<div class="customer-box">
					<div class="user-btn">
						<button href="#" class="care-text">
							<span class="care-span">CUSTOMER CARE</span>
							<span class="care-img">
								<img class="img-fluid" src="{{ URL::asset('images/user.png')}}" alt="">
							</span>
						</button>
						<div class="dropdownmenu">
							<a class="drop-list chat-app" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/whatsapp.png')}}" alt="">
								<div class="chat">Whatsapp Chat</div>
							</a>
							<a class="drop-list user-get" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/user1.png')}}" alt="">
								<div class="user">Get an agent</div>
							</a>
							<a class="drop-list mail" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/mail.png')}}" alt="">
								<div class="email">Email</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="myModal" class="modal fade"  role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Select Your Plan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <form action="{{ url('buy-now') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="adminform" autocomplete="off">
 						{{ csrf_field() }}
						<div class="col-lg-12">	
						  <div class="form-group">
							 <label>Plans </label>
								<select class="form-control" name="plan_id" id="plan" required  onchange="show_package()">
									<option value="">--Select Plan--</option>
									
									
									@foreach($plans as $plan)
									
									
									<option value="{{$plan->id}}">{{$plan->plan_name}}</option>
									@endforeach
								</select>				
							</div>			 
					    </div>
					
						<div  class="col-lg-12 "  >	
						  <div class="form-group">
							 <label>Packages </label>
								<select class="form-control" name="plan_price_id" id="plan_price_id" required >
									
								
								</select>				
							</div>			 
					    </div>
					
						
						<div class="col-lg-3 col-md-4 mt-3 w_50">
							<div class="form-group">
								<button class="btn btn-info btn-block">Buy Now</button>
							</div>
						</div>
					
					<div class="lodingsections" style="position: absolute;top: 31%;left: 34%;display:none;">
				   <img width="150" src="https://wps-dev.com/dev/securityguard/public/images/loding.gif">
				 </div>
					</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
@include('web.layouts.footer')
<script>
$=jQuery;
function show_package()
{
	 jQuery('.lodingsections').show(); 
	var id=$("#plan option:selected").val();
	//alert(id);
	$.ajax({
	url: "<?php echo url('getplans') ?>",
	type:'GET',
	data:{id:id},
		success: function(result)
		{
			$("#plan_price_id").html(result);
			 jQuery('.lodingsections').hide(); 
		}
	});
}
</script>
@if(session()->has('message'))
<script>
openNavR();
</script>	
@endif
 
@php 
if(!empty($_SERVER['HTTP_REFERER']))
{
	$uri=explode("-",$_SERVER['HTTP_REFERER']);

	if(!empty($uri) && in_array('plan',$uri))
	{
		$_SESSION['type']="upgrade";
	}
}

@endphp

@if(!empty($uri) && in_array('plan',$uri))
<script>
$('#myModal').modal('show');
</script>	
@endif 