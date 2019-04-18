@extends('layouts.frontLayout.front_design')
@section('title', 'Home')

@section('content')
	<!-- Carousel -->
	@include('layouts.frontLayout.front_carousel')
	<!-- Carousel End====================================================================== -->

	<div id="mainBody">
		<div class="container">
			<div class="row">

				<div class="span9">
					<!-- Featured Products -->
					@include('layouts.frontLayout.front_featured_products')

					<h4>Latest Products </h4>
					<ul class="thumbnails">
						@foreach ($randomProducts as $product)
							<li class="span3">
							  <div class="thumbnail">
								<a  href="{{ url('/product/' . base64_encode($product->id)) }}"><img src="/images/backend_img/products/small/{{ $product->product_image }}" alt=""/></a>
								<div class="caption">
								  <h5>{{ $product->product_name }}</h5>
								  <p>
									{{ $product->description }}
								  </p>

									<h4 style="text-align:center">
										<a class="btn" href="{{ url('/product/' . base64_encode($product->id)) }}"> 
											<i class="icon-zoom-in"></i>
										</a> 
										<a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
										<a class="btn btn-primary" href="#">₦{{ $product->product_price }}</a></h4>
								</div>
							  </div>
							</li>
						@endforeach
					</ul>
				</div>

				<!-- Sidebar ================================================== -->
				@include('layouts.frontLayout.front_sidebar')
				<!-- Sidebar end=============================================== -->

			</div>
		</div>
	</div>
@endsection