@extends('layouts.app')
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
    
</style>

@section('content')
<div class="uk-section-">
    <div class="uk-container mt-5">
        <div class="uk-grid-large" data-uk-grid>
            <div class="sidebar-fixed-width uk-visible@m">
                <div class="sidebar-docs uk-position-fixed uk-margin-top px-2" style="background: #fbfbfd;"
                    id="side_duties">
                    <div class="uk-container uk-container-small">
                        <div class="text-muted mb-2 p-2">
                            Table of content
                        </div>
                        <div class="uk-position-relative side_duties" id="side_duties">
                          @foreach ($sub_sub_categories as $sub_sub_category)
                            @php
                                $faqs = App\Models\FAQ::where('category_id',$c_id)->where('sub_category_id',$s_id)->where('sub_sub_category_id',$sub_sub_category->id)->get();
                            @endphp
                            <div style="text-align:left;margin:0;font-weight:500" class="" >{{$sub_sub_category->name}}</div>
                                <ul class="uk-nav uk-nav-default doc-nav side_menu" style="text-align:left;">
                                    @foreach ($faqs as $faq)
                                        <li class="duty-active checkRequest2 @if($id != null && $faq->id == $id) active @endif"><a href="javascript:void(0)" data-id="2"
                                            onclick="loadFaqsData(event, {{$c_id}}, {{$s_id}}, {{$faq->id}})">{{$faq->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-expand@m align-items-end" id="ajax-container" style="min-height: 450px;">
                @include('site.faq.load')
            </div>
        </div>
    </div>
</div>

{{-- <div id="offcanvas-docs" data-uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" data-uk-close></button>

        <div class="uk-position-relative side_duties">

        </div>

    </div>
</div> --}}

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('script')
  <script>
    var url = "{{url('/')}}";

    function loadFaqsData(e,c_id,sub_category_id,faq_id) {
        // $('.duty-active').removeClass('active');
        $(this).addClass('active');
        $.ajax({
            url: url + '/category/' + c_id + '/sub-category/' + sub_category_id + '/faq/' + faq_id,
            type: 'get',
            data: { id: faq_id },
            success: function (res) {
                $('#ajax-container').html(res.data);
            }
        });
        history.pushState({}, "", url + '/category/' + c_id + '/sub-category/' + sub_category_id + '/faq/' + faq_id);
    }

  </script>

@endpush
