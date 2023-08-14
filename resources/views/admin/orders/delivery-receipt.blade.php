@extends('layouts.empty')
@section('title', 'Delivery-Receipt')
@section('content')
    <style>
        @media print {
            .print-btn {
                display: none;
            }
        }

        tr {
            background-color: rgb(255 254 254 / 5%) !important;
        }

        .table td,
        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 0;

        }
        .order-createAt {
            font-size: 15px;
            font-weight: 600;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-12 justify-content-center mx-auto mt-4">
                <div class="card html-content">
                    <div class="card-header d-flex justify-content-between">

                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
                        <h5 class="fw-600  mb-0">Delivery Receipt</h5>
                        <small class="float-right order-createAt">{{ $order->formatted_created_at }}</small>
                    </div>
                    <div class="card-body">
                        <div class="row invoice-info">
                            <div class="col-sm-8 invoice-col">
                                <strong>Sold By</strong>
                                <address class="mb-1">
                                    {{ getSetting('app_name') }}
                                </address>
                                <b>{{ __('Order Id : ') }}</b> {{ $order->getPrefix() }}<br>
                                <b>{{ __('Invoice Number :') }}</b> {{ $order->txn_no }}<br>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>{{ __('Order Date : ') }}</b> {{ $order->date }}<br>
                                <b>{{ __('Invoice Date : ') }}</b> {{ $order->formatted_created_at }}<br>
                            </div>
                            <div class="col-12">
                                <hr class="mt-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <strong>Ship-From Address</strong>
                                <address class="mb-0">
                                    {{ @$order->from['full_name'] }}<br>
                                    {{ @$order->from['number'] }}<br>
                                    <span>{{ @$order->from['address'] ?? '' }}, </span>
                                    <span>{{ @$order->from['address2'] ?? '' }}</span><br>
                                    <span>{{ @$order->from_country_name ?? '' }}, </span>
                                    <span>{{ @$order->from_state_name ?? '' }}</span><br>
                                    <span>{{ @$order->from_city_name ?? '' }}</span>({{ @$order->from['pincode'] }})
                                </address>
                            </div>
                            <div class="col-sm-3">
                                <strong>To</strong>
                                <address class="mb-0">
                                    {{ @$order->to['full_name'] }}<br>
                                    {{ @$order->to['number'] }}<br>
                                    <span>{{ @$order->to['address'] ?? '' }}, </span>
                                    <span>{{ @$order->to['address2'] ?? '' }}</span><br>
                                    <span>{{ @$order->to_country_name ?? '' }}, </span>
                                    <span>{{ @$order->to_state_name ?? '' }}</span><br>
                                    <span>{{ @$order->to_city_name ?? '' }}</span>({{ @$order->to['pincode'] }})
                                </address>
                            </div>
                        </div>
                        <div class="row mt-4">
                            @php
                                $subTotal = 0;
                                $totalQty = 0;
                                $totalDisc = 0;
                                $totalTax = 0;
                                $total = 0;
                            @endphp
                            <div class="col-12 table-responsive">
                                <span class="mb-1">Total Items : <b>{{ $order->orderItems->count() }}</b></span>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Qty') }}</th>
                                            <th>{{ __('Gross Amount') }}</th>
                                            <th>{{ __('Discounts/Coupons') }}</th>
                                            <th>{{ __('Tax') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($order->orderItems))
                                            @foreach ($order->orderItems as $orderItem)
                                                <tr>
                                                    <td>{{ $orderItem->item->name }}</td>
                                                    <td>{{ $orderItem->qty }}</td>
                                                    <td>{{ format_price($orderItem->price) }}</td>
                                                    <td>{{ format_price($order->discount) }}</td>
                                                    <td>{{ $orderItem->item->tax_percent ?? 0 }}%</td>
                                                    <td>{{ format_price($order->total) }}</td>
                                                </tr>
                                                @php
                                                    $subTotal += $orderItem->price;
                                                    $totalQty += $orderItem->qty;
                                                    $totalDisc += $order->discount;
                                                    $totalTax += $orderItem->item->tax_percent;
                                                    $total += $order->total;
                                                @endphp
                                            @endforeach
                                            <tr style="border-top:1px solid #dee2e6;">
                                                <th>Total</th>
                                                <th>{{ $totalQty }}</th>
                                                <th>{{ format_price($subTotal) }}</th>
                                                <th>{{ format_price($totalDisc) }}</th>
                                                <th>{{ $totalTax }}%</th>
                                                <th>{{ format_price($total) }}</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <hr class="mt-0">
                                <div class="text-right mr-4" style="font-size: 14px;">{{ __('Grand Total : ') }}<b>
                                        {{ format_price($total) }} </b></div>
                            </div>
                        </div>
                        <div class="row no-print mt-3">
                            <div class="col-12">
                                <a href="javascript:void(0)" onclick="CreatePDFfromHTML()" title="Download PDF"
                                    class="print-btn btn btn-sm btn-primary">Download</a>
                                <a href="javascript:void(0)" onclick="window.print();" title="Download PDF"
                                    class="print-btn btn btn-sm btn-danger">Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- START GET PDF INIT --}}
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script>
        @if ($order->id != null)
            var invoice_Id = "{{ $order->getPrefix() }}";
        @endif
        //Create PDf from HTML...
        function CreatePDFfromHTML() {
            $('.print-btn').addClass('d-none');
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            html2canvas($(".html-content")[0], {
                background: '#FFFFFF',
            }).then(function(canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width,
                    canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4),
                        canvas_image_width, canvas_image_height);
                }
                pdf.save(invoice_Id);
            });
            $('.print-btn').removeClass('d-none');
        }
    </script>
    {{-- END GET PDF INIT --}}
@endpush
