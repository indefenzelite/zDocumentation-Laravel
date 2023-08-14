@extends('layouts.main')
@section('title', 'LaunchCampaign')
@section('content')
    @php
        $breadcrumb_arr = [['name' => 'LaunchCampaign', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Launch Campaign</h5>
                            <span>List of Launch Campaign</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <!-- end message area-->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Launch Campaign</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news-letters.runcampaign') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="title" class="control-label">Subject<span
                                                class="text-danger">*</span></label>
                                        <input required class="form-control" name="title" type="text"
                                            pattern="[a-zA-Z]+.*"
                                            title="Please enter first letter alphabet and at least one alphabet character is required."
                                            id="name" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="body" class="control-label">Body</label>
                                        <textarea name="body" id="" class="form-control ck-editor"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Run Campaign</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <img src="https://media.istockphoto.com/photos/man-viewing-newsletter-signup-page-on-tablet-computer-picture-id1298294939?k=20&m=1298294939&s=612x612&w=0&h=ueBGt80bLOMe436zFAVvpmcsva3gTPm3n6jbPNq-1EM="
                            width="100%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        {{-- normal editor js --}}
        {{-- START CKEDITOR INIT --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function() {
                ClassicEditor
                    .create(document.querySelector('.ck-editor'), {
                        ckfinder: {
                            uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                        }
                    })
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {

                    });
            });
        </script>
        {{-- END CKEDITOR INIT --}}
    @endpush
@endsection
