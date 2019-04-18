@extends('layouts.frontLayout.front_design')
@section('title', 'Products')

@section('content')

	<div id="mainBody">
		<div class="container">
			<div class="row">

				<div class="span9">
					<ul class="breadcrumb">
						<li><a href="index.html">Home</a> <span class="divider">/</span></li>
						<li class="active">{{ $category->name }}</li>
					</ul>
					<h3> {{ $category->name }} <small class="pull-right"> 40 products are available </small></h3>
					<hr class="soft"/>
					<p>
						{{ $category->description }}
					</p>
					<hr class="soft"/>
					<form class="form-horizontal span6">
						<div class="control-group">
						  <label class="control-label alignL">Sort By </label>
							<select>
							  <option>Priduct name A - Z</option>
							  <option>Priduct name Z - A</option>
							  <option>Priduct Stoke</option>
							  <option>Price Lowest first</option>
							</select>
						</div>
					</form>

					<div id="myTab" class="pull-right">
					 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
					 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
					</div>
					<br class="clr"/>
					<div class="tab-content">
						<div class="tab-pane" id="listView">
							@foreach ($products as $product)
								<div class="row">
									<div class="span2">
										<img src="/images/backend_img/products/small/{{ $product->product_image }}" alt=""/>
									</div>
									<div class="span4">
										<h3>New | Available</h3>
										<hr class="soft"/>
										<h5>{{ $product->product_name }} </h5>
										<p>
											{{ $product->description }}
										</p>
										<a class="btn btn-small pull-right" href="{{ url('/products/' . base64_encode($category->id)) }}">View Details</a>
										<br class="clr"/>
									</div>
									<div class="span3 alignR">
									<form class="form-horizontal qtyFrm">
									<h3> ₦{{ $product->product_price }}</h3>
									<label class="checkbox">
										<input type="checkbox">  Adds product to compair
									</label><br/>

									  <a href="{{ url('/products/' . base64_encode($category->id)) }}" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
									  <a href="{{ url('/products/' . base64_encode($category->id)) }}" class="btn btn-large"><i class="icon-zoom-in"></i></a>

										</form>
									</div>
								</div>
								<hr class="soft"/>
							@endforeach
						</div>

						<div class="tab-pane  active" id="blockView">
								<ul class="thumbnails">
									@foreach ($products as $product)
										<li class="span3">
											<div class="thumbnail">
												<a href="{{ url('/product/' . base64_encode($product->id)) }}"><img src="/images/backend_img/products/small/{{ $product->product_image }}" alt=""/></a>
												<div class="caption">
													<h5>{{ $product->product_name }}</h5>
													<p>
														{{ $product->description }}
													</p>
													<h4 style="text-align:center"><a class="btn" href="{{ url('/product/' .base64_encode($product->id)) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">₦{{ $product->product_price }}</a></h4>
												</div>
											</div>
										</li>
									@endforeach
							  </ul>
								<hr class="soft"/>
						</div>
					</div>

					<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
					<div class="pagination">
						<ul>
						<li><a href="#">&lsaquo;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">...</a></li>
						<li><a href="#">&rsaquo;</a></li>
						</ul>
					</div>
						<br class="clr"/>
				</div>

				<!-- Sidebar ================================================== -->
				@include('layouts.frontLayout.front_sidebar')
				<!-- Sidebar end=============================================== -->

			</div>
		</div>
	</div>
@endsection