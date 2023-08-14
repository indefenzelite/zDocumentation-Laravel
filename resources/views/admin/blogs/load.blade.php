
    <div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $blogs->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $blogs->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $blogs->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $blogs->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="blogTable" class="table">
                <thead>
                    <tr>
                        <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>
                        <th class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th class="col_1">Title</th>
                        <th class="col_2">Creator</th>
                        <th class="col_3">Status</th>
                        <th class="col_4">Category</th>
                        <th class="col_5">Created At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @if($blogs->count() > 0)
                        @foreach($blogs as $blog)
                            <tr id="{{ $blog->id }}">
                                <td class="no-export">
                                    <div class="dropdown d-flex">
                                        <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$blog->id}}">
                                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                            @if(auth()->user()->isAbleTo('show_blog'))
                                                <li class="dropdown-item p-0"><a href="{{ route('admin.blogs.show', $blog->slug) }}" title="View Blog" class="btn btn-sm">Show</a></li>
                                            @endif
                                            @if(auth()->user()->isAbleTo('edit_blog'))
                                                <li class="dropdown-item p-0"><a href="{{ route('admin.blogs.edit', secureToken($blog->id)) }}" title="Edit Blog" class="btn btn-sm">Edit</a></li>
                                            @endif
                                            @if(auth()->user()->isAbleTo('delete_blog'))
                                                <li class="dropdown-item p-0 ">
                                                    <a href="{{ route('admin.blogs.destroy', $blog->id) }}" title="Delete Blog" class="btn btn-sm delete-item text-danger">Delete</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center no-export"><a href="{{ route('admin.blogs.show', $blog->slug) }}"target="_blank"class="btn btn-link">{{ $blog->getPrefix() }}<i class="ik ik-external-link"></i></a></td>
                                <td class="col_1 max-w-150">{{ Str::limit($blog->title,50) }}</td>
                                <td class="col_2">{{ $blog->user->full_name ?? 'Not Exists' }}</td>
                                <td class="col_3 is_publish-{{$blog->id}}" data-status="{{ $blog->is_publish }}" >
                                    <span class="badge badge-{{ $blog->is_publish == 1 ? 'success' : 'danger' }}">{{ $blog->is_publish == 1 ? 'Publish' : 'Unpublish' }}</span>
                                </td>
                                <td class="col_4">{{ $blog->category->name ?? ''}}</td>
                                <td class="col_5">{{ ($blog->formatted_created_at) }}</td>
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
            {{ $blogs->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($blogs->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $blogs->currentPage() ?? ''}}">
                </label>
            @endif
        </div>
    </div>
