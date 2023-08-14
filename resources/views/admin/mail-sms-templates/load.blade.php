
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10" {{ $mailSmsTemplates->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25" {{ $mailSmsTemplates->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $mailSmsTemplates->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100" {{ $mailSmsTemplates->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="mailSmsTable" class="table">
                <thead>
                    <tr>
                        <th class="no-export"><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>
                        <th class="no-export">#</th>
                        <th class="col_1">Subject</th>
                        <th class="col_2">Code</th>
                        <th class="col_3">Type</th>
                        <th class="col_3">Created At</th>
                    </tr>
                </thead>
                <tbody class="no-data">
                 @if($mailSmsTemplates->count() > 0)
                    @foreach($mailSmsTemplates as $mailSmsTemplate)

                        <tr id="{{$mailSmsTemplate->id}}">

                            <td>
                                <div class="dropdown d-flex">
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$mailSmsTemplate->id}}">
                                    <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.mail-sms-templates.show',secureToken($mailSmsTemplate->id)) }}" title="View Lead Contact" class="btn btn-sm">Show</a></li>

                                        @if(auth()->user()->isAbleTo('edit_mail_template'))
                                            <li class="dropdown-item p-0"><a href="{{ route('admin.mail-sms-templates.edit',secureToken($mailSmsTemplate->id)) }}" title="Edit Lead Contact" class="btn btn-sm">Edit</a></li>
                                        @endif
                                        @if(!$mailSmsTemplate->is_default)
                                            @if(auth()->user()->isAbleTo('delete_mail_template'))
                                                <li class="dropdown-item p-0"><a href="{{ route('admin.mail-sms-templates.destroy', $mailSmsTemplate->id) }}" title="Edit Lead Contact" class="btn btn-sm delete-item text-danger">Delete</a></li>
                                            @endif
                                        @endif
                                    </ul>

                                </div>  
                            </td>
                            <td><a class="btn btn-link p-0 m-0" href="{{ route('admin.mail-sms-templates.edit', secureToken($mailSmsTemplate->id)) }}">{{ $mailSmsTemplate->getPrefix() }}</a></td>
                            <td class="col_1">{{ $mailSmsTemplate->subject }}</td>
                            <td class="col_2">{{ $mailSmsTemplate->code }}</td>
                            <td class="col_3"> 
                                @if($mailSmsTemplate->type==1)
                                    <span>Mail</span>
                                @elseif($mailSmsTemplate->type==2)
                                     <span>SMS</span>
                                @else     
                                     <span>Whatsapp</span>
                                @endif   
                            </td> 
                            <td>{{$mailSmsTemplate->formatted_created_at}}</td>                                      
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
            {{ $mailSmsTemplates->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($mailSmsTemplates->lastPage() > 1)
            <label class="d-flex justify-content-end" for="">
                <div class="mr-2 pt-2">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $mailSmsTemplates->currentPage() ?? ''}}">
            </label>
        @endif
        </div>
    </div>
