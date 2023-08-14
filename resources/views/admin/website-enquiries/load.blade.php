
<div class="table-controller mb-2">
    <div>
        <label for="">Show
            <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                <option value="10" {{ $websiteEnquiries->perPage() == 10 ? 'selected' : ''}}>10</option>
                <option value="25" {{ $websiteEnquiries->perPage() == 25 ? 'selected' : ''}}>25</option>
                <option value="50" {{ $websiteEnquiries->perPage() == 50 ? 'selected' : ''}}>50</option>
                <option value="100" {{ $websiteEnquiries->perPage() == 100 ? 'selected' : ''}}>100</option>
            </select>
            entries
        </label>
    </div>
    <div>
        <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
        
        <a href="javascript:void(0);" id="print" data-url="{{ route('admin.website-enquiries.print') }}" data-rows="{{ json_encode($websiteEnquiries) }}" class="btn btn-primary btn-sm">Print</a>
    </div>
    <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
</div>
<div class="table-responsive">
    <table id="website_enquiry_table" class="table">
        <thead>
            <tr>
                <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>
                <th class="no-export">#  <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                <th class="col_1">Name</th>
                <th class="col_4">Subject</th>
                <th class="col_3">Phone Number</th>
                <th class="col_4">Status</th>
                <th class="col_5">Created At</th>
            </tr>
        </thead>
            <tbody class="no-data">
                @if($websiteEnquiries->count() > 0)
                    @foreach($websiteEnquiries as $websiteEnquiry)
                        <tr id="{{$websiteEnquiry->id}}">
                            <td class="no-export">
                                <div class="dropdown d-flex">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$websiteEnquiry->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0 " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    {{-- <li class="dropdown-item p-0"><a href="{{ route('admin.website-enquiries.show', $websiteEnquiry->id) }}" title="Show Ticket" class="btn btn-sm">Show</a></li> --}}

                                    @if(auth()->user()->isAbleTo('edit_enquiry'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.website-enquiries.edit', secureToken($websiteEnquiry->id)) }}" title="Edit Ticket" class="btn btn-sm">Edit</a></li>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_enquiry'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.website-enquiries.destroy', $websiteEnquiry->id) }}" title="Delete Ticket" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                    @endif

                                    </ul>
                                </div>
                            </td>
                            <td class="no-export"><a class="btn btn-link pl-0" href="@if(auth()->user()->isAbleTo('show_enquiry')) {{ route('admin.website-enquiries.show', secureToken($websiteEnquiry->id)) }} @endif">{{ $websiteEnquiry->getPrefix() }}</a></td>
                            <td class="col_1">{{ Str::limit($websiteEnquiry->name,25) }}</td>
                            <td class="col_4">{{ Str::limit($websiteEnquiry->subject,20)}}</td>   
                            <td class="col_3">{{$websiteEnquiry->phone}}</td>    
                            <td class="col_4">
                                <span class="badge badge-{{@\App\Models\WebsiteEnquiry::STATUSES[$websiteEnquiry->status]['color']}}">{{@\App\Models\WebsiteEnquiry::STATUSES[$websiteEnquiry->status]['label']}}</span>
                            </td>   
                            <td class="col_5">{{$websiteEnquiry->formatted_created_at}}</td>   
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

<div class="card-footer d-flex justify-content-between">
    <div class="pagination">
        {{ $websiteEnquiries->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if($websiteEnquiries->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $websiteEnquiries->currentPage() ?? ''}}">
            </label>
        @endif
    </div>
</div>
