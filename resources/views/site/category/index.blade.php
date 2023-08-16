@extends('layouts.app')

@section('meta_data')
@php
    $meta_title = @$metas->title ?? 'Home';
    $meta_description = @$metas->description ?? '';
    $meta_keywords = @$metas->keyword ?? '';
    $meta_motto = @$app_settings['site_motto'] ?? '';
    $meta_abstract = @$app_settings['site_motto'] ?? '';
    $meta_author_name = @$app_settings['app_name'] ?? 'Defenzelite';
    $meta_author_email = @$app_settings['frontend_footer_email'] ?? 'dev@defenzelite.com';
    $meta_reply_to = @$app_settings['frontend_footer_email'] ?? 'dev@defenzelite.com';
    $meta_img = ' ';
@endphp
@endsection
<style>

</style>
@section('content')
<!-- Hero Start -->
<div class="uk-section section-hero uk-position-relative uk-scrollspy-inview uk-animation-slide-bottom-medium"
    style="padding-bottom: 0px; padding-top: 25px;"
    data-uk-scrollspy="cls: uk-animation-slide-bottom-medium; repeat: true">
    <div class="uk-container uk-container-small mt-3">
        <h2 class="uk-h1 uk-text-center">Sub category</h2>

        <div class="hero-search">
            <div class="uk-position-relative">
                <form class="uk-search uk-search-default uk-width-1-1" name="search-hero" onsubmit="return false;">
                    <span class="uk-search-icon-flip text-danger uk-icon uk-search-icon" data-uk-search-icon=""><svg
                            width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            data-svg="search-icon">
                            <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle>
                            <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path>
                        </svg></span>
                    <input id="search-hero" class="uk-search-input uk-box-shadow-large" type="search"
                        placeholder="Search for Categories" autocomplete="off" value="" data-minchars="1"
                        data-maxitems="30">
                </form>
            </div>
        </div>
    </div>
</div>
<!--end section-->
<div class="uk-section" style="padding-top:0">
    <div class="uk-container uk-container-xsmall  mt-4" id="blog_post">
        @foreach($sub_categories as $key => $sub_category)
        <div class="uk-card uk-card-default uk-box-shadow-small uk-box-shadow-hover-medium card-post uk-inline 
        border-radius-medium border-xlight uk-width-1-1 uk-margin" style="margin-top:0px!important;">
        <div class="d-flex justify-content-between">
            <div class="uk-card-header pt-3 pl-2">
                <div class="uk-grid-small uk-flex-middle uk-grid uk-grid-stack" data-uk-grid="">
                    <div class="uk-width-expand uk-first-column">
                                <a href="{{ route('faqs.index',[$category_id,$sub_category->id,'id' => @$sub_category->latestCategory->id]) }}">
                                    <h3 class="uk-card-title uk-margin-remove-bottom">{{$sub_category->name}}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end mt-3">
                        <a href="#" class="text-end">
                            <img src="{{$sub_category->icon}}"
                                alt="Image" srcset="" class="" style="padding-right: 5px;">
                        </a>
                    </div>

                </div>
              @foreach ($sub_category->categories as $item)
                <div class="uk-card-body">
                    {{$item->name}}
                </div>
                  
              @endforeach
            </div>
            
        @endforeach
    </div>
</div>

<!-- Hero End -->


@endsection
