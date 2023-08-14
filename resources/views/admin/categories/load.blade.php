    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $categories->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $categories->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $categories->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $categories->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="category_table" class="table">
                    <thead>
                        <tr>
                            <th class="no-export"><input type="checkbox" class="mr-2 allChecked " id="selectall" name="id" value="">Actions</th>
                            <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>  
                            <th>Name</th>
                            @if($categoryType && $categoryType->allowed_level > $level)
                                <th>Child Category Count</th> 
                            @endif
                        </tr>
                    </thead>
                    <tbody class="no-data">
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <tr id="{{$category->id}}">
                                <td>
                                    <div class="dropdown d-flex">
                                        <input type="checkbox" class="mr-2 text-center" name="id" onclick="countSelected()" value="{{  $category->id}}">
                                        {{-- <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$category->id}}"> --}}
                                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.categories.edit',[ secureToken($category->id),'parent_id' => request()->get('parent_id')])  }}" title="Edit Lead Contact" class="btn btn-sm">Edit</a></li>
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.categories.destroy', $category->id)  }}" title="Edit Lead Contact" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                          </ul>
                                    </div>
                                </td>
                                <td class="text-center">{{ $category->getPrefix() }}</td>
                                <td>{{ $category->name }}</td>
                                @if($categoryType && $categoryType->allowed_level > $level)
                                    <td>
                                        @if($nextLevel <= 3)
                                            <a class="btn btn-link" href="{{route('admin.categories.index',[$category->category_type_id, 'level' => $nextLevel ,'parent_id'=>$category->id])}}">{{ App\Models\Category::where('parent_id',$category->id)->where('parent_id','!=',null)->count() }}</a>
                                        @else 
                                            ---
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @else 
                        <tr>
                            <td class="text-center" colspan="15">No Data Found...</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $categories->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($categories->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $categories->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
