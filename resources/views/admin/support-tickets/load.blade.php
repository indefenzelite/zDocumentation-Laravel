 <div class="card-body">
     <div class="table-controller mb-2">
         <div>
             <label for="">Show
                 <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                     <option value="10" {{ $supportTickets->perPage() == 10 ? 'selected' : '' }}>10</option>
                     <option value="25" {{ $supportTickets->perPage() == 25 ? 'selected' : '' }}>25</option>
                     <option value="50" {{ $supportTickets->perPage() == 50 ? 'selected' : '' }}>50</option>
                     <option value="100" {{ $supportTickets->perPage() == 100 ? 'selected' : '' }}>100</option>
                 </select>
                 entries
             </label>
         </div>
         <div>
             <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
             
             <a href="javascript:void(0);" id="print" data-url="{{ route('admin.support-tickets.print') }}"
                 data-rows="{{ json_encode($supportTickets) }}" class="btn btn-primary btn-sm">Print</a>
         </div>
         <input type="text" name="search" class="form-control" placeholder="Search" id="search"
             value="{{ request()->get('search') }}" style="width:unset;">
     </div>
     <div class="table-responsive">
         <table id="support-table" class="table">
             <thead>
                 <tr>
                     <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id"
                             value="">Actions</th>
                     <th class="no-export"># <div class="table-div"><i class="ik ik-arrow-up asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                     <th class="col_2">User Name</th>
                     <th class="col_4">Subject</th>
                     <th class="col_3">Status</th>
                     <th class="col_5">Created At</th>
                 </tr>
             </thead>
             <tbody class="no-data">
                 @foreach ($supportTickets as $supportTicket)
                     <tr id="{{ $supportTicket->id }}">
                         <td class="no-export">
                             <div class="dropdown d-flex">
                                 <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id"
                                     value="{{ $supportTicket->id }}">
                                 <button style="background: transparent;border:none;" class="dropdown-toggle p-0"
                                     type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                     aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                 <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                     {{-- <li class="dropdown-item p-0"><a href="{{ route('admin.support-tickets.show',$supportTicket->id) }}" title="Reply Support Ticket" class="btn btn-sm">Show</a></li> --}}
                                    @if(auth()->user()->isAbleTo('edit_ticket'))
                                     <li class="dropdown-item p-0"><a
                                             href="{{ route('admin.support-tickets.edit', secureToken($supportTicket->id)) }}"
                                             title="support-ticket" class="btn btn-sm">Edit</a></li>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_ticket'))
                                     <li class="dropdown-item p-0"><a
                                             href="{{ route('admin.support-tickets.destroy', $supportTicket->id) }}"

                                             title="support-ticket" class="btn btn-sm delete-item text-danger fw-700">Delete</a></li>
                                    @endif

                                 </ul>
                             </div>
                         </td>
                         <td class="no-export" >    
                             <a href="@if(auth()->user()->isAbleTo('show_ticket')) {{ route('admin.support-tickets.show',secureToken($supportTicket->id)) }}?active=details @endif"
                                 class="btn btn-link">
                                @if($supportTicket->priority_parsed->color == "yellow")
                                    <i title="Medium" class="fa fa-circle text-{{@$supportTicket->priority_parsed->color ?? '' }} fw-700"></i>
                                @elseif($supportTicket->priority_parsed->color == "red")
                                    <i title="High" class="fa fa-circle text-{{@$supportTicket->priority_parsed->color ?? '' }} fw-700"></i>
                                @elseif($supportTicket->priority_parsed->color == "green")
                                    <i title="Low" class="fa fa-circle text-{{@$supportTicket->priority_parsed->color ?? '' }} fw-700"></i>
                                @else
                                    <i class="fa fa-circle text-{{@$supportTicket->priority_parsed->color ?? '' }} fw-700"></i>
                                @endif
                                 {{ $supportTicket->getPrefix() }}
                             </a>
                         </td>
                         <td>{{ $supportTicket->user->full_name ?? 'Not Avaialble' }}</td>
                         <td>
                             {{ $supportTicket->subject }}
                         </td>
                         <td>
                            <span
                                class="badge badge-{{ $supportTicket->status_parsed->color }} m-1">{{ $supportTicket->status_parsed->label }}
                            </span>
                         </td>
                         <td>{{ $supportTicket->formatted_created_at }}</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
 <div class="card-footer d-flex justify-content-between">
     <div class="pagination">
         {{ $supportTickets->appends(request()->except('page'))->links() }}
     </div>
     <div>
           @if($supportTickets->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $supportTickets->currentPage() ?? ''}}">
                </label>
            @endif
     </div>
 </div>
