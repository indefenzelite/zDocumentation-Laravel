<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .table td, .table th {
            padding: 3px;
        }
        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            font-size: 12px;
        }
        .grid-2::after{
            content: "";
            position: relative;
            display: block;
            clear: both;
        }
        .th-color{
            background-color: #4848f2!important;
            color: #fff !important;
        }
        .col-9 p{
            margin-bottom: 0px;
        }
        .col-9 ul{
            margin-bottom: 0px;
        }
        .col-9 ol{
            margin-bottom: 0px;
        }
        .col-9 li{
            font-size: 12px;
        }
        .fw-15{
            font-size: 15px;
        }
        .note{
            margin-top: 40px !important;
            margin-right: 5px;
            color: rgb(157, 150, 150);
            font-size: .75rem;
        }
        @page {
        size: A4;
        margin: 0;
        }
        @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        /* ... the rest of the rules ... */
        }
    </style>
</head>
@php
    $admin = App\Models\User::whereRoleIs(['Admin'])->first();
@endphp

<div class="card html-content bg-white">
    <div class="card-body bg-white">
        <div class="grid-2 ">
            <div class="w-50" style="float:left;">
                <h2 class="badge badge-primary text-white font-weight-bold"
                    style="font-size: 18px;background-color:#4848f2">
                    @if ($order->txn_no)
                        {{$order->txn_no}} 
                    @else
                        ORID#{{ $order->id }}
                    @endif
                </h2>
                <p class="mt-2 mb-0">Order Date : {{ $order->date }}</p>
            </div>
            <div class="w-50" style="float:right; text-align:right;">
                <img class="pt-0" style="height: 50px;" src="{{ getBackendLogo(getSetting('app_logo'))}}" alt="">
            </div>
        </div>
        <div class="grid-2 mt-4">
            <div class="w-50" style="float: left"  width="100">
                <div>
                    <span>Invoice To</span>
                </div>
                <hr class="m-0 ">
                <address class="fw-15">
                    @if ($order->to)
                    <strong>{{ @$order->to['name'] }}</strong><br>
                        <div class="mb-0" style="width: 60%">
                            {{ @$order->to['address_1'] ?? '' }} <br>
                            {{ @$order->to['address_2'] ?? '' }} <br>{{ @$order->to['city'] ?? '' }}, {{ @$order->to['state'] ?? '' }},{{ @$order->to['country'] ?? '' }}
                        </div>
                    @endif
                    @if(@$order->to && @$order->to['phone'])
                        Phone : {{ @$order->to['phone']}}<br>
                    @endif
                </address>
            </div>
            <div class="w-50 mt-1" style="float: right" width="100">
                <address class="fw-15">
                    <hr style="border-top: 0px " class="mt-0">
                    <strong>{{ $order->from['name'] }}</strong><br>
                    @if ($order->from)
                        <div class="mb-0" style="width: 60%">
                            {{ $order->from['address_1'] ?? '' }} <br>
                            {{ $order->from['address_2'] ?? '' }} <br>{{ $order->from['city'] ?? '' }}, {{ $order->from['state'] ?? '' }},{{ $order->from['country'] ?? '' }}
                        </div>
                    @endif
                    @if($order && $order->from['phone'])
                        Phone : {{ $order->from['phone']}}<br>
                    @endif
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped bg-white">
                    <thead >
                        <tr class="th-color">
                            <th class="" style="width: 40%">{{ __('Item') }}</th>
                            <th class="">{{ __('Quantity') }}</th>
                            <th class="">{{ __('Rate') }}</th>
                            <th class="">{{ __('Tax') }}</th>
                            <th class="">{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $subtotal = 0;
                            $discount_amount = 0;
                        @endphp
                        @if($orderItems->count() > 0)
                            @foreach($orderItems as $orderItem)
                                <tr class="bg-white">
                                    <td>{{  $orderItem->item->name ?? '' }}</td>
                                    <td>{{ $orderItem->qty}}</td>
                                    <td><span style="font-family: DejaVu Sans; sans-serif;"></span>{{ format_price($orderItem->rate) ?? 0 }}</td>
                                    <td>{{ $orderItem->tax_percent}}% (Incl)</td>
                                    <td><span style="font-family: DejaVu Sans; sans-serif;"></span>{{ format_price($orderItem->incl_total) ?? 0 }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            {{-- @if(!empty($order->tax_data))
                                @foreach ($order->tax_data as $tax)
                                    <tr>
                                        <td class="empty-td"></td>
                                        <td class="empty-td"></td>
                                        <th>{{$tax['name']}} ({{$tax['percent']}}%)</th>
                                        <td>{{format_price($order->tax)}}</td>
                                    </tr>
                                @endforeach
                            @endif --}}
                            <tr>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <th>IGST </th>
                                <td>{{format_price($orderItems->sum('excl_total') - $orderItems->sum('incl_total'))}}</td>
                            </tr>
                            <tr>    
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="">Shipping</td>
                                <td><span style="font-family: DejaVu Sans; sans-serif;"></span>+{{ format_price($order->shipping) }}</td>
                            </tr>
                            <tr>    
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="">Discount</td>
                                <td><span style="font-family: DejaVu Sans; sans-serif;"></span>-{{ format_price($order->discount) }}</td>
                            </tr>
                            <tr>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="empty-td"></td>
                                <td class="th-color" style="vertical-align: initial">Total</td>
                                <td class="th-color font-weight-bold"><span style="font-family: DejaVu Sans; sans-serif;"></span>{{ format_price($order->total) }}</td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <h5>Notes:-</h5>
                <ul>
                    <li> Make all cheques payable to DEFENZELITE PRIVATE LIMITED</li>
                </ul>
                <h5>Documents:-</h5>
                <ul>
                    <li>CIN No. - U72900MP2017PTC044406</li>
                    <li>PAN No. - AAGCD4055K</li>
                    <li>DIPP No. - DIPP10999</li>
                    <li>LUT No. - AD230122006357P</li>
                    <li>SAC No. - 998319</li>
                    <li>TAN No. - JBPD04056D</li>
                    <li>UDYAM No. - MP-42-0001818</li>
                </ul>
                <h5>Bank Detail:-</h5>
                <ul>
                    <li> Bank Name: ICICI Bank</li>
                    <li> Bank Name: ICICI Bank</li>
                    <li>Account Type: Current</li>
                    <li>Account Name: DEFENZELITE PRIVATE LIMITED</li>
                    <li> Account No. 099305005177</li>
                    <li>IFSC Code: ICIC0000993</li>
                    <li>Branch: Seoni (Kachari Chowk)</li>
                </ul>
            </div>
        </div>
        <div class="mt-3 note">
            <p>If you have any questions concerning this invoice, contact {{$admin->name}} at
                <br>
                +{{$admin->phone}}
            </p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>