@extends('layouts.empty') 
@section('title','User Subscriptions')
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
                                <th class="col_1">Name</th>
                                <th class="col_2">Type</th>
                                <th class="col_3">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($newsLetters->count() > 0)
                                @foreach($newsLetters as  $newsLetter)
                                    <tr>
                                        <td>{{$newsLetter->getPrefix()}}</td>
                                        <td>{{$newsLetter->name}}</td>
                                         <td>@if ($newsLetter->type == 1){{ 'Email' }} @else {{ 'Number' }}@endif</td>
                                        <td>{{$newsLetter->value }}</td>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection