
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
                                <th>Id</th>                                    
                                <th>User </th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Approved At</th>
                                <th>Created At</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($payouts->count() > 0)
                                @foreach($payouts as  $payout)
                                    <tr>
                                        <td class="text-primary">#POUT{{ $payout->id}}</td>
                                        <td>{{$payout->user->full_name ?? ''}}</td>
                                         <td>{{$payout->amount }}</td>
                                         <td>{{$payout->status_parsed->label }}</td>
                                         <td>{{$payout->approved_at }}</td>
                                         <td>{{$payout->created_at }}</td>
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
