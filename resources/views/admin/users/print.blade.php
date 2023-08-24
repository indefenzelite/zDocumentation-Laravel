
@extends('layouts.empty') 
@section('title', 'User')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="user_table" class="table p-0">
                        <thead>
                            <tr>
                                <th class="col_1">{{ __('S No.')}}</th>
                                <th class="col_2">{{ __('Customer')}}</th>
                                <th class="col_3">{{ __('Role')}}</th>
                                <th class="col_4">{{ __('Email')}}</th>
                                <th class="col_4">{{ __('Phone')}}</th>
                                <th class="col_6">{{ __('Status')}}</th>
                                <th class="col_7">{{ __('Join At')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                                @foreach ($users as $user)
                                <tr>
                                    <td class="col_1">{{ $loop->iteration ??'--'}}</td>
                                    <td class="col_2">{{ $user->full_name ??'--'}}</td>
                                    <td class="col_3">{{$user->role_name ??'--'}}</td>
                                    <td class="col_4">{{ $user->email ??'--'}}</td>
                                    <td class="col_4">{{ $user->phone ??'--'}}</td>
                                    <td class="col_6">{{ $user->status_parsed->label ??'--'}}</td>
                                    <td class="col_7">{{ ($user->created_at) }}</td>
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