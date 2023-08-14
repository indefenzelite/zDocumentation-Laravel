
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
                            <th  class="col-2">Title</th>        
                            <th  class="col-3">	Visibility</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($sliders->count() > 0)
                            @foreach($sliders as $slider)
                                <tr>
                                    <td class="col-2">{{ $slider->getPrefix() }}</td>
                                    <td class="col-1">{{ $slider->title }}</td>
                                    <td class="col-1">{{$slider->status == 1 ? 'Published':'Unpublished'}}</td>
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