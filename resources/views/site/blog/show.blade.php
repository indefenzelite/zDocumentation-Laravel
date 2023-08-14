@extends('layouts.app')
@section('meta_data')
    @php
		$meta_title = $blog->seo_title.' | '.getSetting('app_name');		
		$meta_description = $blog->short_description ?? getSetting('seo_meta_description');
		$meta_keywords = $blog->seo_keywords ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('app_email');		
		$meta_img = ' ';		
	@endphp
    
@endsection
@push('head')
<link rel="stylesheet" href="{{ asset('admin/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
@endpush
@section('content')
    <!-- Shape Start -->
    <div class="position-relative">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!--Shape End-->

    <!-- Blog STart -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- BLog Start -->
                <div class="col-lg-10 col-md-12 mx-auto">
                    <div class="card blog blog-detail border-0 shadow rounded">
                        @if($blog->getMedia('description_banner')->count() > 0)
                        <div class="owl-carousel" id="blog-slider">
                            @foreach ($blog->getMedia('description_banner') as $media)
                            <div class="item">
                                <img src="{{ $media->getUrl() }}" class="rounded-top blog-image" alt="">
                            </div>
                            @endforeach
                        </div>
                        @endif
                        {{-- @if($blog->getFirstMediaUrl('description_banner') !== "")
                            <img src="{{ $blog->getFirstMediaUrl('description_banner') }}" class="rounded-top blog-image" alt="">
                        @endif
                        @if($blog->getMedia('description_banner')->count() > 1)
                        <div class="d-flex flex-wrap">
                            @foreach ($blog->getMedia('description_banner')->skip(1) as $media)
                            <div>
                                <img id="description_banner_img" src="{{ $media->getUrl() }}"class="mt-3" style="border-radius: 10px;width:200px;height:150px;"/>
                            </div>
                            @endforeach
                        </div>
                        @endif --}}
                        <div class="card-body content">
                            <h6>
                                <a href="javscript:void(0)" class="text-dark fw-bolder">{{ $blog->title }}</a>
                            </h6>
                            <blockquote class="blockquote mt-3 p-3">
                                <p class="text-muted mb-0 fst-italic">{!!$blog->short_description !!}</p>
                            </blockquote>
                            <p class="text-muted">{!! $blog->description !!}</p>
                            <div class="post-meta mt-3">
                            </div>
                        </div>

                        
                        <div class="p-4">
                            <hr>
                            <p class="text-muted h6 fst-italic">{{ $blog->user->bio ?? '--' }}</p>
                            <div class="d-flex">
                               <div>
                                 <img src="{{$blog->user && $blog->user->avatar ? $blog->user->avatar : asset('frontend/assets/avatar.png')}}" class="img-fluid avatar avatar-ex-small rounded-circle" alt="">
                               </div>
                                <div class="ms-1">
                                    <h6 class="text-muted mt-2"> {{ $blog->user->first_name ?? ''}} 
                                        <small class="text-muted">{{ $blog->user->occupation ?? ''}}</small>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BLog End -->


                <div class="col-10 mx-auto">
                    <div class="card shadow rounded border-0 mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Related Posts :</h5>
                            <div class="row">
                               @foreach($relatedPosts as $relatedPost)
                               <div class="col-lg-6 mt-4 pt-2 d-flex align-items-stretch">
                                    <div class="card blog blog-primary rounded border-0 shadow">
                                        <div class="position-relative">
                                            <img src="{{ getBlogImage($relatedPost->description_banner) }}" class="card-img-top rounded-top" alt="...">
                                        <div class="overlay rounded-top"></div>
                                        </div>
                                        <div class="card-body content">
                                            <h5><a href="{{route('blog.show',$relatedPost->slug) }}" class="card-title title text-dark">{{$relatedPost->title }}</a></h5>
                                            <div class="post-meta d-flex justify-content-between mt-3">
                                                <a href="{{ route('blogs') }}" class="text-muted readmore">Read More <i class="uil uil-angle-right-b align-middle"></i></a>
                                            </div>
                                        </div>
                                        <div class="author">
                                            <small class="user d-block"><i class="uil uil-user"></i>{{$relatedPost->user->full_name ?? ''}}</small>
                                            <small class="date"><i class="uil uil-calendar-alt"></i> {{ $relatedPost->formatted_created_at}}</small>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                                <!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
                <!-- END SIDEBAR -->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Blog End -->
  
@endsection 
@push('script')
<script src="{{ asset('admin/plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
<script>
        $('#blog-slider').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay:true,
            nav: false,
            loop: true
        });
    document.querySelectorAll( 'oembed[url]' ).forEach( element => {
        // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
        // to discover the media.
        const anchor = document.createElement( 'a' );

        anchor.setAttribute( 'href', element.getAttribute( 'url' ) );
        anchor.className = 'embedly-card';

        element.appendChild( anchor );
    } );
</script>
@endpush