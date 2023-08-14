@extends('layouts.main') 
@section('title', 'Order')
@section('content')
@php
/**
* Order 
*
* @category  zStarter
*
* @ref  zCURD
* @author    Defenzelite <hq@defenzelite.com>
* @license  https://www.defenzelite.com Defenzelite Private Limited
* @version  <zStarter: 1.1.0>
* @link        https://www.defenzelite.com
*/
Use \Carbon\Carbon;
    $carbonObj = new Carbon();
    $breadcrumb_arr = [
        ['name'=>'Orders', 'url'=> route('admin.orders.index'), 'class' => ''],
        ['name'=>'Show Order', 'url'=> "javascript:void(0);", 'class' => '']
];
$from = $order->from;
$to = $order->to;
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
        .table thead {
            background-color: #fff;
        }
        .table thead th {
            border-bottom: 0px;
        }
        .select2-selection__rendered{
            width:150px;
        }
      
    </style>
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end mb-5">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Show Order-ID: {{ $order->getPrefix()}}</h5>
                            <span>TXN <strong class="text-muted">{{ $order->txn_no}}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- start message area-->
               @include('admin.include.message')
                <!-- end message area-->
                
                <div class="card mb-2">
                    <div class="card-header justify-content-between">
                        <h3>Information</h3>
                        <div class="d-flex justify-content-right">
                            <span class="badge badge-{{ $order->status_parsed->color}} m-1 p-2 status-change">{{ $order->status_parsed->label}}
                            <i class="fa fa-info-circle" title="Order Status"></i>
                            </span>
                        </div>
                       
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="customerInfo-tab" data-toggle="tab" href="#customerInfo" role="tab" aria-controls="customerInfo" aria-selected="true">Customer</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="sellerInfo-tab" data-toggle="tab" href="#sellerInfo" role="tab" aria-controls="sellerInfo" aria-selected="false">Seller</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="orderInfo-tab" data-toggle="tab" href="#orderInfo" role="tab" aria-controls="orderInfo" aria-selected="false">Order</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="customerInfo" role="tabpanel" aria-labelledby="home-tab">
                                <div class="mt-4">
                                    <h6 class="fw-700"><i class="fa fa-user-circle text-muted text-primary"></i> 
                                        {{ $order->user->name ?? '--' }}
                                    </h6>
                                    <div>
                                        <i class="fa fa-phone mr-1 text-muted"></i>
                                        <a class="text-muted" href="tel:{{ @$order->user->phone}}">{{ @$order->user->phone ?? '--' }}</a>
                                    <br>
                                        <i class="fa fa-envelope mr-1 text-muted"></i>
                                        <a class="text-muted" href="mailto:{{ @$order->user->email}}">{{ @$order->user->email ?? '--' }}</a>
                                    </div>
            
                                    <hr>
            
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <span class="text-muted"><i class="fa fa-map-marker text-warning"></i> From (Shipping)</span>
                                            <address>
                                               <strong>
                                              {{-- @dd($order->from); --}}
                                                {{ @$order->from['name']}}
                                                </strong><br>
                                                {{ @$order->from['phone']}}<br>
                                                <span>{{ @$order->from['address_1'] ?? ''}},</span>
                                                <span>{{ @$order->from['address_2'] ?? ''}}</span><br>
                                                <span>{{ @$order->from_country_name ?? ''}}, </span>
                                                <span>{{ @$order->from_state_name ?? ''}}</span><br>
                                                <span>{{ @$order->from_city_name ?? ''}}</span>({{ @$order->from['pincode_id']}})
                                            </address>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="text-muted"><i class="fa fa-map-marker text-success"></i> To (Delivery)</span>
                                            <address>
            
                                                <strong>
                                                 {{-- @dd($order->to); --}}
                                                    {{ @$order->to['name']}}
                                                </strong><br>
                                                {{ @$order->to['phone']}}<br>
                                                <span>{{ @$order->to['address_1'] ?? ''}}, </span>
                                                <span>{{ @$order->to['address_2'] ?? ''}}</span><br>
                                                <span>{{ @$order->to_country_name ?? ''}}, </span>
                                                <span>{{ @$order->to_state_name ?? ''}}</span><br>
                                                <span>{{ @$order->to_city_name ?? ''}}</span>({{ @$order->to['pincode_id']}})
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sellerInfo" role="tabpanel" aria-labelledby="sellerInfo-tab">
                                <div class="mt-4">
                                    <h6 class="fw-700"><i class="fa fa-user-circle text-muted text-primary"></i> 
                                        {{ $order->seller->name ?? '--' }}
                                    </h6>
                                    <div>
                                        <i class="fa fa-phone mr-1 text-muted"></i>
                                        <a class="text-muted" href="tel:{{ @$order->seller->phone}}">{{ @$order->seller->phone ?? '--' }}</a>
                                        <br>
                                        <i class="fa fa-envelope mr-1 text-muted"></i>
                                        <a class="text-muted" href="mailto:{{ @$order->seller->email}}">{{ @$order->seller->email ?? '--' }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orderInfo" role="tabpanel" aria-labelledby="orderInfo-tab">
                                <div class="row mt-4"> 
                                    <div class="col-md-12">
                                        <span class="fw-700"><i class="fa fa-sticky-note text-danger"></i> Remark</span>
                                        <p>{{$order->remarks ?? ''}}</p>
        
                                        <span class="fw-700"><i class="far fa-credit-card-alt text-primary"></i> Payment Mode</span>
                                        <p>{{$order->payment_gateway ?? ''}}</p>
        
                                        <span class="fw-700"><i class="fa fa-cart-shopping text-info"></i> Order Status</span>
                                        <p>{{$order->status_parsed->label ?? ''}}</p>

                                        <span class="fw-700"><i class="fa fa-money-bill text-warning"></i> Payment Status</span>
                                        <p>{{ @\App\Models\Order::PAYMENT_STATUS[$order->payment_status]['label']}}</p>

                                        <span class="fw-700"><i class="far fa-clock text-secondary"></i> Last Updated At</span>
                                        <p>{{$order->updated_at ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 table-responsive">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3><i class="fa fa-cart-arrow-down"></i> Items:</h3>
                        <div class="d-flex justify-content-end">
                            <div>
                                <span class="badge badge-{{ @\App\Models\Order::PAYMENT_STATUS[$order->payment_status]['color']}} p-2 m-1 status-change">{{ @\App\Models\Order::PAYMENT_STATUS[$order->payment_status]['label']}}
                                    <i class="fa fa-info-circle" title="Payment Status"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col_1 no-export">{{__('#')}}</th> 
                                    <th>{{ __('Product Name')}}</th>
                                    <th>{{ __('Qty')}}</th>
                                    <th>{{ __('Price')}}</th>
                                    <th>{{ __('Tax')}}</th>
                                    <th>{{ __('Amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($items->count() > 0)
                                    @foreach ($items as $item)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td ><span class="fw-700">{{ @$item->item->name ?? 'N/A' }} </span><br>
                                            </td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{format_price($item->rate) }}</td>
                                            <td>{{$item->tax_percent }}% (Incl) </td>
                                            <td>{{ format_price($item->incl_total) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="15">No Data Found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="row mt-5">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <table class="table">
                                    <tr>
                                        <th>Sub Total</th>
                                        <td>{{ format_price($items->sum('incl_total')) }}</td>
                                    </tr>
                                    {{-- @if(!empty($order->tax_data))
                                        @foreach ($order->tax_data as $tax)
                                        <tr>
                                            <th>{{$tax['name']}} ({{$tax['percent']}}%)</th>
                                            <td>{{format_price($order->tax)}}</td>
                                        </tr>
                                        @endforeach
                                    @endif --}}
                                    <tr>
                                        <td>IGST</td>
                                        <td>{{ format_price($items->sum('excl_total') - $items->sum('incl_total')) }}</td>
                                    </tr>
                                    @if($order->shipping)
                                        <tr>
                                            <th>Shipping</th>
                                            <td>+{{ format_price($order->shipping) }}</td>
                                        </tr>
                                    @endif
                                    @if($order->discount != null)
                                    <tr>
                                        <th>Discount</th>
                                        <td>-{{ format_price($order->discount) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="bg-light">
                                        <th><h6 class="fw-700">Grand Total</h6></th>
                                        <td><h6 class="fw-700">{{ format_price($order->total) }}</h6></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="text-muted">
                                            Order Date <br>
                                        </span>
                                        <strong>
                                            {{$carbonObj->parse($order->date)->format('jS M Y')}}
                                        </strong>
                                        <br>
                                        @if($carbonObj->parse($order->date)->addDays(7) < now())
                                            <span class="fw-700 text-warning">
                                                Order Delayed
                                            </span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="mr-2"> 
                                            <form action="{{route('admin.orders.payment-status-update',$order->id)}}"method="get"id="updatePaymentStatus">
                                                @csrf
                                                @if($order->payment_status != App\Models\Order::PAYMENT_STATUS_REFUNDED)
                                                    <select required name="payment_status" id="payment-status" class="form-control select2" style="width: 100%;">
                                                        @if($order->payment_status == App\Models\Order::PAYMENT_STATUS_UNPAID)
                                                            <option readonly>Update Pay Status</option>
                                                            <option value="2">Paid</option>
                                                        @endif
                                                        @if($order->payment_status == App\Models\Order::PAYMENT_STATUS_PAID)
                                                        <option readonly>Update Pay Status</option>
                                                        <option value="3">Refund Processing</option>
                                                        @endif
                                                        @if($order->payment_status == App\Models\Order::PAYMENT_STATUS_REFUND_PROCESSING)
                                                        <option readonly>Update Pay Status</option>
                                                        <option value="4">Hold</option>
                                                        <option value="5">Refunded</option>
                                                        @endif
                                                        @if($order->payment_status == App\Models\Order::PAYMENT_STATUS_HOLD)
                                                        <option readonly>Update Pay Status</option>
                                                        <option value="5">Refund</option>
                                                        @endif
                                                    </select>
                                                @endif
                                                </form>
                                        </div>
                                        
                                        <div class="mr-2"> 
                                            <form action="{{route('admin.orders.status-update',$order->id)}}" method="get" id="updateStatus">
                                                @if($order->status != App\Models\Order::STATUS_HOLD && $order->status != App\Models\Order::STATUS_CANCELLED && $order->status != App\Models\Order::STATUS_COMPLETED)
                                                    <select required name="status" id="status" class="form-control select2" style="width: 100%;">
                                                        @if($order->status == App\Models\Order::STATUS_IDLE)
                                                        <option readonly>Update Status</option>
                                                            <option value="{{App\Models\Order::STATUS_PACKED}}">Packed</option>
                                                            <option value="{{App\Models\Order::STATUS_CANCELLED}}">Cancelled</option>
                                                        @endif
                                                        @if($order->status == App\Models\Order::STATUS_PACKED)
                                                        <option readonly>Update Status</option>
                                                        <option value="{{App\Models\Order::STATUS_SHIPPED}}">Shipped</option>
                                                        <option value="{{App\Models\Order::STATUS_CANCELLED}}">Cancelled</option>
                                                        @endif
                                                        @if($order->status == App\Models\Order::STATUS_SHIPPED)
                                                        <option readonly>Update Status</option>
                                                        <option value="{{App\Models\Order::STATUS_DELIVERED}}">Delivered</option>
                                                        <option value="{{App\Models\Order::STATUS_CANCELLED}}">Cancelled</option>
                                                        @endif
                                                        @if($order->status == App\Models\Order::STATUS_DELIVERED)
                                                        <option readonly>Update Status</option>
                                                        <option value="{{App\Models\Order::STATUS_COMPLETED}}">Completed</option>
                                                        <option value="{{App\Models\Order::STATUS_CANCELLED}}">Cancelled</option>
                                                        @endif
                                                    </select>
                                                @endif
                                                </form>
                                        </div>
                                        <div class=""> 
                                            <a href="{{ route('admin.orders.invoice', $order->id) }}" title="Invoice" target="_blank" class="btn btn-sm btn-outline-info ml-2">View Invoice <i class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('admin/js/form-advanced.js') }}"></script>
    
    {{-- START SELECT 2 INIT --}}
    <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $('select.select2').select2();
    </script>
    {{-- END SELECT 2 INIT --}}

    {{-- START JS HELPERS INIT --}}
    <script>
        $('#OrderForm').validate();
        $(document).ready(function(){
            $('#status').on('change', function() {
                $('#updateStatus').submit();
            });
            $('#payment-status').on('change', function() {
                $('#updatePaymentStatus').submit();
            });
        });

    </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
