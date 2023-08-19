@if(isset($faq) && $faq)
    <article class="uk-article">
        <div class="d_area_heading">
        
            <div>
                <span  class="text-heading" > {{@$faq->title ?? '--'}}</span>
            </div>
            <div>
                <span class="text-muted f-16"> {!!@$faq->description!!}</span>
            </div>     
                <hr class="hr-dark">
            <div class="d-flex justify-content-between ">

                <div class="mb-4">
                    <span class="f-14">{{$faq->getPrefix()}}</span>
                    <p class="m-0 p-0 ml-2 f-14" title="Last Updated At">
                        <i class="fa-regular fa-clock text-muted"></i> {{\Carbon\Carbon::parse($faq->updated_at)->format('d-m-Y:H:i')}}
                    </p>
                </div>
                <div class="emoji-format">
                    <a class="" type="submit" href="javascript:void(0)">
                    <img  src="{{asset('frontend/assets/emoji/sad.png')}}"
                    alt="Sad Image" srcset="" class="" width="40" >
                    </a>
                    <a class="ml-5" type="submit" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/happy-face.png')}}"
                        alt="Happy Image" srcset="" class="" width="40" >
                    </a>
                    <a class="ml-5" type="submit" href="javascript:void(0)">
                        <img  src="{{asset('frontend/assets/emoji/angry.png')}}"
                        alt="Anger Image" srcset="" class="" width="40" >
                    </a>
                    {{-- <i class="fa-regular fa-face-smile text-success "></i>
                    <i class="fa-regular fa-face-frown text-warning ml-5" ></i>
                    <i class="fa-regular fa-face-angry text-danger  ml-5"></i> --}}

                </div>
                <div class="">
                    <a class="btn btn-outline-light fw-500 mr-2 shareFaqBtn" href="javascript:void(0)" title="Share">
                        <i class="fa-solid fa-share-nodes text-primary"></i> 
                    </a>
                    <a class="btn btn-outline-light fw-500 mr-2 shareFeddbackBtn" href="javascript:void(0)" title="Send Feedback">
                        <i class="fa-regular fa-share-from-square text-primary"></i>
                    </a>
                    
                </div>
            </div>
           
        </div>
    </article> 
  @else
  <span class="empty-data"> No Faq Found!</span>  
@endif

