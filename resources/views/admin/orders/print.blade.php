@extends('layouts.empty') 
@section('title', 'Orders')
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
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                     
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>                                      
                                    <th>SNO.</th>
                                    <th>User Name</th>
                                    <th>Txn No</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                   @foreach($orders as  $order)
                                        <tr>
                                            <td class="col_1">{{ $loop->iteration }}</td>
                                            <td class="col_2">{{$order->user->full_name ?? ''}}</td>
                                            <td class="col_3">{{$order->txn_no }}</td>
                                            <td class="col_4">
                                                <ul>
                                                    @if (!empty($order->has('orderItems')))
                                                        @foreach($order->orderItems as $orderItem)
                                                            {{Str::ucfirst(@$orderItem->item->name??'N/A') }}
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td class="col_5">{{format_price($order->total) }}</td>
                                            <td class="col_6">{{ $order->status_parsed->label}}</td>
                                            <td class="col_7">{{ ($order->formatted_created_at) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">No Data Found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
