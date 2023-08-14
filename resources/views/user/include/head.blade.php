
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

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" href="{{  getBackendLogo(getSetting('app_favicon'))}}" />
<!-- Css -->
 <!-- Style Css-->
 <link href="{{asset('user/assets/css/style.min.css')}}" class="theme-opt" rel="stylesheet" type="text/css" />
<link href="{{asset('user/assets/libs/tiny-slider/tiny-slider.css')}}" rel="stylesheet">
<link href="{{asset('user/assets/css/bootstrap.min.css')}}" class="theme-opt" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('user/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('user/assets/libs/@iconscout/unicons/css/line.css')}}" type="text/css" rel="stylesheet" />


<link rel="stylesheet" href="{{ asset('admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">

<link rel="stylesheet" href="{{ asset('user/assets/css/ct-ultimate-gdpr.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">   
