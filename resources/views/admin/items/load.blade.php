<div class="card-body">
    <div class="table-controller mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10"{{ $items->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25"{{ $items->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50"{{ $items->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100"{{ $items->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div>
        <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
            
            <a href="javascript:void(0);" id="print" data-url="{{ route('admin.items.print') }}"  data-rows="{{json_encode($items) }}" class="btn btn-primary btn-sm refresh-page">Print</a>                
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th class=" no-export"><input type="checkbox" class="allChecked mr-1" name="id[]" value="">Actions</th> 
                    <th class=" text-center no-export">{{ __('#')}} <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>                        
                    <th class="col_1"> Product Name </th>                                                 
                    {{-- <th class="col_1">  User </th>                                                  --}}
                    <th class="col_4">  SKU </th>                                             
                    <th class="col_2">  Category</th>                                                 
                    <th class="col_3">  Price </th>                                               
                    <th class="col_7">  Visibility </th>   
                    <th class="col_6">  Created At </th>                                             
                </tr>
            </thead>
            <tbody class="no-data">
                @if($items->count() > 0)                          
                @foreach($items as  $item)
                        <tr id="{{ $item->id }}">
                            <td class="no-export">
                                <div class="dropdown">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{ $item->id }}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        @if(auth()->user()->isAbleTo('edit_item'))
                                        <a href="{{ route('admin.items.edit', secureToken($item->id)) }}" title="Edit Item" class="dropdown-item "><li class="p-0">Edit</li></a>
                                        @endif
                                        @if(auth()->user()->isAbleTo('delete_item'))
                                            <a href="{{ route('admin.items.destroy', $item->id) }}" title="Delete Item" class="dropdown-item  delete-item text-danger fw-700"><li class=" p-0">Delete</li></a>
                                        @endif
                                    </ul>
                                </div> 
                            </td>
                            <td  class="text-center no-export"> 
                                
                                <a class="btn btn-link" href="{{ route('admin.items.edit', secureToken($item->id)) }}"> 
                                    {{  $item->getPrefix() }} 
                                    @if($item->is_featured == 1)
                                    <span title="Featured">
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        {{-- <i class="fa fa-check-star text-dark" aria-hidden="true"></i> --}}
                                    </span>
                                @endif
                                </a>
                               
                                
                            </td>
                                                                
                            <td class="col_1 fw-700 max-w-150">
                                {{Str::limit($item->name ?? '',50)}}
                            </td>                                     
                            {{-- <td class="col_1 max-w-150">
                                {{Str::limit($item->user->full_name ?? '',50)}}
                            </td>                                      --}}
                            <td class="col_4">
                                {{Str::limit($item->sku,20) ?? '--' }}
                            </td>   
                            <td class="col_2">{{ @$item->category->name??'N/A'}}</td>                                    
                            <td class="col_3">
                                {{format_price($item->sell_price)}}
                                @if($item->status == "Available")
                                    <i class="ik ik-box" title="Available"></i>
                                @endif
                            </td>      
                            <td class="is_published-{{$item->id}}" data-status="{{ $item->is_published }}" >
                                <span class="col_7  badge badge-{{ getPublishStatus($item->is_published)['color'] }}">{{getPublishStatus($item->is_published)['name']}}</span>
                            </td>                              
                            <td class="col_6">{{$item->formatted_created_at }}</td>   
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
<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $items->appends(request()->except('page'))->links() }}
    </div>
    <div>
        
        @if($items->lastPage() > 1)
        <label class="d-flex justify-content-end" for="">
            <div class="mr-2 pt-2">
                Jump To: 
            </div>
            <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $items->currentPage() ?? ''}}">
        </label>
    @endif
    </div>
</div>
