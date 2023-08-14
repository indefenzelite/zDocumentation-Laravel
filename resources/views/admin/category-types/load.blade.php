
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $categoryTypes->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $categoryTypes->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $categoryTypes->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $categoryTypes->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <style>
           .custom-card {
                /* Your regular card styles */
                border: 1px solid #ced4da;
                transition: box-shadow 0.3s;
                cursor: pointer;
                padding: 10px;
            }
            .custom-card.selected {
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
                border: 2px solid #1373d9 !important;
            }
        </style>
        <div class="row no-gutters custom-bulk-section">
            @foreach ($categoryTypes as $categoryType)
            <div class="col-md-3">
                <label for="card-{{ $categoryType->id }}" class="p-2 w-100">
                    <div class="form-check" style="visibility: hidden;">
                        <input type="checkbox" class="form-check-input toggle-selected" name="id" id="card-{{ $categoryType->id }}" value="{{ $categoryType->id }}" onclick="countSelected($(this))">
                    </div>
                    <div class="dropdown" style="height:2px;z-index: 99;">
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ik ik-more-vertical"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            @if(auth()->user()->isAbleTo('edit_category'))
                                <a href="{{ route('admin.category-types.edit', secureToken($categoryType->id)) }}" title="Edit Category Group" class="dropdown-item">Edit</a>
                            @endif
                            <a href="{{ route('admin.categories.index', $categoryType->id) }}" title="Manage Category Group" class="dropdown-item">Manage</a>
                            @if(auth()->user()->isAbleTo('delete_category'))
                                <a href="{{ route('admin.category-types.destroy', $categoryType->id) }}" title="Delete Category Group" class="dropdown-item text-danger fw-700 delete-item">Delete</a>
                            @endif
                        </div>
                    </div>
                    <div class="card custom-card border mb-0 text-center">
                        <div class="card-title mt-4 mb-0">
                            <h6 class="mb-0">{{ ucwords(str_replace('_', ' ', $categoryType->name)) ?? '-' }}</h6>
                        </div>
                        <small>Code</small>
                        {{ $categoryType->code }}
                    </div>
                </label>
            </div>
            @endforeach
        </div>
        {{-- <div class="table-responsive ">
            
            <table id="categoryTypeTable" class="table">
                <thead>
                    <tr>
                        <th class="no-export"><input type="checkbox" class="mr-2" id="selectall" name="id" value="">Actions</th>
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>  
                        <th class="col_2">Code</th>
                        <th class="col_2">Category</th>
                        <th class="col_2">Records</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @foreach($categoryTypes as $categoryType)

                        <tr id="{{$categoryType->id}}">

                            <td class="no-export">
                                <div class="dropdown">
                                    <input type="checkbox" class="mr-2 text-center" name="id" onclick="countSelected()" value="{{  $categoryType->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                        @if(auth()->user()->isAbleTo('edit_category'))
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.category-types.edit',secureToken( $categoryType->id)) }}" title="Edit Category Group" class="btn btn-sm">Edit</a></li>
                                        @endif
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.categories.index',$categoryType->id) }}" title="Manage Category Group" class="btn btn-sm">Manage</a></li>
                                        @if(auth()->user()->isAbleTo('delete_category'))
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.category-types.destroy', $categoryType->id) }}" title="Delete Category Group" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                        @endif
                                        
                                      </ul>
                                </div>
                            </td>
                            <td class="text-center col_1"><a class="btn btn-link" href="@if(env('DEV_MODE') == 1) {{ route('admin.category-types.edit',$categoryType->id) }} @endif">{{ $categoryType->getPrefix() }}</a></td>
                            <td class="col_2">{{ $categoryType->code}}</td>
                            <td class="col_2">{{ ucwords(str_replace('_',' ',$categoryType->name)) ?? '-' }}</td>
                            <td class="col_2"><a class="btn btn-link" href="@if(env('DEV_MODE') == 1) {{ route('admin.categories.index',$categoryType->id) }} @endif">{{ $categoryType->categories->count()}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $categoryTypes->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($categoryTypes->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $categoryTypes->currentPage() ?? ''}}">
                </label>
           @endif
        </div>
    </div>
