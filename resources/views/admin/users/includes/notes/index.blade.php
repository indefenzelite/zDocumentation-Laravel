<table class="table data_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->userNotes as $index => $userNote)
            <tr>
                <td class=""> 
                    <div class="dropdown d-flex">
                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        <li class="dropdown-item p-0"><a href="javascript:void(0);" data-item="{{ $userNote }}" title="" class="btn btn-sm edit-btn edit-note">Edit</a></li>

                        <li class="dropdown-item p-0"><a href="{{ route('admin.user-notes.destroy',$userNote->id) }}" title="Delete Notes" class="btn btn-sm delete-item text-danger">Delete</a></li>
                        </ul>
                    </div>        
                </td>
                <td>{{ $userNote->getPrefix() }}</td>
                <td>{{ Str::limit($userNote->title,50,'...') }}</td>
                <td>{{ Str::limit($userNote->description,80,'...') ?? '--' }}</td>
                <td>{{ $userNote->formatted_created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>   