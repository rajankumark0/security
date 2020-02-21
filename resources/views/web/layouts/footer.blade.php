<footer>
		<div class="container">
			<div class="banner">
				<div class="row">
					<div class="col-lg-5 col-md-12 col-sm-12 col-12">
						<div class="limit-text footer-box">
							<p>ASQARI WORLD LIMITED REG NO. PVT-3QUKM8L</p>
							<a href="#">info@asqariworld.com</a>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="social-link footer-box">
							<a target="_blank" title="Facebook" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/face.png')}}" alt="">
							</a>
							<a target="_blank" title="Twitter" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/twitter.png')}}" alt="">
							</a>
							<a target="_blank" title="Pinterest" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/pinterest.png')}}" alt="">
							</a>
							<a target="_blank" title="Instagram" href="#">
								<img class="img-fluid" src="{{ URL::asset('images/instagram.png')}}" alt="">
							</a>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="footer-link footer-box">
							<a href="{{url('/page/legal')}}">Legal </a><span>|</span>
							<a href="{{url('/page/privacy')}}">Privacy </a><span>|</span>
							<a href="{{url('/page/security')}}">Security</a><span>|</span>
							<a href="{{url('/faq')}}">Faq</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <script src="{{ URL::asset('js/script.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js/owl.carousel.js')}}"></script>
	<script src="{{ URL::asset('js/lightbox-plus-jquery.min.js')}}"></script>

	<script>
	 $=jQuery;
        $(document).ready(function () {
            $(".inputLableUp").focus(function () {
                if ($(this).val() == '') {
                    $(this).parent().removeClass('lableup');
                } else {
                    $(this).parent().addClass('lableup');
                }
            }).blur(function () {
                if ($(this).val() == '') {
                    $(this).parent().removeClass('lableup');
                } else {
                    $(this).parent().addClass('lableup');
                }
            });
            
            $(".account").click(function () {
                $(".signboxInner").show();
                $(".loginboxInner").hide();
                $(".resetPassword").hide();

            });

            $(".accountlogin").click(function () {
                $(".signboxInner").hide();
                $(".resetPassword").hide();
                $(".loginboxInner").show();
            });

            /*$(".forget").click(function () {
                $(".signboxInner").hide();
                $(".resetPassword").show();
                $(".loginboxInner").hide();
            });*/
            $(".backtoLogin").click(function () {
                $(".signboxInner").hide();
                $(".resetPassword").hide();
                $(".loginboxInner").show();
            });

        });
        function openNavR() {
            document.getElementById("mySidenavR").style.width = "100%";
        }

        function closeNavR() {
            document.getElementById("mySidenavR").style.width = "0";
        }



    </script>
	<script>
	$('.user-banner').owlCarousel({
			   loop: true,
			   margin: 10,
			   nav: true,
			   dots: false,
			   autoplaySpeed: 2000,
			   dotsSpeed: 3000,
			   responsive: {

				   320: {
					   items: 1
				   },
				   580: {
					   items: 2
				   },
				   992: {
					   items: 2
				   },
				   1000: {
					   items: 4
				   }
			   }
		   });
	</script>
	

</body>
</html>