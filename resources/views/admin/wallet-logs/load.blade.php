
    <div class="table-controller mb-2 d-flex justify-content-between">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10" {{ $walletLogs->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{ $walletLogs->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{ $walletLogs->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{ $walletLogs->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div>
            <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>
            
            {{-- <a href="javascript:void(0);" id="print" data-url="{{ route('admin.walletLogs.print') }}" data-rows="{{ json_encode($walletLogs) }}" class="btn btn-primary btn-sm">Print</a> --}}
        </div>
        <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">
    </div>
    <div class="table-responsive">
        <table id="walletLogsTable" class="table">
            <thead>
                <tr>
                    <th class="text-center col_1">#</th>
                    <th class="col_2">Amount</th>
                    <th class="col_3">After Balance</th>
                    <th class="col_4">Remark</th>
                    <th class="col_5">Created At</th>
                    <th class="col_6">Status</th>
                    <th class="col_8">System/Manually</th>
                    <th class="col_7">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($walletLogs as $walletLog)
                    <tr>
                        <td class="text-center col_1">{{ $loop->iteration }}</td>
                        <td class="font-weight-bold col_2 @if($walletLog->type == "credit") text-success @else text-danger @endif">{{ $walletLog->type == 'credit' ? '+' : '-' }}{{ format_price($walletLog->amount) }}</td>
                        <td class="col_3">{{ format_price($walletLog->after_balance) }}</td>
                        <td class="col_4">{{ $walletLog->remark }}</td>
                        <td class="col_5">{{ ($walletLog->formatted_created_at) }}</td>
                        <td class="col_6"><div class="badge badge-{{ \App\Models\WalletLog::STATUSES[$walletLog->status]['color']}}">{{\App\Models\WalletLog::STATUSES[$walletLog->status]['label']}}</div>
                        </td>
                        <td class="col_8">{{ $walletLog->is_default == 0 ? 'System' : @$walletLog->createdUser->name }}</td>
                        <td class="col_7">
                            @if($walletLog->status == 0)
                                <a href="{{ route('admin.wallet-logs.status',[$walletLog->id,1]) }}" class="btn btn-success">Accept</a>
                                <a href="{{ route('admin.wallet-logs.status',[$walletLog->id,2]) }}" class="btn btn-danger">Decline</a>
                            @else 
                                <span>Action Completed</span>   
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $walletLogs->appends(request()->except('page'))->links() }}
        </div>
        <div>
            @if($walletLogs->lastPage() > 1)
                <label for="">Jump To: 
                    <select name="page" style="width:60px;height:30px;border: 1px solid #eaeaea;"  id="jumpTo">
                        @for ($i = 1; $i <= $walletLogs->lastPage(); $i++)
                            <option value="{{ $i }}" {{ $walletLogs->currentPage() == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
            @endif
        </div>
    </div>