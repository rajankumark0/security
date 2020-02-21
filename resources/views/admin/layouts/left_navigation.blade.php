<div class="left-aside desktop-view">
   
    <div class="left-navigation">
        <ul class="list-accordion">
		
		<li><a href="{{ url('/admin/dashboard') }}" class="waves-effect"><span class="nav-icon"> <img src="https://wps-dev.com/dev/securityguard/public/images/admin/d-0.png" alt=""> </span></a>
             </li>
			 
				
			@php 
			$role_id= Auth::user()->role_id;
			$menulist=Helper::getleftMenu();
			$kyc=Helper::is_kyc();
			@endphp
			
			@if(($kyc > 0 && $role_id==4) || $role_id!=4)
			
            <li><a href="javascript:void(0)" class="waves-effect"><span class="nav-icon"> <img src="https://wps-dev.com/dev/securityguard/public/images/admin/d-3.png" alt=""> </span><span class="nav-label">Form Elements</span></a>
               
			   <ul>
			   <?php  
			   if(!empty($menulist) && in_array('Sub Admin',$menulist) )
			   {
			   ?>
			    <li><a href="{{ url('/admin/admin') }}">Sub Admin</a></li>
				<?php
				}
				if(!empty($menulist) && in_array('Security Guard',$menulist))
				{
				?>
                <li><a href="{{ url('/admin/security-guard') }}">Security Guard</a></li>
				<?php
				}
				if(!empty($menulist) && in_array('Building Owner',$menulist))
				{
				?>
                <li><a href="{{ url('/admin/building-owner') }}">Building Owner</a></li>
				<?php
				}
				if(!empty($menulist) && in_array('Flat Office Owner',$menulist))
				{
				?>
                <li><a href="{{ url('/admin/flat-office-owner') }}">Tenant</a></li>
				<?php
				}
				if(!empty($menulist) && in_array('Sales Person',$menulist) || $role_id==7 )
				{
				?>
                <li><a href="{{ url('/admin/sales-person') }}">Sales Person</a></li>
				<?php
				} 
				if(!empty($menulist) && in_array('Sales Person',$menulist))
				{
				?>
                <li><a href="{{ url('/admin/sales-manager') }}">Sales Manager</a></li>
				<?php
				}
				?>
				<div class="arrow"></div>
				</ul>
			
            </li>
			  <?php  
			   if(!empty($menulist) && in_array('Visitor',$menulist) and $role_id==5)
			   {
			   ?>
			<li><a href="" class="waves-effect"><span class="nav-icon"><img src="https://wps-dev.com/dev/securityguard/public/images/admin/d-1.png" alt=""></span><span class="nav-label">Form Elements</span></a>
               
			   <ul>
			    <li><a href="{{ url('/admin/visitor/create') }}">Add Visitor</a></li>
				<li><a href="{{ url('/admin/visitor') }}">Visitor List</a></li>
				<li><a href="{{ url('/admin/visitor/vip') }}"> Vip Visitor List</a></li>
				<div class="arrow"></div>
				 </ul>
		    </li>
			<?php 
			   }
			   if(!empty($menulist) && in_array('Client Report',$menulist))
			   {
			?>
				
           <!-- <li><a href=""><span class="nav-icon"><i class="fa fa-bar-chart-o"></i></span><span class="nav-label">Tables</span></a>
                <ul>
                    <li><a href="{{ url('/admin/clientsreport') }}">Client Report</a>
                    </li>
                    <li><a href="{{ url('/admin/destinationreport') }}">Destination Report</a>
                    </li>
                    <li><a href="{{ url('/admin/salesmanagerreport') }}">Sales Manager Report</a>
                    </li>
                    <li><a href="{{ url('/admin/salesreport') }}">Sales Man Report</a>
					 </li>
					 <li><a href="{{ url('/admin/statusreport') }}">Status Report</a>
					 </li>
                    <li><a href="#">Subscription Report</a>
					 </li>
                    <li><a href="#">Type of asqari Report</a>
					</li>
					<div class="arrow"></div>
                </ul>
            </li>-->
			<?php 
			   }
			   if(!empty($menulist) && in_array('Cms',$menulist))
			   {
			?>
            <li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-file-o"></i></span><span class="nav-label">Cms</span></a>
			      <ul>
			    <li><a href="{{ url('/admin/cms/create') }}">Add Page</a></li>
				<li><a href="{{ url('/admin/cms') }}">Page List</a></li>
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
			   if(!empty($menulist) && in_array('Plan',$menulist))
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-thumbs-o-up "></i></span><span class="nav-label">Subscription Plane</span></a>
			      <ul>
			    <li><a href="{{ url('/admin/plan/create') }}">Add Plan</a></li>
				<li><a href="{{ url('/admin/plan') }}">Plan List</a></li>
				
			
			    <li><a href="{{ url('/admin/plan-price/create') }}">Add Plan Price</a></li>
				<li><a href="{{ url('/admin/plan-price') }}">Plan Price List</a></li>
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
			   if(!empty($menulist) && in_array('Faq',$menulist))
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-question-circle"></i></span><span class="nav-label">Cms</span></a>
			      <ul>
				<?php 
				if($role_id!=1)
				{
				?>
			    <li><a href="{{ url('/admin/faq/create') }}">Add FAQ</a></li>
				<?php
				}
				?>
				<li><a href="{{ url('/admin/faq') }}">Faq FAQ</a></li>
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
			   if(!empty($menulist) && in_array('Complaint',$menulist))
			   {
			?>
			<!--<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-file-text-o"></i></span><span class="nav-label">Complaint</span></a>
			      <ul>
				  <?php 
				if($role_id!=1)
				{
				?>
			    <li><a href="{{ url('/admin/complaint/create') }}">Add Complaint</a></li>
				<?php
				}
				?>
				<li><a href="{{ url('/admin/complaint') }}">Complaint List</a></li>
				<div class="arrow"></div>
				 </ul>
			</li>-->
			<?php 
			   }
			   if($role_id==1 || $role_id==4)
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-list "></i></span><span class="nav-label">Purchage Plan</span></a>
			      <ul>
			    <li><a href="{{ url('/admin/purchange-plan') }}">Purchase Plan List</a></li>
			    <li><a href="{{ url('/admin/purchange-plan/purchage-log') }}">Purchase Logs</a></li>
				
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
			   if(!empty($menulist) && in_array('UserRole',$menulist))
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-users "></i></span><span class="nav-label">User Role</span></a>
				<ul>
					<li><a href="{{ url('/admin/user-role/create') }}">Add User Role</a></li>
					<li><a href="{{ url('/admin/user-role') }}">User Role List</a></li>
					
					<div class="arrow"></div>
				</ul>
			</li>
			<?php 
			   }
			 if($role_id==1 )
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-list "></i></span><span class="nav-label">Testimonial</span></a>
			      <ul>
			    <li><a href="{{ url('/admin/testimonial') }}">Testimonial List</a></li>
			    <li><a href="{{ url('/admin/testimonial') }}">Add Testimonial</a></li>
				
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
       
		/* if($role_id==1 || $role_id==6 || $role_id==7 )
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-list "></i></span><span class="nav-label">Sales Leads</span></a>
			      <ul>
				
			    <li><a href="{{ url('/admin/saleslead') }}">Sales Leads</a></li>
				<?php
				if($role_id!=1 )
				{
				?>
			    <li><a href="{{ url('/admin/saleslead/create') }}">Add Sales Leads</a></li>
				<?php
				}
				?>
				<div class="arrow"></div>
				 </ul>
			</li> 
			<?php 
			   } */
			   
			   if(!empty($menulist) && in_array('UserRole',$menulist) || $role_id==7 || $role_id==6 )
			   {
			?>
			<li><a href="javascript:void(0)"><span class="nav-icon"><i class="fa fa-list "></i></span><span class="nav-label">KYC</span></a>
			      <ul>
			    <li><a href="{{ url('/admin/kyc') }}">KYC List</a></li>
				<?php
				if( $role_id==6 )
				{
				?>
			    <li><a href="{{ url('/admin/kyc/create') }}">Add KYC</a></li>
				<?php
				}	
				?>
				<div class="arrow"></div>
				 </ul>
			</li>
			<?php 
			   }
        ?>
			@endif
		 </ul>

    </div>
    
</div>