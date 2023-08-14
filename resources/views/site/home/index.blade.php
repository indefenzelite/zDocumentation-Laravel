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
      <div class="uk-section section-hero uk-position-relative uk-scrollspy-inview uk-animation-slide-bottom-medium" style="padding-bottom: 0px; padding-top: 25px;" data-uk-scrollspy="cls: uk-animation-slide-bottom-medium; repeat: true">
        <div class="uk-container uk-container-small mt-3">
            <h2 class="uk-h1 uk-text-center">Browse Standards</h2>
            <p class="uk-text-lead uk-text-center text-danger">Integrate your enterprise with corporate standards.</p>
            <div class="hero-search">
                <div class="uk-position-relative">
                    <form class="uk-search uk-search-default uk-width-1-1" name="search-hero" onsubmit="return false;">
                        <span class="uk-search-icon-flip text-danger uk-icon uk-search-icon" data-uk-search-icon=""><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search-icon"><circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle><path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></span>
                        <input id="search-hero" class="uk-search-input uk-box-shadow-large" type="search" placeholder="Search for Standards" autocomplete="off" value="" data-minchars="1" data-maxitems="30">
                    </form>
                </div>
            </div>
        </div>
    </div><!--end section-->
    <div class="uk-section" style="padding-top:40px;">
        <div class="uk-container">
            <div class="uk-child-width-1-3@m uk-grid-match uk-text-center uk-grid uk-grid-stack" id="post" data-uk-grid="">
                
            <div class="uk-first-column"><a href="http://localhost/my-projects/NIMS-Laravel/public_html/standard/1/roles"><div class="uk-card uk-card-default uk-box-shadow-medium uk-card-hover uk-card-body uk-inline border-radius-large border-xlight" style="width:100%;height:100%;"><img src="storage/uploads/standards/jUI9ZO6aLwJnm0KfJ6eDvAcBEE3YfmooiVtnLQGReNXQuV7Plh6Pf3tbXiAd5zhK.jpg" alt="Standard Image" srcset="" class="w-25" style="border-radius:80px"><h3 class="uk-card-title uk-margin">S1</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus esse eaque m...</p></div></a></div><div class="uk-grid-margin uk-first-column"><a href="http://localhost/my-projects/NIMS-Laravel/public_html/standard/2/roles"><div class="uk-card uk-card-default uk-box-shadow-medium uk-card-hover uk-card-body uk-inline border-radius-large border-xlight" style="width:100%;height:100%;"><span data-uk-icon="icon: cog; ratio: 3.4" class="uk-icon"><svg width="68" height="68" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cog"><circle fill="none" stroke="#000" cx="9.997" cy="10" r="3.31"></circle><path fill="none" stroke="#000" d="M18.488,12.285 L16.205,16.237 C15.322,15.496 14.185,15.281 13.303,15.791 C12.428,16.289 12.047,17.373 12.246,18.5 L7.735,18.5 C7.938,17.374 7.553,16.299 6.684,15.791 C5.801,15.27 4.655,15.492 3.773,16.237 L1.5,12.285 C2.573,11.871 3.317,10.999 3.317,9.991 C3.305,8.98 2.573,8.121 1.5,7.716 L3.765,3.784 C4.645,4.516 5.794,4.738 6.687,4.232 C7.555,3.722 7.939,2.637 7.735,1.5 L12.263,1.5 C12.072,2.637 12.441,3.71 13.314,4.22 C14.206,4.73 15.343,4.516 16.225,3.794 L18.487,7.714 C17.404,8.117 16.661,8.988 16.67,10.009 C16.672,11.018 17.415,11.88 18.488,12.285 L18.488,12.285 Z"></path></svg></span><h3 class="uk-card-title uk-margin">S2</h3><p>S2</p></div></a></div><div class="uk-grid-margin uk-first-column"><a href="http://localhost/my-projects/NIMS-Laravel/public_html/standard/3/roles"><div class="uk-card uk-card-default uk-box-shadow-medium uk-card-hover uk-card-body uk-inline border-radius-large border-xlight" style="width:100%;height:100%;"><span data-uk-icon="icon: cog; ratio: 3.4" class="uk-icon"><svg width="68" height="68" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cog"><circle fill="none" stroke="#000" cx="9.997" cy="10" r="3.31"></circle><path fill="none" stroke="#000" d="M18.488,12.285 L16.205,16.237 C15.322,15.496 14.185,15.281 13.303,15.791 C12.428,16.289 12.047,17.373 12.246,18.5 L7.735,18.5 C7.938,17.374 7.553,16.299 6.684,15.791 C5.801,15.27 4.655,15.492 3.773,16.237 L1.5,12.285 C2.573,11.871 3.317,10.999 3.317,9.991 C3.305,8.98 2.573,8.121 1.5,7.716 L3.765,3.784 C4.645,4.516 5.794,4.738 6.687,4.232 C7.555,3.722 7.939,2.637 7.735,1.5 L12.263,1.5 C12.072,2.637 12.441,3.71 13.314,4.22 C14.206,4.73 15.343,4.516 16.225,3.794 L18.487,7.714 C17.404,8.117 16.661,8.988 16.67,10.009 C16.672,11.018 17.415,11.88 18.488,12.285 L18.488,12.285 Z"></path></svg></span><h3 class="uk-card-title uk-margin">Your Success  That's Our Business Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.</h3><p>Your Success  That's Our Business Launch your campaign and benefit from our expe...</p></div></a></div></div>
        </div>
    </div>

<!-- Hero End -->   


@endsection