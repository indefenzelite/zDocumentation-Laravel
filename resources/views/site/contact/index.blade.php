@extends('layouts.app')

@section('meta_data')
    @php
        $meta_title = @$metas->title ?? 'Contact';
        $meta_description = @$metas->description ?? '';
        $meta_keywords = @$metas->keyword ?? '';
        $meta_motto = @$app_settings['site_motto'] ?? '';
        $meta_abstract = @$app_settings['site_motto'] ?? '';
        $meta_author_name = @$app_settings['app_name'] ?? 'Defenzelite';
        $meta_author_email = @$app_settings['frontend_footer_email'] ?? 'dev@defenzelite.com';
        $meta_reply_to = @$app_settings['frontend_footer_email'] ?? 'dev@defenzelite.com';
        $meta_img = ' ';
    @endphp
@endsection

@section('content')
    <!-- Start Contact -->
    <section class="section">

        <div class="container card p-5">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="">

                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif
                        <h4 class="mb-4">
                            <span class="text-primary">
                                <i data-feather="help-circle" class="fea icon-m-sm"></i>
                                zStarter
                            </span>
                            Support Desk
                        </h4>
                        <form method="post" action="{{ route('contact.store') }}">
                            @csrf
                            <input required type="hidden" value="email" name="type">
                            <p id="error-msg" class="mb-0"></p>
                            <div id="simple-msg"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input required name="name" value="{{ old('name') }}" id="name"
                                                pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                                type="text" class="form-control ps-5" maxlength="30"
                                                placeholder="Name :">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input required type="email" class="form-control ps-5" name="value_type"
                                                value="{{ old('value_type') }}" placeholder="Email :">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Contact No <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="phone" class="fea icon-phone icons pb-2"></i>
                                            <input name="phone" value="{{ old('phone') }}" required type="number"
                                                pattern="^[0-9]*$" min="0" id="phone" class="form-control ps-5 "
                                                placeholder="Enter Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="book" class="fea icon-sm icons"></i>
                                            <input required name="subject" value="{{ old('subject') }}" id="subject"
                                                class="form-control ps-5" placeholder="Subject :">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Comments <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="message-circle" class="fea icon-sm icons clearfix"></i>
                                            <textarea required name="description" id="comments" rows="4" class="form-control ps-5" placeholder="Message :">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" id="submit" class="btn btn-primary">Send Message</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end custom-form-->
                </div>
                <!--end col-->

                <div class="col-lg-7 col-md-6">
                    <div class="">
                        <div class="title-heading ms-lg-4">
                            <h4 class="mb-4">{{ $contents['contact_title'] ?? '' }}</h4>
                            <p class="text-muted">
                                {{ $contents['contact_description'] ?? '' }}
                            </p>
                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="mail" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Email</h6>
                                    <a href="mailto:{{ getSetting('app_email') }}"
                                        class="text-muted">{{ getSetting('app_email') }}</a>
                                </div>
                            </div>

                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="phone" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Phone</h6>
                                    <a href="tel:+{{ getSetting('app_contact') }}"
                                        class="text-muted">{{ getSetting('app_contact') }}</a>
                                </div>
                            </div>

                            <div class="d-flex contact-detail align-items-center mt-3">
                                <div class="icon">
                                    <i data-feather="map-pin" class="fea icon-m-md text-dark me-3"></i>
                                </div>
                                <div class="flex-1 content">
                                    <h6 class="title fw-bold mb-0">Address</h6>
                                    <p class="text-muted"> {{ getSetting('app_address') }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End contact -->
@endsection
