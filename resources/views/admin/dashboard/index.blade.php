@extends('layouts.main')
@section('title', $label)
@section('content')

    <style>
        .ticket-card {
            margin-bottom: 20px;
        }
    </style>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Good Afternoon</h5>
                        </div>
                    </div>
                    <span>
                        Namaste <span class="text-primary fw-700">{{ auth()->user()->full_name }}</span>
                    </span>
                </div>
            </div>
        </div>

        <h6 class="fw-600 mb-3">Quick Insights</h6>

        <div class="row clearfix ">
            @foreach (getCategoriesByCode('FaqCategories') as $category)
                <a class="col-lg-2 col-md-6 col-sm-12" href="#">
                    <div class="card ticket-card">
                        <div class="card-body">
                            {{-- <div class="btn btn-icon btn-light mb-30"><i
                                    class="fas text-muted fa-lg fa-hand-holding-dollar"></i></div> --}}
                            <div class="text-left">
                                <h2 class="mb-0 d-inline-block text-primary">{{$category->categories->count()}}</h2><br>
                                <p class="mb-0 d-inline-block">{{$category->name}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- <h6 class="fw-600 mb-3">Created By Insights</h6>
        <div class="row clearfix ">
            <a class="col-lg-3 col-md-6 col-sm-12" href="{{route('admin.faqs.index',['created_by' =>31])}}">
                <div class="card ticket-card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="text-left">
                            <h2 class="mb-0 d-inline-block text-primary">{{getFaqByCreatedBy(31)}}</h2><br>
                            <h6 class="mb-0 d-inline-block">Mayank</h6>
                        </div>
                        <div class="text-right mt-3">
                            <i class="fa fa-user text-muted" style="font-size:20px;"></i>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-lg-3 col-md-6 col-sm-12" href="{{route('admin.faqs.index',['created_by' =>32])}}">
                <div class="card ticket-card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="text-left">
                            <h2 class="mb-0 d-inline-block text-primary">{{getFaqByCreatedBy(32)}}</h2><br>
                            <h6 class="mb-0 d-inline-block">Vartika</h6>
                        </div>
                        <div class="text-right mt-3">
                            <i class="fa fa-user text-muted" style="font-size:20px;"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}

    </div>


    @push('script')
    {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function() {
                $('#allUsers').select2();
                $('input[type=radio][name=role_name]').change(function(e) {
                    e.preventDefault();
                    var roleName = $(this).val();
                    $.ajax({
                        type: 'post',
                        url: "{{ url('admin/broadcast/role/record') }}",
                        data: {
                            role_name: roleName
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#allUsers').html(response.data);
                        }
                    });
                });

                $('.role_name').on('change', function() {
                    $('.broadcast_section').show();
                });
            });
        </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
