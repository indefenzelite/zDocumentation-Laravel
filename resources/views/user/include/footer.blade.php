   <!-- Footer Start -->
   <footer class="footer">    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer">
                    <div class="row mt-5 mb-3">
                        
                        <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                            <a href="{{ url('/') }}" class="logo-footer">
                                <img src="{{ getBackendLogo(getSetting('app_white_logo'))}}" height="48" alt="">
                            </a>
                            <p class="mt-4">Start working with {{ getSetting('app_name') }} that can provide everything you need to generate awareness, drive traffic, connect.</p>
                            <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                            </ul><!--end icon-->
                        </div><!--end col-->
                @php
                $company = [
                    ['link'=>route('about'),'title'=>"About us"],
                    ['link'=>route('blogs'),'title'=>"Services"],
                    ['link'=>url('/Team'),'title'=>"Team"],
                    ['link'=>route('about'),'title'=>"Pricing"],
                    ['link'=>route('about'),'title'=>"Project"],
                    ['link'=>route('contact'),'title'=>"Careers"],
                    ['link'=>route('blogs'),'title'=>"Blog"],
                    ['link'=>route('login'),'title'=>"Login"],
                ];
                $usefull_links = [
                    ['link'=>url('/page/terms'),'title'=>"Terms of Services"],
                    ['link'=>url('/page/privacy'),'title'=>"Privacy Policy"],
                    ['link'=>url('/page/gdpr'),'title'=>"Documentation"],
                    ['link'=>url('/about'),'title'=>"Changelog"],
                    ['link'=>url('/about'),'title'=>"Components"],
                    
                ];
                @endphp
                        <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Company</h5>
                            <ul class="list-unstyled footer-list mt-4">
                                @foreach($company as $item)
                                <li><a href="{{ $item['link'] }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> {{ $item['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </div><!--end col-->
                
                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Usefull Links</h5>
                            <ul class="list-unstyled footer-list mt-4">
                                @foreach($usefull_links as $item)
                                <li><a href="{{ $item['link'] }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> {{ $item['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </div><!--end col-->

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Newsletter</h5>
                            <p class="mt-4">Sign up and receive the latest tips via email.</p>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="foot-subscribe mb-3">
                                            <label class="form-label">Write your email <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" name="email" id="emailsubscribe" class="form-control ps-5 rounded" placeholder="Your email : " required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-grid">
                                            <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary" value="Subscribe">
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
                        <p class="m-3 text-center">© <script>document.write(new Date().getFullYear())</script> {{getSetting('app_name')}}. Design with <i class="mdi mdi-heart text-danger"></i> by <a href="https://www.defenzelite.com/" target="_blank" class="text-reset">Defenzelite</a>.</p>
                    </div>
                </div><!--end col-->

                {{-- <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <ul class="list-unstyled text-sm-end mb-0">
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="assets/images/payments/american-ex.png" class="avatar avatar-ex-sm" title="American Express" alt=""></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="assets/images/payments/discover.png" class="avatar avatar-ex-sm" title="Discover" alt=""></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="assets/images/payments/master-card.png" class="avatar avatar-ex-sm" title="Master Card" alt=""></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="assets/images/payments/paypal.png" class="avatar avatar-ex-sm" title="Paypal" alt=""></a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="assets/images/payments/visa.png" class="avatar avatar-ex-sm" title="Visa" alt=""></a></li>
                    </ul>
                </div><!--end col--> --}}
            </div><!--end row-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- Footer End -->