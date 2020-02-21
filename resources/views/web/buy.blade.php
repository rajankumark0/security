@include('web.layouts.header')
   <div  class="page-title">
       
            <div class="container text-left">
                <a href="{{ url('/') }}" style="font-size: 20px; font-weight: 600; background: #55acee; padding: 10px 15px; border-radius: 5px;"><i class="lni-home"></i>Home</a>
                <span class="crumbs-spacer"><i class="lni-chevron-right"></i></span>
                <span class="current" style="font-size: 20px; font-weight: 600; margin: 14px 0px; color: #fff; background: #d33; padding: 8px 25px; border-radius: 5px;">Buy</span>
            </div>
       
    </div>
	<section class="pange-container">
		<div class="container">
			
				<div class="row">
					<div class="col-lg-12 col-md-12">
					<div class="list-table">
					<table class="table table-striped">
					
					  <tr>
						<td>Plan Name</td>
						<td class="">{{$plan_details[0]->plan_name}}</td>
					 </tr> 
					 <tr>
						<td>Package Name</td>
						<td class="">{{$plan_details[0]->duration_name}}</td>
					 </tr>
					 <tr>
						<td>Package Valid For</td>
						<td class="">{{$plan_details[0]->duration_value}}  @if($plan_details[0]->price>0) Month @else Days @endif</td>
					 </tr> 
					 <tr>
						<td>Package Price</td>
						<td class="">KES @if($plan_details[0]->price>0){{number_format($plan_details[0]->price)}}@else Free Trial @endif</td>
					 </tr>
					 <tr>
						<th colspan="2">
						<label class="rajancontainer">&nbsp;&nbsp;Trial Now Fee for 14 Days
  <input type="checkbox" <?php if($plan_details[0]->plan_id==6){echo "checked";} ?> id="trail" >
  <span class="checkmark"></span>
</label></td>
						
					 </tr>
					 <tr>
						<td colspan="2" class="pull-center">
						<?php if($plan_details[0]->plan_id==6){?>
						<a class="btn btn-success"  id="t-buttons" href="{{url('trailnow/'.$plan_details[0]->id)}}">Trail Now</a>

					<?php
						}
						else
						{
					?>
					<a class="btn btn-success"  id="b-button" href="{{url('confirm/'.$plan_details[0]->id)}}">Confirm</a>
						<a class="btn btn-success" style="display:none;" id="t-button" href="{{url('trailnow/'.$plan_details[0]->id)}}">Trail Now</a>
				
					
					
					<?php
						}
					?>
							&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="{{url('/')}}">Cancel</a>
					</td>

					 </tr>
					 
					   
					    </table>
						
						
						
					</div>
				</div>
			
		</div>
	</section>
	
@include('web.layouts.footer')
<script>
$("#trail").click(function(){
	
	if($(this).is(':checked'))
	{
		$('#t-button').show();
		$('#b-button').hide();
	}
	else
	{
		$('#b-button').show();
		$('#t-button').hide();
	}
	
});
</script>

<style>
.rajancontainer {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.rajancontainer input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  background-color: #eee;
  border: 2px solid #403a3a;
  border-radius: 5px;
  line-height: 30px;
}

/* On mouse-over, add a grey background color */
.rajancontainer:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.rajancontainer input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.rajancontainer input:checked ~ .checkmark:after {
  display: block;
  boder: none;
}

/* Style the checkmark/indicator */
.rajancontainer .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>