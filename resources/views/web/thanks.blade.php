@include('web.layouts.header')
<meta http-equiv="refresh" content="5;url={{url('/')}}" />
	<section class="pange-container">
		<div class="container">
			
				<div class="row">
					<div class="col-lg-12 col-md-12">
					@if($puchased=="upgrade")
					<div style="text-align: center; line-height: 182px; margin-top: 75px; font-size: 30px;">	
						<p>Thanks ! Your Plan has been Successfully Upgraded!</p>
					</div>
					@else	
						<div style="text-align: center; line-height: 182px; margin-top: 75px; font-size: 40px;">
							<i class="fa fa-thumbs-up" style="background: #55acee; width: 250px; height: 285px; border-radius: 50%; color: #fff; font-size: 150px; line-height: 270px;"></i>
							<p>Thanks ! Your Plan has been Successfully Purchaged!</p>
						</div>
					@endif
					</div>
				
				</div>
			
		</div>
	</section>
	
@include('web.layouts.footer')
