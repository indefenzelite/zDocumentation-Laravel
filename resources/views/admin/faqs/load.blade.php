<div class="card-body">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <label for="">Show
                <select name="length" style="width:60px;height:30px;border: 1px solid #eaeaea;" id="length">
                    <option value="10" {{ $faqs->perPage() == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{ $faqs->perPage() == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{ $faqs->perPage() == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{ $faqs->perPage() == 100 ? 'selected' : ''}}>100</option>
                </select>
                entries
            </label>
        </div>
        <div >
            <input type="text" name="search" class="form-control" placeholder="Search" id="search" value="{{ request()->get('search') }}" style="width:unset;">

        </div>
    </div>
    <div class="table-responsive">
        <table id="faqTable" class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="mr-2 allChecked " name="id" value="">Actions</th>                                            
                    <th class="text-center"># <div class="table-div"><i class="ik ik-arrow-up  asc" data-val="id"></i><i class="ik ik ik-arrow-down desc" data-val="id"></i></div></th>
                    <th>Question</th>
                    <th>Category
                    </th>
                    <th>
                        <img  src="{{asset('frontend/assets/emoji/happy.png')}}"
                        alt="Sad Image" srcset="" class="emoji-icon icon-1" width="25">  
                    </th>
                    <th>
                        <img  src="{{asset('frontend/assets/emoji/unhappy.png')}}"
                        alt="Sad Image" srcset="" class="emoji-icon icon-1 " width="25">

                    </th>
                    <th>
                        <img  src="{{asset('frontend/assets/emoji/cry.png')}}"
                        alt="Sad Image" srcset="" class="emoji-icon icon-1"width="25">
                    </th>
                    
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody class="no-data">
                @foreach($faqs as  $faq)
                    <tr id="{{ $faq->id }}">
                        <td>
                            <div class="dropdown">
                                <input type="checkbox" class="mr-2 delete_Checkbox text-center" name="id" value="{{$faq->id}}">
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                    @if(auth()->user()->isAbleTo('edit_faq'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.faqs.edit', secureToken($faq->id)) }}" title="Edit Faq" class="btn btn-sm ">Edit</a></li>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_faq'))
                                        <li class="dropdown-item p-0"><a href="{{ route('admin.faqs.destroy', $faq->id) }}" title="Delete Faq" class="btn btn-sm delete-item text-danger">Delete</a></li>
                                    @endif
                                </ul>
                            </div> 
                        </td>
                        <td class="text-center"> {{ $faq->getPrefix() }}</td>
                        <td>{{$faq->title }}</td>
                        <td>{{ $faq->category->name ?? '' }} > {{@$faq->subCategory->name}} 
                            {{-- > {{@$faq->subSubCategory->name}} --}}
                        </td>
                        <td>
                            @if(isset($faq->vote)) 
                              {{@getVoteCountByStatus($faq->id,App\Models\Vote::STATUS_USEFUL) ?? '--'}} 
                            @else
                              0
                            @endif      
                        </td>
                        <td>
                            @if(isset($faq->vote))
                              {{@getVoteCountByStatus($faq->id,App\Models\Vote::STATUS_NEUTRAL) ?? '--'}} 
                            @else
                              0
                            @endif      
                        </td>
                        <td>
                            @if(isset($faq->vote))
                              {{@getVoteCountByStatus($faq->id,App\Models\Vote::STATUS_UN_USEFUL) ?? '--'}} 
                            @else
                              0
                            @endif      
                        </td>
                        <td class="is_publish-{{$faq->id}}" data-status="{{ $faq->is_publish }}">
                            @if($faq->is_publish == 1)
                                <span class="badge badge-success">Published</span>  
                            @else
                                <span class="badge badge-danger">Unpublished</span>   
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer d-lg-flex justify-content-between">
    <div class="pagination ">
        {{ $faqs->appends(request()->except('page'))->links() }}
    </div>
    <div class="py-3">
        @if($faqs->lastPage() > 1)
            <label class="d-lg-flex justify-content-end"  for="">
                <div class="mr-2 pt-lg-2 mb-1">
                    Jump To: 
                </div>
                <input type="number" class="w-50 form-control" id="jumpTo"  name="page" value="{{ $faqs->currentPage() ?? ''}}">
            </label>
        @endif
    </div>
</div>
