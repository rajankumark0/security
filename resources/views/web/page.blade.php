@include('web.layouts.header')
   <div  class="page-title">
       
            <div class="container text-left">
                <a href="{{ url('/') }}"><i class="lni-home"></i>Home</a>
                <span class="crumbs-spacer"><i class="lni-chevron-right"></i></span>
                <span class="current">{{ $page->name }} </span>
            </div>
       
    </div>
	<section class="pange-container">
		<div class="container">
			
				<div class="row">
					<div class="col-lg-12 col-md-12">
					     {!! $page->description !!}
					</div>
				</div>
			
		</div>
	</section>
	
@include('web.layouts.footer')
