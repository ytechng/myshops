<div id="sidebar" class="span3">
		<div class="well well-small">
			<a id="myCart" href="product_summary.html">
				<img src="/images/frontend_img/ico-cart.png" alt="cart">3 Items in your cart
				<span class="badge badge-warning pull-right">$155.00</span>
			</a>
		</div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<?php $count = 1; ?>
			@foreach ($categories as $key => $category)
				@if (count($category->categories) == 0) 
					<li><a href="{{ url('/products/' . $category->url) }}">{{ strtoupper($category->name) }} [230]</a>
				@else
					<li class="subMenu {{ $key == 0 ? 'open' : '' }}"><a> {{ strtoupper($category->name) }} [230]</a>
						<ul {{ $key > 0 ? 'style=display:none' : '' }}>
							@foreach ($category->categories as $subCategory)
								<li><a class="{{ Request::is($category->url) ? 'active' : '' }}" href="{{ url('/products/' . $subCategory->url) }}">
									<i class="icon-chevron-right"></i>{{ $subCategory->name }} (100) </a>
								</li>
							@endforeach
						</ul>
					</li>
				@endif
				<?php $count += 1; ?>
			@endforeach
		</ul>
		<br/>

		@foreach($sidebarProducts as $sbp)
			<div class="thumbnail">
				<a href="{{ url('/product/' .base64_encode($sbp->id)) }}">
					<img src="/images/backend_img/products/small/{{ $sbp->product_image }}" alt="{{ $sbp->product_name }}"/>
				</a>
				<div class="caption">
					<h5>{{ $sbp->product_name }}</h5>
					<h4 style="text-align:center">
						<a class="btn" href="#"> <i class="icon-zoom-in"></i></a> 
						<a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
						<a class="btn btn-primary" href="#">₦{{ $sbp->product_price }}</a></h4>
				</div>
			</div><br/>
		@endforeach

		<div class="thumbnail">
			<img src="/images/frontend_img/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
			<div class="caption">
				<h5>Payment Methods</h5>
			</div>
			</div>
	</div>