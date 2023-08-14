@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        /**
         * Order
         *
         * @category  zStarter
         *
         * @ref  zCURD
         * @author    Defenzelite <hq@defenzelite.com>
         * @license  https://www.defenzelite.com Defenzelite Private Limited
         * @version  <zStarter: 1.1.0>
         * @link        https://www.defenzelite.com
         */
        $breadcrumb_arr = [['name' => 'Add' . $label, 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <style>
            .error {
                color: red;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Order</h5>
                            <span>Create a record for Order</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
                @include('admin.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Create Order</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.store') }}" method="post" enctype="multipart/form-data"
                            id="OrderForm">
                            @csrf
                            <input type="hidden" name="request_with" value="web">
                            <input class="form-control" name="tax" type="hidden" value="18" id="tax_"
                                min="0" max="100" placeholder=" Tax">

                            <input type="hidden" value="COD" class="form-control" id="payment_gateway "
                                placeholder="Enter" name="payment_gateway">
                            <input type="hidden" value="0" class="form-control" id="status" placeholder="Enter"
                                name="status">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="user_id">User <span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_user')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select name="user_id" id="user_id" class="form-control getUsersList"  data-placeholder="Select Users"
                                            style="width: 125px;">
                                            <option value=""aria-readonly="true">Select Users</option>
                                        </select>
                                        <span class="user-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="item">To Address <span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_to_address')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="to" id="to_address" class="form-control select2">
                                            <option value="" aria-readonly="true">Select To Address </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="item"> Items <span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_items')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="items[]" id="items"
                                            class="form-control select2 getItemsList">
                                            <option value="" aria-readonly="true">Select Item </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="item">From Address <span class="text-danger">*</span></label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_from_address')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <select required name="from" id="from_address" class="form-control select2">
                                            <option value="" aria-readonly="true">Select From Address </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                                        <label for="discount" class="control-label">Quantity</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_quantity')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="qty" type="number" min="1" step="any"
                                            id="qty" value="{{ old('qty') }}" placeholder="Enter Quantity">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                                        <label for="discount" class="control-label">Discount</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_discount')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="discount" type="number"  min="0" step="any"
                                            id="discount" value="{{ old('discount') }}" placeholder="Enter Discount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group {{ $errors->has('shipping') ? 'has-error' : '' }}">
                                        <label for="shipping" class="control-label">Shipping Charges</label>
                                        <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_shipping_charges')"><i
                                                class="ik ik-help-circle text-muted ml-1"></i></a>
                                        <input class="form-control" name="shipping" min="0"  type="number" step="any"
                                            id="shipping" value="{{ old('shipping') }}" placeholder="Enter Shipping">
                                    </div>
                                </div>
                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserAddressModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times</span>
                    </button>
                </div>
                <form action="" id="address-form">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="userId">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_name')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        name="name" class="form-control" id="addressName" placeholder="Name"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_phone')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input type="text" name="phone" pattern="^[0-9]*$" min="0"
                                        class="form-control" placeholder="Phone Number" value="">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label>Address Type</label><br>
                                    <label for="home"> <input type="radio" name="type" value="0" checked
                                            id="home">Home</label>
                                    <label for="office"><input type="radio" name="type" value="1"
                                            id="office">Office</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_address_1')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        name="address_1" class="form-control" placeholder="Address" value="">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_address_2')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        name="address_2" class="form-control" placeholder="Address" value="">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_pincode')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <input type="number" name="pincode_id" class="form-control" placeholder="Pincode"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_country')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select name="country_id" class="form-control select2" placeholder="Country"
                                        id="country">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>State</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_state')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select name="state_id" class="form-control select2" placeholder="State"
                                        id="state">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label>City</label>
                                    <a href="javascript:void(0);" title="@lang('admin/tooltip.add_order_city')"><i
                                            class="ik ik-help-circle text-muted ml-1"></i></a>
                                    <select name="city" class="form-control select2" placeholder="City"
                                        id="city">

                                    </select>
                                    {{-- <input type="text" name="city" class="form-control" placeholder="City" value=""> --}}
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-end">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        @include('admin.include.world')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

        {{-- START GET ADDRESS INIT --}}
        <script>
            $('#OrderForm').validate();
            var flg = 0;
            $('#from_address').on("select2:open", function() {
                flg++;
                if (flg == 1)
                    $(".select2-results").append(
                        `<div class='select2-results__option'> <a href="#" id="addUserAddress" class="font-weight-300" data-target="#addUserAddressModal" data-toggle="modal">+ Add New Address</a> </div>`
                        );
            });

            $('#country').on('change', function() {
                getStates($(this).val());
            });

            $('#state').on('change', function() {
                getCities($(this).val());
            });
            $("#address-form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address_1: {
                        required: true,
                    },
                    address_2: {
                        required: true,
                    },
                    country_id: {
                        required: true,
                    },
                    state_id: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    pincode_id: {
                        required: true,
                    },
                },
                messages: {
                    name: "Please enter name",
                    phone: "Please enter phone",
                    address_1: "Please enter address 1",
                    address_2: "Please enter address 2",
                    city: "Please enter city",
                    state_id: "Please select State",
                    country_id: "Please select country",
                    pincode_id: "Please enter Pincode",
                },
                submitHandler: function(form) {
                    $(this).find('[type=submit]').attr('disabled', '');

                    let formdata = new FormData(form);

                    formdata.append("request_with", 'create');
                    if ($('#userId').val()) {
                        $.ajax({
                            url: "{{ route('admin.addresses.store') }}",
                            type: 'POST',
                            data: formdata,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $(ajaxMessage).html(
                                    '<div class="alert alert-info"><i class="fa fa-refresh fa-spin"></i> Please wait... </div>'
                                );
                            },
                            success: function(res) {
                                $(form)[0].reset();
                                $('#addUserAddressModal').modal('hide');
                                $(ajaxMessage).html('<div class="alert alert-success">' + res.message +
                                    '</div>');
                                if (res.data)
                                    $('#from_address').append('<option value="' + res.data.id + '">' +
                                        res.data.details.name + ' | ' + res.data.details.address_1 +
                                        ' | ' + res.data.details.city + ' | ' + res.data.details
                                        .pincode_id + '</option>');
                                $('#from_address').select2();
                                flg = 0;
                            },
                            complete: function() {
                                $(this).find('[type=submit]').removeAttr('disabled');
                                setTimeout(function() {
                                    $(ajaxMessage).html('');
                                }, 2000);
                            },
                            error: function(data) {
                                var response = JSON.parse(data.responseText);
                                if (data.status === 422) {
                                    var errorString = '<ul class="ps-3 m-0">';
                                    $.each(response.errors, function(key, value) {
                                        errorString += '<li>' + value + '</li>';
                                    });
                                    errorString += '</ul>';
                                    response = errorString;
                                } else {
                                    response = response.error;
                                }

                                $(ajaxMessage).html('<div class="alert alert-danger">' + response +
                                    '</div>');
                            }
                        });
                    } else {
                        $('#addUserAddressModal').modal('hide');
                        $('.user-error').html('Please select user!');
                    }
                    return false;
                }
            });
        </script>
        {{-- END GET ADDRESS INIT --}}

        {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function() {
                //get Users Data
                $('.select2').select2();
                getUsers();
                //get Items Data
                getItems();

                $('#user_id').on('change', function() {
                    let userId = $(this).val();
                    $.ajax({
                        url: "{{ route('admin.orders.getUserAddress') }}",
                        type: 'POST',
                        data: {
                            userId: userId
                        },
                        success: function(response) {
                            console.log(response);
                            $('#to_address').html(response);
                            $('#userId').val(userId);
                        }
                    });
                });

                $('#items').on('change', function() {
                    let itemId = $(this).val();
                    $.ajax({
                        url: "{{ route('admin.orders.getSellerAddress') }}",
                        type: 'POST',
                        data: {
                            itemId: itemId
                        },
                        success: function(response) {
                            console.log(response);
                            $('#userId').val(response.user_id);
                            $('#from_address').html(response.html);
                        }
                    });
                });

                $('#addUserAddressModal').on('shown.bs.modal', function() {
                    setTimeout(() => {
                        $('#addressName').focus();
                    }, 500);
                });
            })
        </script>
        {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
