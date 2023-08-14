@extends('layouts.empty') 
@section('title', 'User Subscriptions')
@section('content')
@php
/**
 * User Subscription 
 *
 * @category ZStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
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
                                    <th>User  </th>
                                    <th>Subscription  </th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Parent  </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($user_subscriptions->count() > 0)
                                    @foreach($user_subscriptions as  $user_subscription)
                                        <tr>
                                            <td>{{@$user_subscription->user->full_name}}</td>
                                            <td class="col_2">{{ @$user_subscription->subscription->name??'N/A'}}</td>                                    
                                            <td class="col_3">{{$user_subscription->from_date }}</td>                                     
                                            <td class="col_4">{{$user_subscription->to_date }}</td>   
                                            <td class="col_4">{{$user_subscription->created_at }}</td>
                                                 
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
