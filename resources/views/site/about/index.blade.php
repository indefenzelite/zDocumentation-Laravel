@extends('layouts.app')

@section('meta_data')
    @php
		$meta_title =  @$metas->title ?? 'About';		
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

<!-- About Start -->
    {{-- section new --}}
    <section class="section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-12 col-md-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                    <div class="section-title ms-lg-4">
                        <div>
                            <h2>{!!$contents['about_title'] ?? ''!!}</h2>
                            {!! $contents['about_description'] ?? '' !!}
                            
                          </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    {{-- end now --}}
@endsection