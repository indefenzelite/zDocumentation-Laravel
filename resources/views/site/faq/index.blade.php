@extends('layouts.app')
<style>
    .uk-position-fixed {
        position: fixed !important;
    }

</style>

@section('content')
<div class="uk-section-">
    <div class="uk-container mt-5">
        @php
            if(request()->get('category_id')){
              $faqs = App\Models\Faq::where('category_id',request()->get('category_id'))->get();
            }else {
              $faqs = App\Models\Faq::get();
            }
        @endphp
        <div class="uk-grid-large" data-uk-grid>
            <div class="sidebar-fixed-width uk-visible@m">
                <div class="sidebar-docs uk-position-fixed uk-margin-top px-2" style="background: #fbfbfd;"
                    id="side_duties">
                    <div class="uk-container uk-container-small">
                        <div class="text-muted mb-2">
                            Table of content
                        </div>
                        <div class="uk-position-relative side_duties" id="side_duties">
                          @foreach ($categories as $category)
                          <div style="text-align:left;margin:0;font-weight:500" class="@if($category->id == $c_id) category-active @endif">{{$category->name}}</div>
                            <ul class="uk-nav uk-nav-default doc-nav side_menu" style="text-align:left;">
                                <li class="duty-active checkRequest1 uk-active"><a href="javascript:void(0)" data-id="1"
                                        onclick="loadDutiesData(event, 1,1,1,1)" class="@if($category->id == request()->get('c_id'))  active  @endif">{{$category->name}}</a></li>
                                
                                <li class=" duty-active checkRequest2"><a href="javascript:void(0)" data-id="2"
                                        onclick="loadDutiesData(event, 1,1,1,2)">S2R1</a></li>
                                <li class=" duty-active checkRequest3"><a href="javascript:void(0)" data-id="3"
                                        onclick="loadDutiesData(event, 1,1,1,3)">S2R1DA1D1</a></li>
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

<div id="offcanvas-docs" data-uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" data-uk-close></button>

        <div class="uk-position-relative side_duties">

        </div>

    </div>
</div>

@endsection
