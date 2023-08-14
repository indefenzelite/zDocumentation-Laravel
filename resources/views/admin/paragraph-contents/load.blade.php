
    <div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $paragraphContents->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $paragraphContents->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $paragraphContents->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $paragraphContents->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="paragraphTable" class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>
                        <th class="text-center"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                        <th>Code</th>
                        {{-- <th>Value</th> --}}
                        {{-- <th>Remark</th> --}}
                        <th>Type</th>
                        <th>Group</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @foreach ($paragraphContents as $paragraphContent)
                        <tr id="{{ $paragraphContent->id }}">
                            <td>
                                <div class="dropdown">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$paragraphContent->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu"
                                        aria-labelledby="dropdownMenu">
                                        @if(auth()->user()->isAbleTo('edit_paragraph_content'))
                                            <li class="dropdown-item p-0">
                                            <a href="{{ route('admin.paragraph-contents.edit',secureToken($paragraphContent->id)) }}"
                                            title="Edit Paragraph Content"
                                            class="btn btn-sm">Edit</a></li>
                                        @endif
                                        @if(auth()->user()->isAbleTo('delete_paragraph_content') && env('IS_DEV') == 1)
                                            <li class="dropdown-item p-0">
                                            <a href="{{ route('admin.paragraph-contents.destroy',$paragraphContent->id) }}"
                                            title="Delete Paragraph Content"
                                            class="btn btn-sm delete-item text-danger">Delete</a></li>
                                        @endif

                                    </ul>
                                </div>
                            </td>
                            <td class="text-center"><a href="javascript:void(0);" class="btn btn-link edit-content" data-rec="{{ $paragraphContent }}"> {{ $paragraphContent->getPrefix() }}</a></td>
                            <td>{{ $paragraphContent->code }}</td>
                            {{-- <td>{{ Str::limit(strip_tags($paragraphContent->value),10) }}</td> --}}
                            {{-- <td>{{ $paragraphContent->remark }}</td> --}}
                            <td><span class="badge badge-{{\App\Models\ParagraphContent::TYPES[$paragraphContent->type]['color']}}">{{\App\Models\ParagraphContent::TYPES[$paragraphContent->type]['label']}}</span></td>
                            <td>{{ $paragraphContent->group_name}}</td>
                            <td>{{ $paragraphContent->formatted_created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $paragraphContents->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($paragraphContents->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $paragraphContents->currentPage() ?? ''}}">
            </label>
        @endif 
        </div>
    </div>
