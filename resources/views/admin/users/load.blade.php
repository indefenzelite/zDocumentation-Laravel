<div class="table-controller mb-2">
    <div>
        <label for="">Show
            <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                <option value="10" {{ $users->perPage() == 10 ? 'selected' : ''}}>10</option>
                <option value="25" {{ $users->perPage() == 25 ? 'selected' : ''}}>25</option>
                <option value="50" {{ $users->perPage() == 50 ? 'selected' : ''}}>50</option>
                <option value="100" {{ $users->perPage() == 100 ? 'selected' : ''}}>100</option>
            </select>
            entries
        </label>
    </div>
    <div>
        <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
        
        <a href="javascript:void(0);" id="print" data-url="{{ route('admin.users.print') }}" data-rows="{{ json_encode($users) }}" class="btn btn-primary btn-sm">Print</a>
    </div>
    <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
</div>
<div class="table-responsive">
    <table id="user_table" class="table p-0">
        <thead>
            <tr>
                <th class="col_1 no-export">@if ($bulk_activation == 1)<input type="checkbox" class="allChecked mr-1" name="id" value="">@endif Actions</th>                                         
                <th class="col_2 text-center no-export">{{ __('#')}} <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                <th class="col_3">{{ __('Customer')}}</th>
                <th class="col_4">{{ __('Role')}}</th>
                <th class="col_5">{{ __('Email')}}</th>
                <th class="col_5">{{ __('Phone')}}</th>
                @if(getSetting('wallet_activation') == 1)
                <th class="col_6">{{ __('Balance')}}</th>
                @endif
                <th class="col_7">{{ __('Status')}}</th>
                <th class="col_8">{{ __('Join At')}}</th>
            </tr>
        </thead>
        <tbody class="no-data">
            @if($users->count() > 0)
                @foreach ($users as $user)
                    <tr id="{{ $user->id }}">
                        <td class="col_1 no-export"> 
                            <div class="dropdown d-flex">
                                @if ($bulk_activation == 1)
                                    <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$user->id}}">
                                @endif
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    @if(auth()->user()->isAbleTo('edit_user'))
                                        <a href="{{route('admin.users.edit',secureToken($user->id))}}"><li class="dropdown-item">Edit</li></a>
                                    @endif
                                    @if (auth()->user()->hasRole('admin'))
                                        <a href="{{route('admin.users.login-as',$user->id)}}"><li class="dropdown-item">Login As</li></a>
                                        @if(getSetting('wallet_activation') == 1)
                                        <a href="javascript:void(0);" class="walletLogButton dropdown-item" data-id="{{$user->id}}">Balance C/D </a>
                                        @endif
                                        @if(env('DEV_MODE') == 1)
                                            <a class="delete-item" href="{{ route('admin.users.destroy',$user->id) }}"><li class="dropdown-item  text-danger fw-700">Delete</li></a>
                                        @endif
                                    @endif
                                    {{-- <li class="dropdown-submenu">
                                        <a  class="dropdown-item" tabindex="-1" href="#">Status</a>
                                        <ul class="dropdown-menu">
                                            @if($user->status != 0)
                                                <li class="dropdown-item"><a tabindex="-1" class="statusChanger"   href="javascript:void(0)" data-value="Active" data-class="badge-danger" data-status="0"  data-url="{{url('admin/users/update/status/'.$user->id)}}" data-id="{{$user->id}}">Inactive</a></li>
                                            @endif
                                            @if($user->status != 1)
                                                <li class="dropdown-item"  ><a tabindex="-1" class="statusChanger" data-id="{{$user->id}}" data-class="badge-success" href="javascript:void(0)" data-status="1" data-value="Inactive" data-url="{{url('admin/users/update/status/'.$user->id)}}">Active</a></li>
                                            @endif
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </td>
                        <td class="col_2 text-center no-export"><a class="btn btn-link p-1" href="{{ route('admin.users.show', secureToken($user->id)) }}">{{ $user->getPrefix() }}</a></td>
                        <td class="col_3 max-w-150">{{ Str::limit($user->full_name,15)}}@if($user->is_verified)<span class="ml-1"><i class="ik ik-check-circle"></i></span>@endif</td>
                        <td class="col_4">{{ $user->role_name}}</td>
                        <td class="col_5">{{ $user->email }}</td>
                        <td class="col_5">{{ $user->phone ?? '---' }}</td>
                        @if(getSetting('wallet_activation') == 1)
                            
                            <td class="col_6">
                                <a href="{{ route('admin.wallet-logs.index',$user->id) }}" class="btn btn-link">
                                    {{-- @if($user->has('pendingWalletRequest'))
                                        <div class="new-update"></div>
                                    @endif --}}
                                    {{ format_price($user->wallet) }}
                                </a>
                            </td>
                        @endif
                        <td class="col_7 status-{{$user->id}} p-2 mt-3" data-status="{{ $user->status }}">
                            <span class="badge badge-{{ $user->status_parsed->color }}">{{ $user->status_parsed->label }}</span>
                        </td>
                        <td class="col_8">{{ ($user->formatted_created_at) }}</td>
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
        {{ $users->appends(request()->except('page'))->links() }}
    </div>
    <div>
        @if($users->lastPage() > 1)
            <label for="">Jump To: 
                <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <option value="{{ $i }}" {{ $users->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </label>
        @endif
    </div>
</div>
