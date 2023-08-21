@extends('layouts.app')

@section('meta_data')
 @php
	$meta_title = getSeoData('home')->title ?? ''.' | '.getSetting('app_name');
    $meta_description = getSeoData('home')->description ?? '';
    $meta_keywords = getSeoData('home')->keyword ?? '';
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('app_email');
    $meta_img = ' ';	
	@endphp
@endsection
<style>
   .fw-600{
        font-weight: 600;
   }

</style>
@section('content')
<!-- Hero Start -->
<div class="uk-section section-hero uk-position-relative uk-scrollspy-inview uk-animation-slide-bottom-medium"
    style="padding-bottom: 0px; padding-top: 25px;"
    data-uk-scrollspy="cls: uk-animation-slide-bottom-medium; repeat: true">
    <div class="uk-container uk-container-small mt-3">
        <h2 class="uk-h1 uk-text-center"><span class="text-success">Gbooks</span> Documentation</h2>
        <div class="hero-search">
            <div class="uk-position-relative">
                <form action="{{route('index')}}" class="uk-search uk-search-default uk-width-1-1" name="search-hero" id="search-hero-form">
                    <span class="uk-search-icon-flip text-success uk-icon uk-search-icon" ><svg
                            width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            data-svg="search-icon">
                            <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle>
                            <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path>
                        </svg></span>
                    <input id="search-hero" class="uk-search-input uk-box-shadow-large" name="search" type="search" value="{{request()->get('search')}}"
                        placeholder="Type your question..." autocomplete="off" value="" 
                        data-maxitems="30">
                        <button type="submit" class="d-none"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end section-->
<div class="uk-section" style="padding-top:40px;">
    <div class="uk-container">
        <div class="row" id="post">
            {{-- @foreach($categories as $key => $category)
            <div class="col-md-3" style="">
                <div class="uk-card p-0">
                    <small class="text-muted mb-0">{{$category->name}}</small>
                    <ul  class="pl-11 mt-0 list-unstyled">
                        @if($category->latestChildrenCategory != null)
                        @foreach(@$category->childrenCategories as $sub_category)
                         <li class="uk-margin">
                            <span class="mb-0 text-muted">{{@$sub_category->name}}</h6>
                            <ul class="uk-nav uk-nav-default  side_menu" style="text-align:left;">
                                @foreach ($sub_category->categories as $item)
                                    <ul class="pl-10">
                                        <li>
                                            @foreach ($sub_category->childrenCategories as $sub_sub_category)
                                                @php
                                                    $faqs = App\Models\Faq::where('category_id',$category->id)->where('sub_category_id',$sub_category->id)->where('sub_sub_category_id',$sub_sub_category->id)->take(18)->get();
                                                @endphp
                                                <h6 class="mb-0 text-muted"> {{$sub_sub_category->name}}</h6> 
                                                <ul class="" style="text-align:left;">
                                                    @foreach($faqs as $faq)
                                                        <a href="{{route('faqs.index',[$category->id,$sub_category->id,$faq->id]) }}">
                                                            <li>
                                                                <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                                            </li>
                                                        </a>
                                                    @endforeach
                                                </ul>
                                                @if(@$faqs->count() >= 5)
                                                    <a class="text-success fw-700 text-center" type="submit" href="{{ route('faqs.index',[$category->id,$sub_category->id]) }}">
                                                        <i>View more..</i>
                                                    </a> 
                                                @endif
                                            @endforeach
                                        </li>
                                    </ul>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                      @else
                         --   
                     @endif 
                      
                    </ul>
                  
                </div>     
            </div>
            @endforeach --}}
            <div class="col-md-4">
                <div class="uk-card p-0">
                    <small class="text-muted mb-0">Login/Registration</small>
                    <ul class="list-unstyled pl-10 mt-0">
                        <li>
                            @php
                                $faqs = App\Models\Faq::where('category_id',104)->take(18)->get();
                            @endphp
                            <ul class="list-unstyled" style="text-align:left;">
                                @foreach($faqs as $faq)
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="uk-card p-0">
                    <small class="text-muted mb-0">Support Ticket</small>
                    <ul class="list-unstyled pl-10 mt-0">
                        <li>
                            @php
                                $faqs = App\Models\Faq::where('category_id',102)->take(18)->get();
                            @endphp
                            <ul class="list-unstyled" style="text-align:left;">
                                @foreach($faqs as $faq)
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>  
                
                <div class="uk-card p-0">
                    <small class="text-muted mb-0">Items</small>
                    <ul class="list-unstyled pl-10 mt-0">
                        <li>
                            @php
                                $faqs = App\Models\Faq::where('category_id',44)->take(18)->get();
                            @endphp
                            <ul class="list-unstyled" style="text-align:left;">
                                @foreach($faqs as $faq)
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>  
            </div>
            <div class="col-md-4">

                @php
                    $sales_scoped_arr = [68,69,70,71,66,67,72];
                    $sales_scoped = \App\Models\Category::whereIn('id',$sales_scoped_arr)->get();

                @endphp

                <div class="uk-card p-0">
                    <small class="text-muted mb-0">Sales</small>
                    <ul class="list-unstyled pl-10 mt-0">
                        <li>
                            @php
                                $faqs = App\Models\Faq::where('category_id',45)->take(18)->get();
                            @endphp
                            <ul class="list-unstyled" style="text-align:left;">
                                @foreach($faqs as $faq)
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>  
            </div>
            <div class="col-md-4">
                <div class="uk-card p-0">
                    <small class="text-muted mb-0">Purchase</small>
                    <ul class="list-unstyled pl-10 mt-0">
                        <li>
                            @php
                                $faqs = App\Models\Faq::where('category_id',46)->take(18)->get();
                            @endphp
                            <ul class="list-unstyled" style="text-align:left;">
                                @foreach($faqs as $faq)
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Hero End -->
@push('script')
    
    <script>
        	$(document).ready(function() {
            $('#search-hero').on('change', function() {
                $('#search-hero-form').submit();
          });
        });
	  
    </script>
    
@endpush