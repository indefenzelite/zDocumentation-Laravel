
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $sliderTypes->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $sliderTypes->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $sliderTypes->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $sliderTypes->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
           
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="sliderType" class="table">
                <thead>
                    <tr>
                        <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>                                            
                        <th class="text-center col_1"># <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th class="col_5">Title</th>
                        <th class="col_2">Code</th>
                        <th class="col_3">Status</th>
                        <th class="col_4">Records</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @foreach($sliderTypes as  $sliderType)
                        <tr id="{{ $sliderType->id }}">
                            <td class="no-export">
                                <div class="dropdown">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$sliderType->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                        @if(auth()->user()->isAbleTo('edit_slider'))
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.slider-types.edit', secureToken($sliderType->id)) }}" title="Edit Slider Type" class="btn btn-sm">Edit</a></li>
                                        @endif
                                        @if(auth()->user()->isAbleTo('delete_slider'))
                                            @if($sliderType->is_system != 1)
                                                <li class="dropdown-item p-0"><a href="{{ route('admin.slider-types.destroy', $sliderType->id) }}" title="Delete Slider Type" class="btn btn-sm delete-item text-danger">Delete</a></li>
                                            @endif
                                        @endif
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.sliders.index',['sliderTypeId' => $sliderType->id]) }}" title="Manage Slider Type" class="btn btn-sm">Manage</a></li>
                                      </ul>
                                </div> 
                            </td>
                            <td class="text-center col_1"><a class="btn btn-link" href="@if(env('DEV_MODE') == 1) {{ route('admin.slider-types.edit', secureToken($sliderType->id)) }} @endif">{{  $sliderType->getPrefix() }}</a></td>
                            <td class="col_5">{{$sliderType->title }}</td>
                            <td class="col_2">{{$sliderType->code }}</td>
                            <td class="col_3">
                                @if ($sliderType->is_published == 1)
                                    <span class="badge badge-success">Publish</span>
                                @else
                                    <span class="badge badge-danger">Unpublish</span>
                                @endif
                            </td>
                            <td class="col_4"><a class="btn btn-link" href="@if(env('DEV_MODE') == 1) {{ route('admin.sliders.index',['sliderTypeId' => $sliderType->id]) }} @endif">{{$sliderType->sliders->count() }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $sliderTypes->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($sliderTypes->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $sliderTypes->currentPage() ?? ''}}">
            </label>
        @endif
        </div>
    </div>
