
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
                                <th>Category  </th>
                                <th>Sell Price</th>
                                <th>Status</th>
                                <th>Slug</th>
                                <th>Visibility</th>
                                <th>SKU</th>
                                <th>Created At</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($items->count() > 0)
                                @foreach($items as  $item)
                                    <tr>
                                        <td>{{$item->getPrefix() }}</td>
                                        <td>{{$item['name'] }}</td>
                                         <td>{{$item->category->name??'N/A'}}</td>
                                         <td>{{$item['sell_price'] }}</td>
                                         <td>{{$item['status'] }}</td>
                                         <td>{{$item['slug'] }}</td>
                                         <td>{{getPublishStatus($item->is_published)['name'] }}</td>
                                         <td>{{$item['sku'] }}</td>
                                         <td>{{$item->created_at}}</td>
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