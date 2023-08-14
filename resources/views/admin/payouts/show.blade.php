@extends('layouts.main')
@section('title', 'Payout')
@section('content')
    @php
        /**
         * Payout
         *
         * @category  zStarter
         *
         * @ref  zCURD
         * @author    Defenzelite <hq@defenzelite.com>
         * @license  https://www.defenzelite.com Defenzelite Private Limited
         * @version  <zStarter: 1.1.0>
         * @link        https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => 'Payouts', 'url' => route('admin.payouts.index'), 'class' => ''], ['name' => 'Show Payout', 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <style>
            .error {
                color: red;
            }

            .table thead {
                background-color: #fff;
            }

            .table thead th {
                bpayout-bottom: 0px;
            }

            p {
                margin-bottom: 0px;
            }

            .bpayout-none td {
                bpayout: none;
                padding-top: 0px;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $payout->getPrefix() }}</h5>
                            <span>Requested At {{ $payout->formatted_created_at_with_time }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        @if (auth()->user()->isAbleTo('control_payout'))
            <div class="row">
                <div class="col-md-4">
                    <!-- start message area-->

                    <div class="card mb-2">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="mb-0">Payee Information</h3>
                            <span
                                class="badge badge-{{ $payout->status_parsed->color }} m-1">{{ $payout->status_parsed->label }}</span>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                @if ($payout->user != null)
                                    <tbody>
                                        {{-- @dd($payout->user); --}}
                                        <tr>
                                            <td class="p-0"> Name </td>
                                            <td class="text-right p-0">
                                                {{-- @dd($payout->user) --}}
                                                <span id="copyname">{{ $payout->user->full_name ?? 'Not vailable' }}</span>
                                                @if ($payout->user->full_name != null)
                                                    <span><a href="javascript:void(0)"
                                                            class="btn btn-icon btn-sm btn text-copy" title="Copy"
                                                            data-clipboard-target="#copyname"><i class="ik ik-copy"
                                                                aria-hidden="true"></i></a></span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0"> Email </td>
                                            <td class="text-right p-0">
                                                <span id="copyemail">{{ $payout->user->email ?? 'Not vailable' }}</span>
                                                @if ($payout->user->email)
                                                    <span><a href="javascript:void(0)"
                                                            class="btn btn-icon btn-sm btn text-copy" title="Copy"
                                                            data-clipboard-target="#copyemail"><i class="ik ik-copy"
                                                                aria-hidden="true"></i></a></span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0"> Phone </td>
                                            <td class="text-right p-0">
                                                <span id="copyphone">{{ $payout->user->phone ?? 'Not vailable' }}</span>
                                                @if ($payout->user->phone != null)
                                                    <span><a href="javascript:void(0)"
                                                            class="btn btn-icon btn-sm btn text-copy" title="Copy"
                                                            data-clipboard-target="#copyphone"><i class="ik ik-copy"
                                                                aria-hidden="true"></i></a></span>
                                                @endif
                                            </td>
                                        </tr>

                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="mb-0"><i class="fa fa-credit-card-alt"></i> Payment Details</h3>

                            <div class="text-muted">
                                Requested Amount:
                                <strong class="fw-700 text-primary">
                                    {{ format_price($payout->amount) }}
                                </strong>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($payout->type == App\Models\Payout::TYPE_UPI)
                                <h6 class="fw-700">UPI Details</h6>
                                <table class="table">
                                    <tbody>
                                        <tr class="bpayout-none">
                                            <td>UPI Holder Name</td>
                                            <td class="text-right"id="copyupi_name">
                                                {{ $user_details->upi_holder_name ?? '--' }}
                                                <span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copyupi_name"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>UPI Number</td>
                                            <td class="text-right"id="copyupi">{{ $user_details->upi_id ?? '--' }}<span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copyupi"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a>
                                                </span></td>
                                        </tr>
                                    </tbody>

                                </table>
                            @else
                                <h6 class="fw-700">Bank Details</h6>
                                <table class="table mt-2">
                                    <tbody>
                                        <tr>
                                            <td class="p-0">Account Holder Name </td>
                                            <td class="p-0 text-right" id="copy_account_holder_name">
                                                {{ $user_details->account_holder_name ?? '--' }}<span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copy_account_holder_name"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a></span></td>
                                        </tr>
                                        <tr class="bpayout-none">
                                            <td class="p-0">Bank Name</td>
                                            <td class="p-0 text-right"id="copy_bank_name">
                                                {{ $user_details->bank_name ?? '--' }}
                                                <span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copy_bank_name"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="bpayout-none">
                                            <td class="p-0">Branch</td>
                                            <td class="p-0 text-right"id="copy_branch">{{ $user_details->branch ?? '--' }}
                                                <span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copy_branch"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">Account Number </td>
                                            <td class="p-0 text-right" id="copybank">
                                                {{ $user_details->account_no ?? '--' }}
                                                <span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copybank"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">IFSC Code </td>
                                            <td class="p-0 text-right"id="copyifsc">
                                                {{ $user_details->ifsc_code ?? '--' }}
                                                <span>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm text-copy"
                                                        title="Copy" data-clipboard-target="#copyifsc"><i
                                                            class="ik ik-copy" aria-hidden="true"></i></a></span>
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td class="p-0">Remark</td>
                                            <td class="p-0 text-right" id="copy_remark"> {{$user_details->remark ?? '--'}}
                                            </td>
                                        </tr> --}}

                                    </tbody>
                                </table>
                            @endif

                            @if ($payout->status == \App\Models\Payout::STATUS_IN_REVIEW)
                                <div>
                                    <form action="{{ route('admin.payouts.status', $payout->id) }}" method="post"
                                        class="ajaxForm" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="request_with" value="update-status">
                                        <div class="form-radio">
                                            <div class="radio radio-inline">
                                                <label class="fw-700">
                                                    <input type="radio" class="updateStatusBtn" name="status"
                                                        value="1" @if ($payout->status == 1) checked @endif>
                                                    <i class="helper"></i>Approve & Mark Request as Paid
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label class="fw-700">
                                                    <input type="radio" class="updateStatusBtn" name="status"
                                                        value="2" @if ($payout->status == 2) checked @endif>
                                                    <i class="helper"></i>Reject Request
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group d-none txn-wrap mt-2">
                                            <label for="">Enter Transaction Reference No.<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Transaction Number Here..." name="txn_no"
                                                value="" id="txn_no" min="1" required>
                                        </div>
                                        <div class="form-group d-none remark-wrap mt-2">
                                            <label for="">Enter Rejection Reason<span
                                                    class="text-danger">*</span></label>
                                            <textarea type="text" pattern="[a-zA-Z]+.*"
                                                title="Please enter first letter alphabet and at least one alphabet character is required." id="remarkBox"
                                                class="form-control" placeholder="Enter Reason Here..." name="remark" value="" required></textarea>
                                        </div>

                                        <hr>
                                        <div id="show-btn"class="d-none">
                                            <div class="mt-3 d-flex justify-content-between">
                                                <div class="text-danger mt-2">
                                                    <i class="ik ik-info"></i>
                                                    This action cannot be rolled back.
                                                </div>
                                                <button @if ($payout->status == 1 || $payout->status == 2) disabled @endif
                                                    class="btn btn-primary confirm-form-btn" type="submit">Confirm
                                                    Action</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @elseif($payout->status == \App\Models\Payout::STATUS_PAID)
                                <span class="alert alert-success d-block">
                                    Payout request apporved with txn <strong>{{ $payout->txn_no }}</strong> by
                                    <strong>{{ \App\Models\User::whereId($payout->approved_by)->first()->name ?? '' }}</strong>
                                    At {{ $payout->updated_at }}
                                </span>
                            @else
                                <span class="alert alert-danger d-block">
                                    Payout request rejected due to <strong>
                                        {{ $payout->txn_no }}
                                    </strong> by
                                    <strong>{{ \App\Models\User::whereId($payout->approved_by)->first()->name ?? '' }}</strong>
                                    At {{ $payout->updated_at }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>




    <!-- push external js -->
    @push('script')
        {{-- START COPY BUTTON INIT --}}
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
        <script>
            $(function() {
                new Clipboard('.text-copy');
            });
        </script>
        {{-- END COPY BUTTON INIT --}}

        {{-- START UPDATE STATUS BUTTON INIT --}}
        <script>
            $('.ajaxForm').on('submit', function(e) {
                e.preventDefault();
                var route = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                var response = postData(method, route, 'json', data, null, null);

                if (typeof(response) != "undefined" && response !== null && response.status == "success") {
                    window.location.reload();
                }
            })
            $(document).ready(function() {
                @if ($payout->status == 1 || $payout->status == 2)
                    $(".updateStatusBtn").prop("disabled", true);
                @endif
                $('.transactionCreate').on('click', function() {
                    var status = $(this).data('status');
                    $('#status').val(status);
                    $('#transactionCreate').modal('show');
                });
                $('.updateStatusBtn').on('click', function() {
                    $('#show-btn').removeClass('d-none');
                    if ($(this).val() == 1) {
                        $('.txn-wrap').removeClass('d-none');
                        $('#remarkBox').removeAttr('required');
                        $('#txn_no').prop('required', 'required');
                        $('.remark-wrap').addClass('d-none');
                    } else {
                        $('.remark-wrap').removeClass('d-none');
                        $('#remarkBox').prop('required', 'required');
                        $('#txn_no').removeAttr('required');
                        $('.txn-wrap').addClass('d-none');
                    }
                });
            });
        </script>
        {{-- END UPDATE STATUS BUTTON INIT --}}
    @endpush
@endsection
