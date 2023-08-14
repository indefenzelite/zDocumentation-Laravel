
@extends('layouts.empty') 
@section('title', 'Article')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table id="article_table" class="table">
                    <thead>
                        <tr>
                            <th  class="col-1">ID</th>
                            <th  class="col-2">Headline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($sliderTypes->count() > 0)
                            @foreach($sliderTypes as $sliderType)
                                <tr>
                                    <td class="col-2">{{ $sliderType->getPrefix() }}</td>
                                    <td class="col-1">{{ $sliderType->title }}</td>
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