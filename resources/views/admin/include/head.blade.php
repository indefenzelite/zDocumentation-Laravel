<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="{{ getSetting('seo_meta_description') }}">
<meta name="keywords" content="{{ getSetting('seo_meta_keywords') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" href="{{ getBackendLogo(getSetting('app_favicon')) }}" />

<!-- font awesome library -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

<script src="{{ asset('admin/js/app.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<!-- themekit admin template asstes -->
<link rel="stylesheet" href="{{ asset('admin/all.css?v='.rand(0, 99999)) }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/theme.css') }}">
{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('admin/plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/ionicons/dist/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/nprogress/nprogress.css') }}">

{{-- Jquery Confirm CDN--}}
{{-- Switcher --}}
<!-- Bootstrap CDN -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous"> --}}

<!-- Stack array for including inline css or head elements -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
@stack('head')

<link rel="stylesheet" href="{{ asset('admin/plugins/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/dist/summernote-bs4.css') }}">


{{-- <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/jquery-minicolors/jquery.minicolors.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">



