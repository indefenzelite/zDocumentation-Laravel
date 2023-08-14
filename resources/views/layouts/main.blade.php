<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>
		@yield('title','') | {{ getSetting('app_name') }}
	</title>
	<!-- initiate head with meta tags, css and script -->
	@include('admin.include.head')
</head>

<body id="app">
	<div class="wrapper">
		{{-- @if(!request()->routeIs('panel.setting.maintanance') == true) --}}
			@include('admin.include.header')
			<div class="page-wrap">
				<!-- initiate sidebar-->
				@include('admin.include.sidebar')
				<div class="main-content">
					@include('admin.include.logged-in-as')
					<!-- yeild contents here -->
					@yield('content')
				</div>
				<!-- initiate footer section-->
				@include('admin.include.footer')
			</div>
		{{-- @endif --}}
    </div>
    
	<!-- initiate modal menu section-->
	@include('admin.include.modalmenu')

	<!-- initiate scripts-->
	@include('admin.include.script')	
</body>
</html>