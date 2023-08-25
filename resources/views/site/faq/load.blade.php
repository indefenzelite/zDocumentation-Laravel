@if(isset($faq) && $faq)
    <article class="uk-article mb-5">
        <div class="d_area_heading">
            <div class="d-flex justify-content-start area-head-title" >
                    <h2 class="mb-0 text-muted question">Q</h2>
                    <div style="padding-left: 5px" class="text-heading text-success"> {{@$faq->title ?? '--'}}</div>
            </div>
            <div>
                <span class="text-muted f-16">
                     {!!@$faq->description!!}
                </span>
            </div>     
                <hr class="hr-dark">
            <div class="faq-footer">

                <div class="mb-4 faq-meta">
                    <span class="f-14 text-muted">{{$faq->getPrefix()}}</span>
                    <p class="m-0 p-0 ml-2 f-14" title="Last Updated At">
                       {{\Carbon\Carbon::parse($faq->updated_at)->format('d-m-Y:H:i')}}
                    </p>
                </div>
                <div class="emoji-format">
                   
                    <a class="ml-5 addVote" data-faq_id="{{$faq->id}}" data-status="0" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/happy.png')}}"
                        alt="Happy Image" srcset="" class="emoji-icon icon-0 
                        @if (getUserVote($faq->id,request()->ip(),0))
                            w-40
                        @else
                            w-30   
                        @endif">
                    </a>
                    <a class="ml-5 addVote" data-faq_id="{{$faq->id}}" data-status="1" href="javascript:void(0)">
                    <img  src="{{asset('frontend/assets/emoji/unhappy.png')}}"
                    alt="Sad Image" srcset="" class="emoji-icon icon-1 
                    @if (getUserVote($faq->id,request()->ip(),1))
                        w-40
                    @else
                        w-30 
                    @endif">
                    </a>
                    <a class="ml-5 addVote" data-faq_id="{{$faq->id}}" data-status="2" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/cry.png')}}"
                        alt="Anger Image" srcset="" class="emoji-icon icon-2
                        @if (getUserVote($faq->id,request()->ip(),2))
                            w-40
                        @else
                            w-30
                        @endif" >
                    </a>
                </div>
                <div class="mt-2">
                    <div class="share-faq">
                        <a title="Share in Whatsapp" href="" class="btn btn-icon btn-outline-light text-dark">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a title="Copy to Clipboard" href="javascript:void(0)" class="copyLink btn btn-icon btn-outline-light text-dark">
                            <i class="fa-regular fa-copy"></i>
                        </a>
                    </div>
                   
                </div>
            </div>
           
        </div>
    </article> 
@else
  <span class="empty-data"> No Faq Found!</span>  
@endif



