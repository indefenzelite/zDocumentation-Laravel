@extends('layouts.empty')
@section('title', $label)
<!-- push external head elements to head -->
@push('head')
    <style>
        .error {
            color: red;
        }
    </style>
@endpush
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1 bg-white h-100vh ">
                <div class="pos top-menu mt-20 text-center">
                    <a href="https://radmin.themicly.com/inventory" class="nav-link m-auto mb-10"><i
                            class="ik ik-arrow-left-circle"></i></a>
                    <a href="#" class="nav-link m-auto mb-10" id="apps_modal_btn" data-toggle="modal"
                        data-target="#appsModal"><i class="ik ik-grid"></i></a>
                    <a class="nav-link m-auto mb-10" href="#" id="notiDropdown"><i class="ik ik-bell"></i><span
                            class="badge bg-danger">3</span></a>
                    <a class="nav-link m-auto mb-10" href="https://radmin.themicly.com/profile"><i
                            class="ik ik-user"></i></a>
                    <a class="nav-link m-auto mb-10" href="https://radmin.themicly.com/logout">
                        <i class="ik ik-power"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-8 bg-white">
                <div class="customer-area">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control select2" name="warehouse">
                                    <option selected="selected" value="">Select Warehouse</option>
                                    <option value="1">Warehouse 1</option>
                                    <option value="2">Warehouse 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." name="product" class="form-control" placeholder="Search products">
                            </div>
                        </div>

                    </div>

                    <div class="row pos-products layout-wrap" id="layout-wrap">

                        <!-- include product preview page -->
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:4,&amp;quot;name&amp;quot;:&amp;quot;Headphone&amp;quot;,&amp;quot;regular_price&amp;quot;:700,&amp;quot;offer_price&amp;quot;:600,&amp;quot;category_name&amp;quot;:&amp;quot;Electronics&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/headphone.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/headphone.webp" alt="Headphone"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Headphone <small class="text-muted">Electronics</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>600</span> <small
                                        class="text-red font-15"><s>700</s></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:2,&amp;quot;name&amp;quot;:&amp;quot;Camera&amp;quot;,&amp;quot;regular_price&amp;quot;:1500,&amp;quot;offer_price&amp;quot;:1200,&amp;quot;category_name&amp;quot;:&amp;quot;Electronics&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/camera.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/camera.webp" alt="Camera"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Camera <small class="text-muted">Electronics</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>1200</span> <small
                                        class="text-red font-15"><s>1500</s></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:6,&amp;quot;name&amp;quot;:&amp;quot;Watch&amp;quot;,&amp;quot;regular_price&amp;quot;:1200,&amp;quot;offer_price&amp;quot;:null,&amp;quot;category_name&amp;quot;:&amp;quot;Fashion Accessories&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/watch.png&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/watch.png" alt="Watch"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Watch <small class="text-muted">Fashion Accessories</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>1200</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:8,&amp;quot;name&amp;quot;:&amp;quot;Jacket&amp;quot;,&amp;quot;regular_price&amp;quot;:1200,&amp;quot;offer_price&amp;quot;:null,&amp;quot;category_name&amp;quot;:&amp;quot;Clothing&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/jacket.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/jacket.webp" alt="Jacket"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Jacket <small class="text-muted">Clothing</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>1200</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:3,&amp;quot;name&amp;quot;:&amp;quot;Helmet&amp;quot;,&amp;quot;regular_price&amp;quot;:500,&amp;quot;offer_price&amp;quot;:null,&amp;quot;category_name&amp;quot;:&amp;quot;Outdoor Gear&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/helmet.jpg&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/helmet.jpg" alt="Helmet"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Helmet <small class="text-muted">Outdoor Gear</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>500</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:1,&amp;quot;name&amp;quot;:&amp;quot;Bag&amp;quot;,&amp;quot;regular_price&amp;quot;:800,&amp;quot;offer_price&amp;quot;:null,&amp;quot;category_name&amp;quot;:&amp;quot;Fashion Accessories&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/bag.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/bag.webp" alt="Bag"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Bag <small class="text-muted">Fashion Accessories</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>800</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:7,&amp;quot;name&amp;quot;:&amp;quot;T-Shirt&amp;quot;,&amp;quot;regular_price&amp;quot;:40,&amp;quot;offer_price&amp;quot;:30,&amp;quot;category_name&amp;quot;:&amp;quot;Clothing&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/tshirt.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/tshirt.webp" alt="T-Shirt"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>T-Shirt <small class="text-muted">Clothing</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>30</span> <small
                                        class="text-red font-15"><s>40</s></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                            <div class="card mb-1 pos-product-card"
                                data-info="{&amp;quot;id&amp;quot;:5,&amp;quot;name&amp;quot;:&amp;quot;Joystick&amp;quot;,&amp;quot;regular_price&amp;quot;:400,&amp;quot;offer_price&amp;quot;:null,&amp;quot;category_name&amp;quot;:&amp;quot;Gaming&amp;quot;,&amp;quot;image&amp;quot;:&amp;quot;\/img\/products\/joystick.webp&amp;quot;}">
                                <div class="d-flex card-img">
                                    <img src="https://radmin.themicly.com/img/products/joystick.webp" alt="Joystick"
                                        class="list-thumbnail responsive border-0">
                                </div>
                                <div class="p-2">
                                    <p>Joystick <small class="text-muted">Gaming</small> </p>
                                    <span class="product-price"><span class="price-symbol">$</span>400</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 bg-white product-cart-area">
                <div class="product-selection-area">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> Order Details</h6>
                            <i class="text-danger ik ik-refresh-ccw cursor-pointer font-15" onclick="cleartCart()"></i>
                    </div>
                    <hr>
                    <div id="product-cart" class="product-cart mb-3">
                        <!-- Uncomment to preview original cart html
                                        ====================================================
                                        <div class="d-flex justify-content-between position-relative">
                                            <i class="text-red ik ik-x-circle cart-remove cursor-pointer" onclick="removeCartItem(ID)"></i>
                                            <div class="cart-image-holder">
                                                <img src="IMAGE_SRC">
                                            </div>
                                            <div class="w-100 p-2">
                                                <h5 class="mb-2 cart-item-title">ITEM_NAME</h5>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-muted">QUANTITYx</span>
                                                    <span class="text-success font-weight-bold cart-item-price">SUBTOTAL</span>
                                                </div>
                                            </div>
                                        </div> -->
                    </div>
                    <div class="box-shadow p-3">
                        <div class="d-flex justify-content-between font-15 align-items-center">
                            <span>Subtotal</span>
                            <strong id="subtotal-products">0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between font-15 align-items-center">
                            <span>Discount</span>
                            <input class="form-control w-90 font-15 text-right" id="discount">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between font-20 align-items-center">
                            <b>Total</b>
                            <b id="total-bill">0.00</b>
                        </div>
                    </div>
                    <div class="box-shadow p-3 mb-3">
                        <label class="d-block">Customer Information</label>
                        <div class="d-block">
                            <div class="form-group">
                                <input type="text" name="name"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control"
                                    placeholder="Enter Customer Name" value="Christopher Alex">
                            </div>
                            <div class="form-group">
                                <input type="number" name="phone"pattern="^[0-9]*$" min="0"  class="form-control" placeholder="Enter Phone"
                                    value="219-122-1234">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="name"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control h-82px" placeholder="Enter Address"
                                    value="Christopher Alex"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-shadow p-3">
                        <button class="btn btn-danger btn-checkout btn-pos-checkout " data-toggle="modal"
                            data-target="#InvoiceModal">PLACE ORDER</button>
                    </div>
                </div>

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
