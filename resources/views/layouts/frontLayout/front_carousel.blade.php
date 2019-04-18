<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			@if (count($banners) > 0)
				@foreach ($banners as $key => $banner)
				<div class="item {{ $key == 0 ? 'active' : '' }}">
					<div class="container">
						<a href="register.html"><img style="width:100%" src="/images/frontend_img/banners/{{ $banner->image }}"
								alt="special offers" /></a>
						<div class="carousel-caption">
							<h4>{{ $banner->title }}</h4>
							<p>{{ $banner->description }}</p>
						</div>
					</div>
				</div>
				@endforeach
			@endif
		</div>
		@if (count($banners) > 0)
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
		@endif
	</div>
</div>