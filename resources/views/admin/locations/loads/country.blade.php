<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10" {{ $countries->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{ $countries->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{ $countries->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{ $countries->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="countryTable" class="table p-0">
            <thead>
                <tr>
                    <th class="col_2  no-export">Actions</th>
                    <th class="col_1 text-center  no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                    <th class="col_3">Name</th>
                    <th class="col_4">Code</th>
                    <th class="col_4">Ph Code</th>
                    <th class="col_5">Currency</th>
                </tr>
            </thead>
            <tbody>
                @if($countries->count() > 0)
                    @foreach($countries as $country)
                        <tr>
                            <td  class="col_2 no-export">
                                <div class="dropdown">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        @if(auth()->user()->isAbleTo('edit_location'))
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.locations.country.edit', encrypt($country->id)) }}" title="Edit Country" class="btn btn-sm">Edit</a></li>
                                        @endif
                                        {{-- @if(auth()->user()->isAbleTo('delete_location')) --}}
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.locations.state',['country' =>  $country->id])}}" title="Manage States" class="btn btn-sm">States</a></li>
                                        {{-- @endif  --}}
                                    </ul>
                                </div>
                            </td>
                            <td class="text-center col_1 no-export"><a href="{{ route('admin.locations.state',['country' =>  $country->id])}}" class="btn btn-link m-0">{{ $country->getPrefix() }}</a></td>
                            <td  class="col_3"> {{ $country->name." | ".$country->native }}</td>
                            <td  class="col_4">{{ $country->iso3 }}</td>
                            <td  class="col_4">{{ $country->phonecode }}</td>
                            <td  class="col_5">{{ $country->currency }}</td>
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
        {{ $countries->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if($countries->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $countries->currentPage() ?? ''}}">
            </label>
        @endif
    </div>
</div>
