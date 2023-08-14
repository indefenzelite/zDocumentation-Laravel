@extends('layouts.main')
@section('title', 'City')
@section('content')
    @php
        $breadcrumb_arr = [['name' => $state->country->name, 'url' => route('admin.locations.country'), 'class' => ''], ['name' => $state->name, 'url' => route('admin.locations.state', ['country' => $state->country_id]), 'class' => ''], ['name' => 'City', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('City') }}</h5>
                            <span>{{ __('List of cities') }} @if ($state)
                                    of {{ $state->name }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('City') }}</h3>
                        <a href="javasript:void(0);" class="btn btn-icon btn-sm btn-outline-primary" data-toggle="modal"
                            data-target="#AddCityModal" title="Filter"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-body">
                        <div id="ajax-container">
                            @include('admin.locations.loads.city')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AddCityModal" tabindex="-1" role="dialog" aria-labelledby="AddCityModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.locations.city.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="country_id" value="{{ $state->country_id }}">
                    <input type="hidden" name="country_code" value="{{ $state->country->iso2 }}">
                    <input type="hidden" name="state_id" value="{{ $state->id }}">
                    <input type="hidden" name="state_code" value="{{ $state->iso2 }}">
                    <input type="hidden" name="request_with" value="city-create">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">City Name*</label>
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."name="name"
                                class="form-control" value="{{ old('name') }}"
                                placeholder="Enter City Name"id="">
                        </div>
                        <div class="form-group">
                            <label for="">Latitude*</label>
                            <input required type="number" name="latitude" class="form-control" step="any"
                                min="1" value="{{ old('latitude') }}" placeholder="Enter Latitude"id="">
                        </div>
                        <div class="form-group">
                            <label for="">Longitude*</label>
                            <input required type="number" name="longitude" class="form-control" step="any"
                                min="1" value="{{ old('longitude') }}" placeholder="Enter Longitude"id="">
                        </div>
                        <div class="form-group">
                            <label for="">Pincode</label>
                            <input type="number" name="pincode" class="form-control" value="{{ old('pincode') }}"
                                placeholder="Enter Pincode" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditCityModal" tabindex="-1" role="dialog" aria-labelledby="EditCityModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.locations.city.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="city_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> Edit City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">City Name*</label>
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."name="name"
                                class="form-control" value="{{ old('name') }}" placeholder="Enter City Name"
                                id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Latitude*</label>
                            <input required type="number" name="latitude" class="form-control" step="any"
                                value="{{ old('latitude') }}" placeholder="Enter Latitude"id="latitude">
                        </div>
                        <div class="form-group">
                            <label for="">Longitude*</label>
                            <input required type="number" name="longitude" class="form-control" step="any"
                                value="{{ old('longitude') }}" placeholder="Enter Longitude"id="longitude">
                        </div>
                        <div class="form-group">
                            <label for="">Pincode</label>
                            <input type="number" name="pincode" class="form-control" value="{{ old('pincode') }}"
                                placeholder="Enter Pincode" id="pincode">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START HTML TO EXCEL INIT --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function html_table_to_excel(type) {
            var table_core = $("#user_table").clone();
            var clonedTable = $("#user_table").clone();
            clonedTable.find('[class*="no-export"]').remove();
            clonedTable.find('[class*="d-none"]').remove();
            $("#user_table").html(clonedTable.html());
            // console.log(clonedTable.html());
            var data = document.getElementById('user_table');

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'UserFile.' + type);
            $("#user_table").html(table_core.html());
        }

        $(document).on('click', '#export_button', function() {
            html_table_to_excel('xlsx');
        });
    </script>
    {{-- END HTML TO EXCEL INIT --}}

    {{-- START RESET BUTTON INIT --}}
    <script>
        $('#reset').click(function() {
            fetchData("{{ route('admin.locations.city') }}");
            window.history.pushState("", "", "{{ route('admin.locations.city') }}");
            $('#TableForm').trigger("reset");
            $(document).find('.close.off-canvas').trigger('click');
        });
    </script>
    {{-- END RESET BUTTON INIT --}}

    {{-- START EDIT CITY INIT --}}
    <script>
        $(document).on('click', '.editCity', function() {
            var record = $(this).data('row');
            $('#city_id').val(record.id);
            $('#name').val(record.name);
            $('#latitude').val(record.latitude);
            $('#longitude').val(record.longitude);
            $('#pincode').val(record.pincode);
            $('#EditCityModal').modal('show');
        });
    </script>
    {{-- END EDIT CITY INIT --}}
@endpush
