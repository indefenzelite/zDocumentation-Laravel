@extends('layouts.empty') 
@section('title', 'User')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                            <tr>   
                                <th>#</th>                                   
                                <th>Name</th>
                                <th>Price</th>
                                <th>Visibility</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($subscriptions->count() > 0)
                                @foreach($subscriptions as  $subscription)
                                    <tr>
                                        <td> {{  $subscription->getPrefix() }}</td>
                                        <td>{{$subscription['name'] }}</td>
                                        <td>@if($subscription->price == 0)Free @else {{ format_price($subscription->price) }}@endif</td>
                                        <td>{{getPublishStatus($subscription->is_published)['name'] }}</td>
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