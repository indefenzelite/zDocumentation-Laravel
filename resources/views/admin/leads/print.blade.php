
@extends('layouts.empty') 
@section('title', 'Lead')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table id="lead_table" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Last Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($leads->count() > 0)
                            @foreach($leads as $item)
                                <tr>
                                    <td>{{ $item->getPrefix() }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{$item->owner_email  }}</td>
                                    <td>{{$item->phone }}</td>
                                    <td>{{ $item->category->name ?? '' }}</td>
                                    <td>{{ $item->leadType->name ?? '' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
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
@endsection