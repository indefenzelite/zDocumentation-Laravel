
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $sliders->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $sliders->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $sliders->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $sliders->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
                                
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.sliders.print') }}" data-rows="{{ json_encode($sliders) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="sliderTable" class="table">
                <thead>
                    <tr>
                        <th class="no-export " ><input type="checkbox" class="mr-2 allChecked " name="id" value="" >Actions</th>                                            
                        <th class="text-center col_1"># <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th class="col_2">Title</th>
                        <th class="col_3">Type</th>
                        <th class="col_4">Visibility</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @if($sliders->count() > 0) 
                        @foreach($sliders as  $slider)
                            <tr id="{{$slider->id}}">
                                <td class="no-export">
                                    <div class="dropdown ">
                                        <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$slider->id}}">
                                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.sliders.edit',[secureToken($slider->id),'sliderTypeId' => request()->get('sliderTypeId')]) }}" title="Edit Slider" class="btn btn-sm">Edit</a></li>
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.sliders.destroy', $slider->id) }}" title="Delete Slider" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                        </ul>
                                    </div> 
                                </td>
                                <td class="text-center col_1"> {{  $slider->getPrefix() }}</td>
                                <td class="col_2">{{$slider->title }}</td>
                                <td class="col_3">
                                    <span class="badge badge-{{@\App\Models\Slider::TYPES[$slider->type]['color'] ?? '--' }}">
                                        {{@\App\Models\Slider::TYPES[$slider->type]['label'] ?? '--' }}
                                    </span>
                                </td>
                                <td class="col_4 status-{{$slider->id}}"data-status="{{ $slider->status }}"><span class="badge badge-{{$slider->status == 1 ? 'success':'danger'}}">{{$slider->status == 1 ? 'Published':'Unpublished'}}</span></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $sliders->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($sliders->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $sliders->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
