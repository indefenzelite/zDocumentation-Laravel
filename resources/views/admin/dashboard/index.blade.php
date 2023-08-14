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

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <a class="col-lg-6 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i class="fas text-muted fa-lg fa-users"></i>
                                </div>
                                {{-- @dd( $stats['customersCount'] ) --}}
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">{{ $stats['customersCount'] }}</h2>
                                    <p class="mb-0 d-inline-block">Customers</p>
                                    {{-- <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-green"></i>2 New Acquisition</p>
                                    <p class="mb-0 mt-15"><i class="fas fa-caret-down mr-10 f-18 text-danger"></i>4 New Acquisition</p> --}}
                                </div>
                            </div>
                        </div>
                    </a>
                    {{-- @dd($orders) --}}
                    <a class="col-lg-6 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i class="fas text-muted fa-lg fa-receipt"></i>
                                </div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹{{ formatNumber($orders->sum('sub_total')) }}</h2>
                                    <p class="mb-0 d-inline-block"> Orders</p>
                                    {{-- <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-green"></i>2 New Acquisition</p>
                                    <p class="mb-0 mt-15"><i class="fas fa-caret-down mr-10 f-18 text-danger"></i>4 New Acquisition</p> --}}
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-7 col-md-12 col-sm-12" href="#">
                        <div class="card ticket-card bg-secondary">
                            <div class="card-body">
                                <div class="row align-items-center mb-30">
                                    <div class="col-auto">
                                        <i class="fa fa-business-time fa-beat text-muted f-12 btn btn-light btn-icon p-2"></i>
                                    </div>
                                    <div class="col text-right">
                                        <h3 class="mb-5 text-white">{{ formatNumber($stats['leadsCount']) }}</h3>
                                        <h6 class="mb-0 text-white">Total Leads</h6>
                                    </div>
                                </div>
                                <p class="mb-0  text-white d-inline-block">Converstion : </p>
                                <h5 class=" text-white d-inline-block mb-0 ml-10">{{ formatNumber($stats['leadConversationsCount']) }}</h5>
                                {{-- @dd($stats['leadConversationsCount']); --}}
                                <h6 class="mb-0 d-inline-block  text-white float-right"><i
                                        class="fas fa-caret-up mr-10 f-18"></i>{{ round($stats['leadConversationsCount'] ?? 1*100/$stats['leadsCount']  > 0 ? $stats['leadsCount'] : 1) }}%</h6>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-5 col-md-6 col-sm-12" href="#">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="state">
                                        <h3 class="text-primary">54</h3>
                                        <p class="card-subtitle text-muted fw-500">Verifications</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-user-shield fa-sm"></i>
                                    </div>
                                </div>
                                <div class="progress mt-3 mb-1 progress-6">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-muted f12">
                                    <span>Progress</span>
                                    <span class="float-right">63%</span>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a class="col-lg-6 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i class="fas text-muted fa-lg fa-chart-pie"></i>
                                </div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹18K</h2>
                                    <p class="mb-0 d-inline-block">Expanses</p>
                                    <p class="mb-0 mt-15"><i class="fas fa-caret-down mr-10 f-18 text-red"></i>+₹20K
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a class="col-lg-6 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-address-card"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">32</h2>
                                    <p class="mb-0 d-inline-block"> Accounts</p>
                                    <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-green"></i>+2 More
                                        Transactions</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <a class="col-lg-12 col-md-12 col-sm-12" href="#">
                        <div class="card ticket-card card-blue">
                            <div class="card-body">
                                <div class="row align-items-center mb-50">
                                    <div class="col-auto">
                                        <i class="fas fa-shop text-muted f-12 btn btn-light btn-icon p-2"></i>
                                    </div>
                                    <div class="col text-right">
                                        <h3 class="mb-5 text-white">{{ formatNumber($orders->sum('sub_total'))}}</h3>
                                        <h6 class="mb-0 text-white">Total Sales</h6>
                                    </div>
                                </div>
                                <p class="mb-0  text-white d-inline-block">Total Profit : </p>
                                <h5 class=" text-white d-inline-block mb-0 ml-10">₹2,451</h5>
                                <h6 class="mb-0 d-inline-block  text-white float-right"><i
                                        class="fas fa-caret-up mr-10 f-18"></i>10%</h6>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-hand-holding-dollar"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹158k</h2>
                                    <p class="mb-0 d-inline-block">Revenues</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-chart-simple"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹188</h2>
                                    <p class="mb-0 d-inline-block">Payouts</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-file-invoice"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹121k</h2>
                                    <p class="mb-0 d-inline-block">Bills Debt</p>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-cash-register"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹121k</h2>
                                    <p class="mb-0 d-inline-block">Funds Credited</p>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30"><i
                                        class="fas text-muted fa-lg fa-credit-card"></i></div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">₹20L</h2>
                                    <p class="mb-0 d-inline-block">Payouts</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="col-lg-4 col-md-6 col-sm-12" href="#">
                        <div class="card ticket-card bg-dark text-white">
                            <div class="card-body">
                                <div class="btn btn-icon btn-light mb-30 overlay">
                                    <i class="fas fa-refresh fa-spin"></i>
                                </div>
                                <div class="text-left">
                                    <h2 class="mb-0 d-inline-block text-primary">Active</h2>
                                    <p class="mb-0 d-inline-block">Thread Guard</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

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
