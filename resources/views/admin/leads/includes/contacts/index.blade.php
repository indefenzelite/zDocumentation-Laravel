<table  class="table data_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>#</th>
            <th>Name</th>
            <th class="Job Title">JT</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lead->contacts as $contact)
            <tr>
                <td>
                    <div class="dropdown d-flex">
                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        @if(auth()->user()->isAbleTo('edit_contact'))
                            <li class="dropdown-item p-0"><a href="javascript:void(0);" title="" data-contact="{{$contact}}" class="btn btn-sm edit-btn edit-contact">Edit</a></li>
                        @endif
                        @if(auth()->user()->isAbleTo('delete_contact'))
                            <li class="dropdown-item p-0"><a href="{{ route('admin.contacts.destroy',$contact->id) }}" title="Delete Notes" class="btn btn-sm delete-item">Delete</a></li>
                        @endif
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
                <td>{{ $contact->job_title }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table> 