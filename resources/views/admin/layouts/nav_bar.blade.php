     
<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">        
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ url('/admin/dashboard') }}"><img src="{{ url('backend/assets/images/m-logo.png') }}" width="40" alt="">
			<span class="m-l-10"><span class="red">PROP</span>EASE</span></a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>            

        </ul>
        <ul class="nav navbar-nav navbar-right">
         <?php
         if(Auth::user()->role_id!=5){
         	$notification=Helper::getnotificationlist(); ?>
		 

            <li class="dropdown"> <a href="javascript:void(0);" onclick="updatenotificationcount()" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
			
           <?php	$notification_count=Helper::getnotificationcount(); ?>	
                @if($notification_count>0)		   
                <div class="notify" ><span class="heartbit"></span><span class="point">@if($notification_count>0) {{$notification_count}} @endif</span></div>
												@endif

                </a>
				
                <ul class="dropdown-menu dropdown-menu-right slideDown">
                    <li class="header">NOTIFICATIONS</li>
                    <li class="body">
                        <ul class="menu list-unstyled">
						
                            		@if(count($notification)>0)				  
							  @foreach ($notification as $data)
                            <li> <a href="@if($data->redirect==14){{ url('/admin/agency/view/'.$data->u_id.'/job') }} @elseif($data->redirect==15) {{ url('/admin/owner') }} @elseif($data->redirect==28) {{ url('/admin/developer') }} @else{{ url('/admin/job') }} @endif">
                                <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                         
								<div class="menu-info">
                                    <h4>{{ $data->title}}</h4>
                                    <p><i class="zmdi zmdi-time"></i> {{ date('d M Y h:i A',strtotime($data->created_at))}} </p>
                                </div>
								

                                </a> </li> @endforeach 
								@else
									 <li> <a href="javascript:void(0);">
                               
								<div class="menu-info">
                                    <h4></h4>
                                  
                                </div>
								
                                </a> </li>
									@endif
                        </ul>
                    </li>
                </ul>
            </li>
    <?php } ?>
			
            <li><a href="{{ url('/admin/logout') }}" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a>
			
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
			</li>

        </ul>
    </div>
</nav>
<script>

function updatenotificationcount()
{
    
	             $.ajax({
						type: 'get',	
						url:BASE_URL+'/admin/updatenotificationcount',
						dataType: "json",
						processData: false,
						contentType : false,
						success: function(data) {							
							
							if(data)
							{
							  $('.notify').html('');							
							}	
						}
						
					});
	
	
}

</script>