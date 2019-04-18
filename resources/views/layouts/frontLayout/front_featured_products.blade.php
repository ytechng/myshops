<div class="well well-small">
		<h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
		<div class="row-fluid">
			<div id="featured" class="carousel slide">
				<div class="carousel-inner">
						<?php $count = 1; ?>
						@foreach($newProducts->chunk(4) as $chunk)
							<div class="item <?php $count==1 ? 'active' : ''; ?>">
								<ul class="thumbnails">		
									@foreach($chunk as $item)
										<li class="span3">
											<div class="thumbnail">
												<i class="tag"></i>
												<a href="{{ url('/product/' . base64_encode($item->id)) }}">
													<img src="/images/backend_img/products/small/{{ $item->product_image }}" alt="">
												</a>
												<div class="caption">
													<h5>{{ $item->product_name }}</h5>
													<h4><a class="btn" href="{{ url('/product/' . base64_encode($item->id)) }}">VIEW</a>
														<span class="pull-right">₦{{ $item->product_price }}</span></h4>
												</div>
											</div>
										</li>	
									@endforeach				
								</ul>
							</div>
							<?php $count +=1; ?>
						@endforeach
				</div>
				<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
				<a class="right carousel-control" href="#featured" data-slide="next">›</a>
			</div>
		</div>
	</div>