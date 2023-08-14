<table  class="table data_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>#</th>
            <th>Name</th>
            <th title="Job Title">Job title</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        {{-- @dd($user->contacts) --}}
        @foreach($user->contacts as $contact)
            <tr>
                <td>
                    <div class="dropdown d-flex">
                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        <li class="dropdown-item p-0"><a href="javascript:void(0);" title="" data-contact="{{$contact}}" class="btn btn-sm edit-btn edit-contact">Edit</a></li>

                        <li class="dropdown-item p-0"><a href="{{ route('admin.contacts.destroy',$contact->id) }}" title="Delete Notes" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                        </ul>
                    </div>   
                </td>
                <td>{{ $contact->getPrefix() }}</td>
                <td>
                    @if($contact->gender == 'male')
                        <i class="fa fa-male text-primary"></i>
                    @else 
                        <i class="fa fa-female text-danger"></i>
                    @endif
                    {{ $contact->first_name.' '.$contact->last_name }}</td>
                <td>
                    @foreach($jobTitleCategories as $category)
                        @if($category->id == $contact->job_title)
                            {{$category->name ?? '--'}}
                        @endif
                    @endforeach
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table> 