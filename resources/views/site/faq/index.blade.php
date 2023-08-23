@extends('layouts.app')
@section('meta_data')
    @php
	$meta_title = $faq->title ;
    $meta_description = \Str::limit(strip_tags($faq->description),256, '...')  ?? '';
    $meta_keywords = getSeoData('faq')->keyword ?? '';
    $meta_motto = '' ?? getSetting('site_motto');
    $meta_abstract = '' ?? getSetting('site_motto');
    $meta_author_name = '' ?? 'Defenzelite';
    $meta_author_email = '' ?? 'support@defenzelite.com';
    $meta_reply_to = '' ?? getSetting('app_email');
    $meta_img = ' ';	
	@endphp
@endsection


<style>
    .uk-position-fixed {
        position: fixed !important;
    }
    .empty-data{
    display: flex;
    justify-content: center;
    margin-top: 25px;
    }
    .uk-nav-default > li > a:hover, .uk-nav-default > li > a:focus{
        color: #00a651 !important;
    }
    .emoji-icon{
      
        width: 30px;
    }
  
</style>

@section('content')
<div class="uk-section-">
    <div class="uk-container mt-3">
        <div class="uk-grid-large" data-uk-grid>
            <div class="sidebar-fixed-width uk-visible@m">
                <div class="sidebar-docs uk-position-fixed uk-margin-top px-2" style="background: #fbfbfd;"
                    id="side_duties">
                    <div class="uk-container uk-container-small">
                        <div class="text-muted mb-2 p-2">
                            Table of content
                        </div>
                        <div class="uk-position-relative side_duties" id="side_duties">
                            @if ($category)
                                @foreach ($category->categories as $sub_category)
                                    @php
                                        $faq_ques = App\Models\FAQ::where('category_id',$category->id)->where('sub_category_id',$sub_category->id)->get();
                                    @endphp
                                    <div style="text-align:left;margin:0;font-weight:500" class="" >
                                        {{$sub_category->name}}
                                    </div>
                                    <ul class="uk-nav uk-nav-default doc-nav side_menu" style="text-align:left;">
                                        @foreach ($faq_ques as $faq_que)
                                            <li class="checkRequest2 @if($faq_que->id == $id) faq-active @endif">
                                                <a href="javascript:void(0)" data-id="2" onclick="loadFaqsData(event,{{$faq_que->id}},{{$faq_que->category_id}})">{{$faq_que->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @else
                                <small class="text-center text-muted">No Categories Found!</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-expand@m align-items-end" id="ajax-container" style="min-height: 450px;">
                @include('site.faq.load')
                
            </div>
        </div>
        {{-- <button type="button" class="btn btn-primary" id="popover-trigger" data-bs-toggle="popover" title="Popover Title" data-bs-content="Popover Content">Click Me</button> --}}
    </div>
    
</div>
@endsection
@include('site.faq.modal.share-modal')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('script')
  <script>
    var url = "{{url('/')}}";
    $(document).on('click','.addVote',function(){
        $('.emoji-icon').removeClass('w-40');
        let faq_id = $(this).data('faq_id');
        let status = $(this).data('status');
        $.ajax({
            url: "{{route('vote.store')}}",
            type: 'POST',
            data: { "_token": "{{ csrf_token() }}",faq_id:faq_id,status:status},
            success: function (res) {
                $('.icon-'+res.status_id).addClass('w-40');
            }
        });
    });
    function loadFaqsData(e,faq_id,categorry_id) {
        $('.checkRequest2').removeClass('faq-active');
        $(this).addClass('faq-active');
        $.ajax({
            url: url + '/faq/' + faq_id + '?category_id=' + categorry_id,
            type: 'get',
            data: { id: faq_id },
            success: function (res) {
                $('#ajax-container').html(res.data);
            }
        });
        history.pushState({}, "", url + '/faq/' + faq_id + '?category_id=' + categorry_id);
    }
    $(document).ready(function() {
        $("html, div").animate({
            scrollTop: $('.sidebar-docs').get(0).scrollHeight
        }, 5);

        $('#shareFaq').socialSharingPlugin({            
            url: '',
            title: '',
            description: '',
            img: $('meta[property="og:image"]').attr('content'),
            btnClass: 'btn btn-light',
            enable: null,
            responsive: false,
            mobilePosition: 'left',
            copyMessage: 'Copy to clipboard',
            enable: ['copy','facebook','<a href="https://www.jqueryscript.net/tags.php?/twitter/">twitter</a>','pinterest','linkedin','whatsapp']
        });
    });

            
     
  </script>
@endpush
