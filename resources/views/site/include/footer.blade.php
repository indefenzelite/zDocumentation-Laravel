   <!-- Footer Start -->
   <style>
       @media (max-width: 667px) {

           /* CSS rules for mobile view */
           .main {
               width: 380px !important;
           }
       }
   </style>
   <footer class="footer main">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="footer">
                       <div class="row mt-5 mb-3">
                           <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                               <a href="{{ url('/') }}" class="logo-footer">
                                   <img src="{{ getBackendLogo(getSetting('app_logo')) }}" height="48" alt="">
                               </a> <br><br>
                               <p>{{ getSetting('frontend_footer_description') }}</p>
                               {{-- <p class="mt-2">{{ getSetting('frontend_map_code') }}</p> --}}
                               <p class="mt-2">{{ getSetting('frontend_footer_address') }}</p>
                               {{-- <p class="mt-2">{{ getSetting('frontend_footer_phone') }}</p> --}}
                               <p class="mt-2">{{ getSetting('frontend_footer_email') }}</p>

                               <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                   <li class="list-inline-item"><a href="{{ getSetting('facebook_link') }}"
                                           class="rounded"><i data-feather="facebook"
                                               class="fea icon-sm fea-social"></i></a></li>
                                   <li class="list-inline-item"><a href="{{ getSetting('linkedin_link') }}"
                                           class="rounded"><i data-feather="linkedin"
                                               class="fea icon-sm fea-social"></i></a></li>
                                   <li class="list-inline-item"><a href="{{ getSetting('twitter_link') }}"
                                           class="rounded"><i data-feather="twitter"
                                               class="fea icon-sm fea-social"></i></a></li>
                                   <li class="list-inline-item"><a href="{{ getSetting('instagram_link') }}"
                                           class="rounded"><i data-feather="instagram"
                                               class="fea icon-sm fea-social"></i></a></li>
                                   <li class="list-inline-item"><a href="{{ getSetting('youtube_link') }}"
                                           class="rounded"><i data-feather="youtube"
                                               class="fea icon-sm fea-social"></i></a></li>
                               </ul><!--end icon-->
                           </div><!--end col-->
                           @php
                               $usefull_links = App\Models\WebsitePage::select('title', 'slug')
                                   ->whereStatus(1)
                                   ->latest()
                                   ->limit(10)
                                   ->get();
                           @endphp
                           <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                               <h6 class="footer-head">Useful Links</h6>
                               <ul class="list-unstyled footer-list mt-4">
                                   @foreach ($usefull_links as $item)
                                       <li><a href="{{ route('page.slug', $item->slug) }}" class="text-foot"><i
                                                   class="uil uil-angle-right-b me-1"></i> {{ $item['title'] }}</a>
                                       </li>
                                   @endforeach
                               </ul>
                           </div><!--end col-->

                           <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                               <h6 class="footer-head">Newsletter</h6>
                               <p class="mt-4">Sign up and receive the latest tips via email.</p>
                               <form action="{{ route('newsletter.store') }}" method="post">
                                   @csrf
                                   <input type="hidden" name="type" value="1">
                                   <div class="row">
                                       <div class="col-lg-12">
                                           <div class="foot-subscribe mb-3">
                                               <label class="form-label">Write your email <span
                                                       class="text-danger">*</span></label>
                                               <div class="form-icon position-relative">
                                                   <i data-feather="mail" class="fea icon-sm icons"></i>
                                                   <input type="email" pattern="[a-zA-Z]+.*"
                                                       title="Please enter first letter alphabet and at least one alphabet character is required."
                                                       title="Please enter first letter alphabet and at least one alphabet character is required."
                                                       name="value" id="emailsubscribe"
                                                       class="form-control ps-5 rounded" placeholder="Your email : "
                                                       required>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-12">
                                           <div class="d-grid">
                                               <input type="submit" id="submitsubscribe" name="send"
                                                   class="btn btn-primary" value="Subscribe">
                                           </div>
                                       </div>
                                   </div>
                               </form>
                           </div><!--end col-->
                       </div><!--end row-->
                   </div>
               </div><!--end col-->
           </div><!--end row-->
       </div><!--end container-->

       <div class="footer-py-20 footer_bar">
           <div class="container">
               <div class="row align-items-center">
                   <div class="col-sm-12">
                       <div class="text-sm-start">
                           <p class="m-3 text-center">{{ getSetting('frontend_copyright_text') }}. Design with <i
                                   class="mdi mdi-heart text-danger"></i> by <a href="https://www.defenzelite.com/"
                                   target="_blank" class="text-reset">Defenzelite</a>.</p>
                           {{-- <p class="m-3 text-center">© <script>document.write(new Date().getFullYear())</script> {{getSetting('app_name')}}. Design with <i class="mdi mdi-heart text-danger"></i> by <a href="https://www.defenzelite.com/" target="_blank" class="text-reset">Defenzelite</a>.</p> --}}
                       </div>
                   </div><!--end col-->
               </div><!--end row-->
           </div><!--end container-->
       </div>
   </footer><!--end footer-->
   <!-- Footer End -->
