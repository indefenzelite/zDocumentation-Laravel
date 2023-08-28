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
                <form action="{{route('search')}}" class="uk-search uk-search-default uk-width-1-1" name="search-hero" id="search-hero-form">
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
<div class="uk-section" style="padding-top:20px;">
    <div class="uk-container">
        <div class="row" id="post">
            <div class="col-md-6 mx-auto">
                @if ($faqs->count() != 0)
                    <small class="text-muted mb-2">{{$faqs->count()}} Results Found</small>
                    <br>
                @endif
                <div class="uk-card p-0">
                    <ul class="list-unstyled mt-0 ">
                        @forelse($faqs as  $faq)
                        <li>
                            <ul class="list-unstyled" style="text-align:left;">
                                
                                    <a href="{{route('faqs.index',[$faq->id,'category_id' => $faq->category_id]) }}">
                                        <li>
                                            <span class="text-success fw-600 mb-1">{{$faq->title}}</span>
                                        </li>
                                    </a>
                            
                            </ul>
                        </li>
                         @empty
                           <li><span class="text-center text-success d-flex justify-content-center">No Data Found!</span></li> 
                        @endforelse
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