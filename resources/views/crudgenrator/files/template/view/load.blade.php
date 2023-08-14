
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <label for="">Show
                    <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                        <option value="10"{{ $data['curlstart'] }} {{ $indexvariable }}->perPage() == 10 ? 'selected' : ''}}>10</option>
                        <option value="25"{{ $data['curlstart'] }} {{ $indexvariable }}->perPage() == 25 ? 'selected' : ''}}>25</option>
                        <option value="50"{{ $data['curlstart'] }} {{ $indexvariable }}->perPage() == 50 ? 'selected' : ''}}>50</option>
                        <option value="100"{{ $data['curlstart'] }} {{ $indexvariable }}->perPage() == 100 ? 'selected' : ''}}>100</option>
                    </select>
                    entries
                </label>
            </div>
            <div>@if(!isset($data['excel_btn']))

                 {{ commentOutStart() }}@endif

                    <button type="button" id="export_button" class="btn btn-success btn-sm">Excel</button>@if(!isset($data['excel_btn']))

                        {{ commentOutEnd() }}@endif @if(!isset($data['colvis_btn']))

                     {{ commentOutStart() }}@endif

                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">@php $i = 1; @endphp @foreach (getKeysByValue('showindex',$data['fields']['options']) as $temp) @php $index = explode('_',$temp)[1]; $item = $data['fields']['name'][$index] @endphp
                        
                        <li class="dropdown-item p-0 col-btn" data-val="col_{{ $i }}"><a href="javascript:void(0);"  class="btn btn-sm">@if($data['fields']['input'][$index] == 'select_via_table'){{ str_replace('Id','',ucwords(str_replace('_',' ',$item))) }} @else{{ ucwords(str_replace('_',' ',$item)) }}@endif</a></li>@php ++$i; @endphp  @endforeach
                    
                    </ul>@if(!isset($data['colvis_btn']))

                    {{ commentOutEnd() }} @endif @if(!isset($data['print_btn']))

                    {{ commentOutStart() }}@endif

                <a href="javascript:void(0);" id="print" data-url="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.print') }}"  data-rows="{{ $data['curlstart'] }}json_encode({{ $indexvariable }}) }}" class="btn btn-primary btn-sm">Print</a>@if(!isset($data['print_btn']))

                    {{ commentOutEnd() }}@endif
                
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ $data['curlstart'] }}request()->get('search') }}" style="width:unset;">
        </div>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        
                        <th class="no-export">
                            {{ $data['atsign'] }}if($bulkActivation == 1)
                            <input type="checkbox" class="mr-2 " id="selectall"  value="">
                            {{ $data['atsign'] }}endif
                            Actions
                        </th> 
                        <th  class="text-center no-export"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th> @php $hi = 1;@endphp  @foreach (getKeysByValue('showindex',$data['fields']['options']) as $temp)
                        
                        <th class="col_{{ $hi }}"> @php $index = explode('_',$temp)[1]; $item = $data['fields']['name'][$index]; @endphp @if($data['fields']['input'][$index] == 'select_via_table'){{ str_replace('Id','',ucwords(str_replace('_',' ',$item))) }}  @else{{ ucwords(str_replace('_',' ',$item)) }}@endif @if(array_key_exists('sorting_'.$index,$data['fields']['options'])) <div class="table-div"><i class="ik ik-arrow-up  asc " data-val="{{ $item }}"></i><i class="ik ik ik-arrow-down desc" data-val="{{ $item }}"></i></div>@endif</th> @php ++$hi; @endphp
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    {{ $data['atsign'] }}if({{ $indexvariable }}->count() > 0)  @php $ti = 1; @endphp
                        
                    {{ $data['atsign'] }}foreach({{ $indexvariable }} as  {{ $variable}})
                            <tr>
                                <td class="no-export">
                                    <div class="dropdown d-flex">  
                                        {{ $data['atsign'] }}if($bulkActivation == 1)
                                        <input type="checkbox" class="mr-2 text-center" name="id" onclick="countSelected()" value="{{ $data['curlstart'] }}  {{ $variable}}->id}}">
                                        {{ $data['atsign'] }}endif
                                        {{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['edit']}}') || auth()->user()->isAbleTo('{{$data['permissions']['delete']}}'))
                                            <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">@isset($data['softdelete'])

                                                {{$data['atsign']}}if(request()->get('trash') == 1)
                                                    <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.restore', {{ $variable}}->id) }}" title="Delete {{ $heading }}" class="dropdown-item"><li class=" p-0">Restore</li></a>
                                                {{$data['atsign']}}else
                                                    {{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['edit']}}'))
                                                        <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.edit', {{ $variable}}->id) }}" title="Edit {{ $heading }}" class="dropdown-item "><li class="p-0">Edit</li></a>
                                                    {{$data['atsign']}}endif
                                                    {{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['delete']}}'))
                                                        <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.destroy', {{ $variable}}->id) }}" title="Delete {{ $heading }}" class="dropdown-item  delete-record"><li class=" p-0">Delete</li></a>
                                                    {{$data['atsign']}}endif @else

                                                {{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['edit']}}'))
                                                    <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.edit', {{ $variable}}->id) }}" title="Edit {{ $heading }}" class="dropdown-item "><li class="p-0">Edit</li></a>
                                                {{$data['atsign']}}endif
                                                {{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['delete']}}'))
                                                    <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'].$data['view_name']}}.destroy', {{ $variable}}->id) }}" title="Delete {{ $heading }}" class="dropdown-item  delete-record"><li class=" p-0">Delete</li></a> @endisset

                                                {{$data['atsign']}}endif
                                            </ul>
                                        {{$data['atsign']}}endif
                                    </div>
                                </td>
                                <td  class="text-center no-export"> {{ $data['curlstart'] }}  {{ $variable}}->getPrefix() }}</td> @foreach (getKeysByValue('showindex',$data['fields']['options']) as $temp) @php $index = explode('_',$temp)[1];  $item = $data['fields']['name'][$index]  @endphp @if($data['fields']['input'][$index] == 'select_via_table')
                                
                                <td class="col_{{  $ti }}">{{ $data['curlstart'] }} {{ '@'.$variable}}->{{ lcfirst(str_replace(' ', '',str_replace('Id','',ucwords(str_replace('_',' ',$item)))))}}->name??'N/A'}}</td>@elseif($data['fields']['input'][$index] == 'file')
                                
                                <td class="col_{{  $ti }}"><a href="{{ $data['curlstart'] }} asset({{ $variable}}->{{ $item }}) }}" target="_blank" class="btn-link">{{ $data['curlstart'] }}{{ $variable}}->{{ $item }} }}</a></td>@elseif($data['fields']['input'][$index] == "checkbox" ||$data['fields']['input'][$index] == "radio")
                                
                                <td class="col_{{  $ti }}"><input type="checkbox" class="{{ $data['curlstart'] }} $loop->first ? 'js-single' : 'js-switch'}} isboolrec-update" name="{{ $item }}" {{ $data['atsign'] }}if({{ $variable}}->{{ $item }}) checked {{ $data['atsign'] }}endif value='{{ $data['curlstart'] }}{{ $variable}}->id }}'></td> @else
                                
                                <td class="col_{{  $ti }}">{{ $data['curlstart'] }}{{ $variable}}->{{ $item }} }}</td> @endif @php ++$ti; @endphp @endforeach

                            </tr>
                        {{ $data['atsign'] }}endforeach
                    {{ $data['atsign'] }}else 
                        <tr>
                            <td class="text-center" colspan="8">No Data Found...</td>
                        </tr>
                    {{ $data['atsign'] }}endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="pagination">
            {{ $data['curlstart'] }} {{ $indexvariable }}->appends(request()->except('page'))->links() }}
        </div>
        <div>
           {{ $data['atsign'] }}if({{ $indexvariable }}->lastPage() > 1)
                <label class="d-flex justify-content-end" for="">
                    <div class="mr-2 pt-2">
                        Jump To: 
                    </div>
                    <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $data['curlstart'] }} {{ $indexvariable }}->currentPage() ?? ''}}">
                </label>
           {{ $data['atsign'] }}endif
        </div>
    </div>
