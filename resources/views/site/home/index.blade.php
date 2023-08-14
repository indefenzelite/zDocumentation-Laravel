@extends('layouts.app')

@section('meta_data')
    @php
		$meta_title =  @$metas->title ?? 'Home';		
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
    @media (max-width: 576px) {
    .align {
        /* Adjust the slider's layout for small screens */
        height: 40vh !important;
        width: 360px;
        /* For example, you can set a specific width or height, change the positioning, etc. */
    }
}
</style>
@section('content')
      <!-- Hero Start -->
        <section class="bg-half-170 d-table w-100">
            <div class="container">
                <div class="row mt-2 align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <div class="title-heading me-lg-4">
                            <h1 class="heading">
                                {!! getTextWrapped($contents['home_title'] ?? '', 'text-primary') !!}
                            </h1>
                            <p class="para-desc text-muted">
                                {!! $contents['home_description'] ?? '' !!}
                            </p>
                            <div class="mt-4">
                                <a href="{{url('login')}}" class="btn btn-primary mt-2 me-2">Get Started!</a>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-5 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <img class="align" style="height: 65vh;" src="https://images.unsplash.com/photo-1517960413843-0aee8e2b3285?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1798&q=80" alt="">
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
<!-- Hero End -->   


@endsection