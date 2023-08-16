@foreach($faqs as $key => $faq)
    
    <article class="uk-article">
        <div class="d_area_heading">
            <div class="mb-2 d-flex justify-content-between">
                <div>
                    <span style="font-size: 15px">S1</span>
                </div>
                <div>

                    <img src="http://localhost/my-projects/NIMS-Laravel/public_html/storage/backend/logos/logo-483.png"
                        style="width:100px">
                    <a href="http://localhost/my-projects/NIMS-Laravel/public_html/duties-pdf/1">
                        <!--<img src="http://localhost/my-projects/NIMS-Laravel/public_html/frontend/assets/images/download-pdf.png" style="width:30px"/>-->

                        <img src="http://localhost/my-projects/NIMS-Laravel/public_html/storage/frontend/pdf.png"
                            alt="Standard Image" srcset="" class=""
                            style="padding-right: 5px;width: 50px;    height: 90%!important;">
                    </a>
                </div>
            </div>
            <div>
                <span style="font-size: 16px">Question:{{@$faq->question ?? '--'}}</span>
            </div>
            <div>
                <span style="font-size: 16px">Description:{!! $faq->description !!}</span>
            </div>

        </div>
        <div class="article-content mt-4">
            <div>
                <h5 class="mb-0">Responsibility:</h5>
    
            </div>
            <div class="duty-section">
                <h5 class="p-0 m-0">Resources:</h5>
                <p class="text-dark m-0">S1R1DA1Duty </p>
            </div>


        </div>
    </article>
@endforeach
