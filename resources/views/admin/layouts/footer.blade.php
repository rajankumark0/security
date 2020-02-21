  <footer class="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="footer-left">
                    <span>&copy; 2019 <a href="#">WPS</a></span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="footer-right">
                    <span class="footer-meta">Crafted with&nbsp;<i class="fa fa-heart"></i>&nbsp;by&nbsp;<a href="#">WPS</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div>



<script src="{{ URL::asset('backend/js/jquery-1.11.2.min.js')}}"></script>

<script src="{{ URL::asset('backend/js/jquery-migrate-1.2.1.min.js')}}"></script>

<script src="{{ URL::asset('backend/js/jRespond.min.js')}}"></script>

<script src="{{ URL::asset('backend/js/bootstrap.min.js')}}"></script>

<script src="{{ URL::asset('backend/js/nav-accordion.js')}}"></script>

<script src="{{ URL::asset('backend/js/hoverintent.js')}}"></script>

<script src="{{ URL::asset('backend/js/waves.js')}}"></script>

<script src="{{ URL::asset('backend/js/switchery.js')}}"></script>

<script src="{{ URL::asset('backend/js/jquery.loadmask.js')}}"></script>

<script src="{{ URL::asset('backend/js/icheck.js')}}"></script>

<script src="{{ URL::asset('backend/js/select2.js')}}"></script>

<script src="{{ URL::asset('backend/js/bootstrap-filestyle.js')}}"></script>

<script src="{{ URL::asset('backend/js/bootbox.js')}}"></script>

<script src="{{ URL::asset('backend/js/animation.js')}}"></script>

<script src="{{ URL::asset('backend/js/colorpicker.js')}}"></script>

<script src="{{ URL::asset('backend/js/bootstrap-datepicker.js')}}"></script>

<script src="{{ URL::asset('backend/js/sweetalert.js')}}"></script>

<script src="{{ URL::asset('backend/js/moment.js')}}"></script>

<script src="{{ URL::asset('backend/js/calendar/fullcalendar.js')}}"></script>

<script src="{{ URL::asset('backend/js/calendar/fullcalendar.js')}}"></script>

<script src="{{ URL::asset('backend/js/smart-resize.js')}}"></script>
<script src="{{ URL::asset('backend/js/layout.init.js')}}"></script>

<script src="{{ URL::asset('backend/js/matmix.init.js')}}"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<script> 
$=jQuery;
        $(".des-bord-profile a").click(function () {
            $(".des-dropdown").slideToggle("1000");

        });
</script>
<script> 
 $=jQuery;
//var today = new Date("Y-m-d");
  $('#to_date').datepicker({ 
	dateFormat:'yy-mm-dd'
	});	
	
	$('#from_date').datepicker({ 
	dateFormat:'yy-mm-dd',
	
	
	});	
 </script> 

@yield('footer_script')



</body>
</html>