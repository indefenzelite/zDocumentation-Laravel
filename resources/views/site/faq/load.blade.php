@if(isset($faq) && $faq)
    <article class="uk-article">
        <div class="d_area_heading">
            <div class="mb-2 d-flex justify-content-between">
                <div>
                    <span style="font-size: 15px">{{$faq->getPrefix()}}</span>
                    <p class="m-0 p-0 ml-2" title="Last Updated At">
                        <i class="fa fa-clock "></i>{{\Carbon\Carbon::parse($faq->updated_at)->format('d-m-Y:H:i')}}
                    </p>
                </div>
            </div>
            <div>
                <span style="font-size: 16px">Question: {{@$faq->title ?? '--'}}</span>
            </div>
            <div>
                <span style="font-size: 16px">Description: {!!@$faq->description!!}</span>
            </div>

        </div>
    </article> 
  @else
  <span class="empty-data"> No Faq Found!</span>  
@endif

