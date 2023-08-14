
    <div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $websitePages->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $websitePages->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $websitePages->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $websitePages->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
           <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="page_table" class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">{{('Actions')}} <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                            {{-- <th class="no-export">{{('Actions')}}</th> --}}
                            <th class="col_1" >{{ ('Name') }}</th>
                            {{-- <th class="col_1" >{{ ('Slug') }}</th> --}}
                            <th class="col_2">{{('Status')}}</th>
                            <th class="no-export">{{('Created At')}}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if($websitePages->count() > 0)
                            @foreach($websitePages as $websitePage)
                                <tr id="{{ $websitePage->id }}">
                                    <td class="no-export">
                                        <div class="dropdown d-flex">
                                            <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$websitePage->id}}">
                                            <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu"> 
                                                @if(auth()->user()->isAbleTo('show_page'))
                                                    <li class="dropdown-item p-0"><a href="{{ route('page.slug',$websitePage->slug) }}" title="" class="btn btn-sm">Show</a></li>
                                                @endif
                                                @if(auth()->user()->isAbleTo('edit_page'))
                                                    <li class="dropdown-item p-0"><a href="{{ route('admin.website-pages.edit', secureToken($websitePage->id)) }}" title="Edit Blog" class="btn btn-sm">Edit</a></li>
                                                @endif
                                                @if(auth()->user()->isAbleTo('delete_page'))
                                                    <li class="dropdown-item p-0"><a href="{{ route('admin.website-pages.destroy', $websitePage->id) }}" title="Edit Blog" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                                @endif    
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="col_1">{{ $websitePage->title }}</td>
                                    {{-- <td class="col_2">{{ $websitePage->slug }}</td> --}}
                                    <td class="col_2"><span class="badge badge-{{ getPublishStatus($websitePage->status)['color']}}">{{ getPublishStatus($websitePage->status)['name'] }}</span>
                                    </td>
                                    <td>{{$websitePage->formatted_created_at}}</td>
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
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $websitePages->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($websitePages->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $websitePages->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
