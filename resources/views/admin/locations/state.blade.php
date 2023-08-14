@extends('layouts.main')
@section('title', 'State')
@section('content')
    @php
        $breadcrumb_arr = [['name' => $country->name, 'url' => route('admin.locations.country'), 'class' => ''], ['name' => 'State', 'url' => 'javascript:void(0);', 'class' => 'active']];
    @endphp

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('State') }}</h5>
                            <span>{{ __('List of States') }} @if (request()->get('country'))
                                    of {{ $country->name }}
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
                        <h3>{{ __('State') }}</h3>
                        <a href="javasript:void(0);" data-toggle="modal" data-target="#AddStateModal"
                            class="btn btn-icon btn-sm btn-outline-primary" title="Filter"><i class="fa fa-plus"
                                aria-hidden="true"></i></a>
                    </div>
                    <div id="ajax-container">
                        @include('admin.locations.loads.state')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AddStateModal" tabindex="-1" role="dialog" aria-labelledby="AddStateModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.locations.state.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="request_with" value="state-create">
                    <input type="hidden" name="country_id" value="{{ request()->get('country') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> Add State</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">State Name<spa pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."*</span></label>
                            {!! getHelp('State Name visible publicly') !!}
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter fir pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." at least one alphabet character is required."name="name"
                                class="form-control" value="{{ old('name') }}"
                                placeholder="Enter State Name"id="">
                        </div>
                        <div class="form-group">
                            <label for="">State Code<span class="text-danger">*</span></label>
                            {!! getHelp('State  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required.") !!}
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                name="iso2" class="form-control" value="{{ old('iso2') }}"
                                placeholder="Enter State Code"id="">
                        </div>

                        <div class="form-group">
                            <label for="">Fips Code</label>
                            {!! getHelp('Fips Code visible publicly') !!}
                            <input type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                name="fips_code" class="form-control" value="{{ old('fips_code') }}"
                                placeholder="Enter Fips Code"id="">
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
    <div class="modal fade" id="EditStateModal" tabindex="-1" role="dialog" aria-labelledby="EditStateModalTitle"
        aria-hidden="true"> pattern="[a-zA-Z]+.*" title= pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required."tter alphabet and at least one alphabet character is required."
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.locations.state.update') }}" method="post">
                    @csrf pattern="[a-zA-Z]+.*" title=" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required."ter alphabet and at least one alphabet character is required."
                    <input type="hidden" name="request_with" value="state-update">
                    <input type="hidden" name="id" id="state_id">
                    <input type="hidden" name="country_id" value="{{ request()->get('country') }}">
                    <div class="modal-header">  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required."title="Please enter first letter alphabet and at least one alphabet character is required."
                        <h5 class="modal-title" id="exampleModalLongTitle"> Edit State</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">State Name*</label>
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."name="name"
                                class="form-control" value="{{ old('name') }}" placeholder="Enter State Name"
                                id="name">
                        </div>
                        <div class="form-group">
                            <label for="">State Code*</label>
                            <input required type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                name="iso2" class="form-control" value="{{ old('iso2') }}"
                                placeholder="Enter State Code" id="iso2">
                        </div>
                        <div class="form-group">
                            <label for="">Fips Code</label>
                            <input type="text" pattern="[a-zA-Z]+.*"
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                title="Please enter first letter alphabet and at least one alphabet character is required."
                                name="fips_code" class="form-control" value="{{ old('fips_code') }}"
                                placeholder="Enter Fips Code" id="fips_code">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Pin Code</label>
                            <input  type="number" name="pincode" class="form-control" placeholder="Enter Pin Code" id="pin_code">
                        </div>
                        <div class="form-group">
                            <label for="">Tax Slab</label>
                            <input  type="number" name="tax_slab" class="form-control" min="0"  value="{{ old('tax_slab') }}" placeholder="Enter Tax Slab " id="tax_slab">
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('admin/js/index-page.js') }}"></script>
        {{-- START HTML TO EXCEL INIT --}}
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type) {
                var table_core = $("#stateTable").clone();
                var clonedTable = $("#stateTable").clone();
                clonedTable.find('[class*="no-export"]').remove();
                clonedTable.find('[class*="d-none"]').remove();
                $("#stateTable").html(clonedTable.html());
                // console.log(clonedTable.html());
                var data = document.getElementById('stateTable');

                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, 'UserFile.' + type);
                $("#stateTable").html(table_core.html());
            }

            $(document).on('click', '#export_button', function() {
                html_table_to_excel('xlsx');
            });
        </script>
        {{-- END HTML TO EXCEL INIT --}}

        {{-- START EDIT STATE INIT --}}
        <script>
            $(document).on('click', '.editState', function() {
                var record = $(this).data('row');
                $('#state_id').val(record.id);
                $('#name').val(record.name);
                $('#iso2').val(record.iso2);
                $('#pin_code').val(record.pincode);
                $('#fips_code').val(record.fips_code);
                $('#tax_slab').val(record.tax_slab);
                $('#EditStateModal').modal('show');
            });
        </script>
        {{-- END EDIT STATE INIT --}}
    @endpush
@endsection
