
    <div class="card-body">
        <div class="table-controller mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $seoTags->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $seoTags->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $seoTags->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $seoTags->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>
                <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
               
                <a href="javascript:void(0);" id="print" data-url="{{ route('admin.seo-tags.print') }}" data-rows="{{ json_encode($seoTags) }}" class="btn btn-primary btn-sm">Print</a>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="support-table" class="table">
                <thead>
                    <tr>
                        <th class=" no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>                                            
                        <th class="col_1"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>                                            
                        <th class="col_3">Code</th>
                        <th class="col_4">Title</th>
                        <th class="col_5">Updated At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                    @foreach($seoTags as $seoTag)
                        <tr id="{{ $seoTag->id }}">
                            <td class="no-export">
                                <div class="dropdown d-flex">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$seoTag->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                    @if(auth()->user()->isAbleTo('edit_seo_tag'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.seo-tags.edit',secureToken ($seoTag->id)) }}" title="seo-tags" class="btn btn-sm">Edit</a></li>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_seo_tag'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.seo-tags.destroy', $seoTag->id) }}" title="seo-tags" class="btn btn-sm delete-item text-danger">Delete</a></li>
                                    @endif

                                    </ul>
                                </div> 
                            </td>
                            <td class="col_1" >{{($seoTag->getPrefix())}}</td>
                            <td class="col_3" >{{ $seoTag->code}}</td>
                            <td class="col_4" >{{ $seoTag->title}}</td>
                            <td class="col_5" >{{($seoTag->formatted_updated_at)}}</td>  
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $seoTags->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($seoTags->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $seoTags->currentPage() ?? ''}}">
            </label>
        @endif
        </div>
    </div>
