<!DOCTYPE html>
<html lang="en">
<head>
	@yield('meta_data')
   @include('user.include.head')
</head>

<body style="background: aliceblue !important">
	<div>
		<!-- initiate header-->
		@include('user.include.header')
			<div class="main-content pl-0 ">
				@yield('content')
			</div>
			 <!-- Back to top -->
			<a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i data-feather="arrow-up" class="fea icon-sm icons align-middle"></i></a>
			@if (!isset($customer))
				@include('user.include.footer')
			@else
				@include('user.include.footer_bar')
			@endif
	</div>
	
	<!-- initiate scripts-->
	@include('user.include.script')	
	@stack('script')
</body>
</html>