<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MyShop - @yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		@include('layouts.frontLayout.front_style')
	</head>

	<body>
		<!-- Header -->
		@include('layouts.frontLayout.front_header')
		<!-- Header End====================================================================== -->

		@yield('content')

		<!-- Footer ================================================================== -->
		@include('layouts.frontLayout.front_footer')
		@include('layouts.frontLayout.front_scripts')
</body>
</html>