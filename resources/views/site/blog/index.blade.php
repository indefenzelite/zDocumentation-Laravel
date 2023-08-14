@extends('layouts.app')
@section('meta_data')
    @php
		$meta_title =  @$metas->title ?? 'Blogs';		
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
        <div class="container mt-5">
            <div class="row">
                
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4 pb-2 d-flex align-items-stretch">
                        <div class="card blog blog-primary rounded border-0 shadow overflow-hidden w-100">
                            <div class="position-relative">
                                <img src="{{ $blog->getFirstMediaUrl('description_banner') }}" class="card-img-top" alt="Blog Image" style="height: 235px;">
                            </div>
                            <div class="card-body content">
                                <h5><a href="{{ route('blog.show',$blog->slug) }}" class="card-title title text-dark">{{ $blog->title }}</a></h5>
                                {{-- {!! Str::limit($blog->description,10) !!} --}}
                                {{-- <div class="post-meta mt-3">
                                    {!! Str::limit($blog->description,10) !!}
                                </div> --}}
                            </div>
                            <div class="author">
                                <small class="user d-block"><i class="uil uil-user me-1"></i>Admin</small>
                                <small class="date"><i class="uil uil-calendar-alt me-1"></i>{{ ($blog->created_at) }}</small>
                            </div>
                        </div>
                    </div><!--end col-->
                   @empty
                    @php
                        $empty_msg = 'No Blogs Published Yet!';
                    @endphp
                    <div class="col-lg-8 mx-auto text-cemter">
                        @include('site.empty')
                    </div>
                @endforelse
                <!-- PAGINATION START -->
               <div class="text-center mt-3">
                {{ $blogs->links() }}
               </div>
                <!-- PAGINATION END -->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Blog End -->
@endsection