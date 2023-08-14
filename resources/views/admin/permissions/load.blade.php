
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $permissions->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $permissions->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $permissions->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $permissions->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
           </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="permissions_table" class="table">
                <thead>
                    <tr>
                        <th class="no-export">{{('Action')}}  <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th>{{ __('Permission')}}</th>
                        <th>{{ __('Assigned Roles')}}</th>
                    </tr>
                </thead>
                    <tbody>
                    @if($permissions->count() > 0)
                        @foreach($permissions as $item)
                        <tr>
                            <td class="no-export">
                                @if(env('DEV_MODE') == 1)
                                <a href="{{ route('admin.permissions.destroy',$item->id) }}" class="confirm-btn">
                                    <i class="ik ik-trash-2 f-16 text-red"></i>
                                </a>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach ($item->roles()->get() as $role)
                                    <span class="badge badge-dark mr-1">{{ $role->display_name }}</span>
                                @endforeach
                            </td>
                            
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
            {{ $permissions->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($permissions->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $permissions->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
