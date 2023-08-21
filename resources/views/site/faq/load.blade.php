@if(isset($faq) && $faq)
    <article class="uk-article">
        <div class="d_area_heading">
            <div class="d-flex justify-content-start" style="line-height: 2">
                    <h2 class="mb-0 text-muted">Q</h2>
                    <div style="padding-left: 5px" class="text-heading text-success"> {{@$faq->title ?? '--'}}</div>
            </div>
            <div>
                <span class="text-muted f-16">
                     {!!@$faq->description!!}
                </span>
            </div>     
                <hr class="hr-dark">
            <div class="d-flex justify-content-between mb-5">

                <div class="mb-4">
                    <span class="f-14 text-muted">{{$faq->getPrefix()}}</span>
                    <p class="m-0 p-0 ml-2 f-14" title="Last Updated At">
                       {{\Carbon\Carbon::parse($faq->updated_at)->format('d-m-Y:H:i')}}
                    </p>
                </div>
                <div class="emoji-format">
                    <a class="ml-5" type="submit" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/happy.png')}}"
                        alt="Happy Image" srcset="" class="emoji-icon" width="35" >
                    </a>
                    <a class="ml-5" type="submit" href="javascript:void(0)">
                    <img  src="{{asset('frontend/assets/emoji/unhappy.png')}}"
                    alt="Sad Image" srcset="" class="emoji-icon" width="35" >
                    </a>
                    <a class="ml-5" type="submit" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/angry.png')}}"
                        alt="Anger Image" srcset="" class="emoji-icon" width="35" >
                    </a>
                </div>
                <div class="">
                    <a class="btn btn-outline-light mr-2 shareFaqBtn" href="javascript:void(0)" title="Share">
                        <i class="fa-solid fa-lg fa-share-nodes text-success"></i> 
                    </a>
                    {{-- <a class="btn btn-outline-light fw-500 mr-2 shareFeddbackBtn" href="javascript:void(0)" title="Send Feedback">
                        <i class="fa-regular fa-share-from-square text-success"></i>
                    </a> --}}
                    
                </div>
            </div>
           
        </div>
    </article> 
  @else
  <span class="empty-data"> No Faq Found!</span>  
@endif

