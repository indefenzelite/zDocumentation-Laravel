<table  class="table data_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>Type</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->addresses as $address)
        @php
            $address_decoded = $address->details;
            if ($address_decoded != null){
                if(isset($address_decoded['country_id']) && $address_decoded['country_id']){
                    $country = App\Models\Country::where('id',$address_decoded['country_id'])->first();
                }
                if(isset($address_decoded['state_id']) && $address_decoded['state_id']){
                    $state = App\Models\State::where('id',$address_decoded['state_id'])->first();
                }
                if(isset($address_decoded['city']) && $address_decoded['city']){
                    $city = App\Models\City::where('id',$address_decoded['city'])->first();
                }
            }
        @endphp
            <tr>
                <td>
                    <div class="dropdown d-flex">
                        <button style="background: transparent;border:none;" class="dropdown-toggle p-0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        <li class="dropdown-item p-0"><a href="javascript:void(0)" class="btn btn-sm edit-btn editAddress" title=""  data-id="{{$address}}"
                            data-original-title="Edit">Edit</a>
                        </li>

                        <li class="dropdown-item p-0"><a href="{{ route('admin.addresses.destroy',$address->id) }}"
                            class="btn btn-sm delete-item text-danger fw-700" title=""
                            data-original-title="delete">Delate</a>
                        </li>
                        </ul>
                    </div>   
                </td>
                <td>
                    {{ $address_decoded['type'] == 0 ? 'Home' : 'Office' }}
                </td>
                <td>{{@$address_decoded  ['name']}}</td>
                <td>{{@$address_decoded['address_1'] }}.<br>
                    {{@$address_decoded['address_2'] }}.<br>
                </td>
                <td>
                    {{@$address_decoded[ 'phone']}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table> 
{{-- <div class="customer_card card-address_info">
    <div class="border-bottom pb-4">
        <div class="row mt-2">
            @forelse ($user->addresses as $address)
                @php
                    $address_decoded = $address->details;
                    if ($address_decoded != null){
                        if(isset($address_decoded['country_id']) && $address_decoded['country_id']){
                            $country = App\Models\Country::where('id',$address_decoded['country_id'])->first();
                        }
                        if(isset($address_decoded['state_id']) && $address_decoded['state_id']){
                            $state = App\Models\State::where('id',$address_decoded['state_id'])->first();
                        }
                        if(isset($address_decoded['city']) && $address_decoded['city']){
                            $city = App\Models\City::where('id',$address_decoded['city'])->first();
                        }
                    }
                @endphp
                <div class="col-lg-6">
                    <div class="m-1 p-2 border rounded">
                        <div class="mb-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 p-0">{{ $address_decoded['type'] == 0 ? 'Home' : 'Office' }} Address:</h6>
                                <div>
                                    @if(auth()->user()->isAbleTo('edit_address'))
                                        <a href="javascript:void(0)" class="text-primary editAddress h5 mb-0" title=""  data-id="{{$address}}"
                                            data-original-title="Edit"><i class="ik ik-edit"></i></a>
                                    @endif
                                    @if(auth()->user()->isAbleTo('delete_address'))
                                        <a href="{{ route('admin.addresses.destroy',$address->id) }}"
                                            class="text-primary delete-item h5 mb-0" title=""
                                            data-original-title="delete"><i class="ik ik-trash"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 border-top">
                            <div class="">
                                <div>
                                    <p class="text-muted mb-0">
                                        <i class="ik ik-user"></i> 
                                        {{@$address_decoded  ['name']}}<br>
                                       <i class="ik ik-phone"></i> {{@$address_decoded[ 'phone']}}<br>
                                       <i class="ik ik-home"></i> {{@$address_decoded['address_1'] }}.<br>
                                        {{@$address_decoded['address_2'] }}.<br>
                                        {{@$city->name ?? '' }}
                                        {{@$state->name ?? '' }}-{{@$address_decoded['pincode_id']}} 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty  
                <div class="col-lg-8 mx-auto text-center">
                    @php
                        $title = 'No Addresses yet!';
                    @endphp
                    @include('user.include.empty-record')
                </div>
            @endforelse
        </div>
    </div>
</div>    --}}