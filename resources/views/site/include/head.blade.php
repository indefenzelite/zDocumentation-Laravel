   
	<title> {{ @$meta_title ?? getSetting('seo_meta_title') }} </title>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="description" content="{{ @$meta_description ?? getSetting('seo_meta_description') }}">
    <meta name="keywords" content="{{ @$meta_keywords }}">
    <meta name='subject' content='{{@$meta_motto}}'>
    <meta name='copyright' content='{{env('APP_NAME')}}'>
    <meta name='language' content='IN'>
    <meta name='robots' content='index,follow'>
    <meta name='abstract' content='@isset($meta_abstract){{$meta_abstract}}@endisset'>
    <meta name='topic' content='Business'>
    <meta name='summary' content='{{@$meta_motto}}'>
    <meta name='Classification' content='Business'>
    <meta name='author' content='@isset($meta_author_name){{$meta_author_email}}@endisset'>
    <meta name='designer' content='Defenzelite'>
    <meta name='reply-to' content='@isset($meta_author_name){{$meta_author_name}}@endisset'>
    <meta name='owner' content='@isset($meta_reply_to){{$meta_reply_to}}@endisset'>
    <meta name='url' content='{{url()->current()}}'>

    <meta name="og:title" content="{{ @$meta_title }}"/>
    <meta name="og:type" content="{{@$meta_motto}}"/>
    <meta name="og:url" content="{{url()->current()}}"/>
    <meta name="og:image" content="@isset($meta_img){{$meta_img}}@endisset"/>
    <meta name="og:site_name" content="{{env('APP_NAME')}}"/>
    <meta name="og:description" content="{{ @$meta_description ?? getSetting('seo_meta_description') }}"/>

    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ getBackendLogo(getSetting('app_favicon'))}}"/>
    <!-- Css -->
     <!-- Style Css-->
     @stack('head')
     <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}" >
     <link href="https://fonts.googleapis.com/css?family=Heebo:300,400" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{ asset('site/assets/css/main.css') }}">
     {{-- <script src="{{asset('user/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
     {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}"> --}}
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" referrerpolicy="no-referrer" /> --}}

    
    {{-- Dynamic CSS Before Head --}}
    @if(getSetting('custom_header_style') != 0)
     <link rel="stylesheet" href="{!! getSetting('custom_header_style') !!}"/> 
    @endif
    
    <style>
        .alert {
            position: relative;
            padding: 0.75rem 1.7rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.3125rem;
            font-weight: 500;
        }

    .alert-dismissible {
        padding-right: 4rem;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.75rem 1.25rem;
        color: inherit;
    }
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    </style>
    