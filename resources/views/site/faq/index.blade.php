@extends('layouts.app')

{{-- @section('meta_data')
    @php
		$meta_title =  ($faqs->page_meta_title) ? $faqs->page_meta_title : getSetting('app_name');		
		$meta_description = ($faqs->page_meta_description) ? $faqs->page_meta_description : '';		
		$meta_keywords = ($faqs->page_keywords) ? $faqs->page_keywords : getSetting('app_name');		
		$meta_motto = (false) ? $faqs->page_keywords : getSetting('app_name');		
	@endphp
@endsection --}}

@section('content')ˀ
    <!--Shape End-->  
   <!-- Start Faqs -->
   <style>
    .card-header {
      border-bottom: none !important;
    }    
    .bg-linear-gradient-primary{
        background: linear-gradient(#ffffff, #001683);
    }
  </style>
  <section class="faq bg-linear-gradient-primary"style=" min-height: 92vh;" >
    {{--  background-color: #f2f4fc;" min-height: 150vh; --}}
    <div class="container">
        {{-- @include('site.faqs.include.breadcrumb-area') --}}
          @php
            if(request()->get('category_id')){
              $faqs = App\Models\Faq::where('category_id',request()->get('category_id'))->get();
            }else {
              $faqs = App\Models\Faq::get();
            }
          @endphp
          <div class="row"style="padding-top: 141px;">
            <div class="col-md-4">
              <div class="card mt-2">
                <div class="card-header">
                  <h5>Categories</h5>
                </div>
                <div class="card-body">
                  <ul>
                    @foreach ($categories as $category)
                      <li class="mb-2">
                        <a href="{{route('faqs',['category_id'=>$category->id])}}"
                          class="@if(request()->get('category_id') == $category->id) text-primary @else text-dark inactive  @endif mr-4">{{ucwords($category->name)}}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div><!--end row-->
            <div class="col-md-8">
                <div class="accordion mb-4" id="accordionExample">
                  @forelse ($faqs as $key => $faq)
                    <div class="accordion-item rounded shadow wow animate_animated animate_fadeInUp mt-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key}}"
                                aria-expanded="true" aria-controls="collapse-{{$key}}">
                                {{$faq->title}}
                            </button>
                        </h2>
                        <div id="collapse-{{$key}}" class="accordion-collapse border-0 collapse @if($loop->first) show @endif" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-muted">
                               {!!$faq->description!!}
                            </div>
                        </div>
                    </div>
                  @empty 
                    <div class="m-5 p-5 text-center">
                      No FAQs Yet!
                    </div>
                  @endforelse
                </div><!--end col-->
            </div><!--end row-->
        </div>
      </div><!-- /.container -->
  </section><!-- /.FAQ -->
<!-- End Faqs -->

    
@endsection