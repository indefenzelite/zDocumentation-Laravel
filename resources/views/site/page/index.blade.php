@extends('layouts.app')

@section('meta_data')
    @php
		$meta_title =  ($page->page_meta_title) ? $page->page_meta_title : getSetting('app_name');		
		$meta_description = ($page->page_meta_description) ? $page->page_meta_description : '';		
		$meta_keywords = ($page->page_keywords) ? $page->page_keywords : getSetting('app_name');		
		$meta_motto = (false) ? $page->page_keywords : getSetting('app_name');		
	@endphp
@endsection

@section('content')ˀ
    <!--Shape End-->  
    <!-- Start Terms & Conditions -->
    <section class="section bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 rounded">
                        <div class="card-body">
                            <h1>
                                {!! $page->title !!}
                            </h1>
                            
                            @if($page->getFirstMediaUrl('page_meta_image') != null)
                             <img style="width: 100%; height: 300px; object-fit: contain;" src="{{$page->getFirstMediaUrl('page_meta_image')}}" alt="">
                            @endif

                            @if($page->meta['description'] != null)
                            <blockquote class="blockquote mt-3 p-3">
                                <p class="text-muted mb-0 fst-italic">
                                    {{@$page->meta['description']}}
                                </p>
                            </blockquote>
                            @endif

                            <div>
                                {!! $page->content !!}
                            </div>

                            <div class="post-meta mt-3">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item me-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="uil uil-clock me-1"></i>{{$page->formatted_updated_at}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Terms & Conditions -->

    
@endsection