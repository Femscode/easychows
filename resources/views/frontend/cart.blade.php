@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>

    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div>
                        <div class="mb-8">
                            <!-- text -->
                            <h1 class="fw-bold mb-0">Checkout</h1>

                        </div>
                    </div>
                </div>
            </div>
            <form id='checkout_form' method='post' action='{{route("checkout", [$cc*$rest->pack_fee+$rest->ct_charge])}}'
                           >
                            @csrf
            <div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-12">
                        <!-- accordion -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <!-- accordion item -->
                            <div class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- heading one -->
                                    <a href="#" class="fs-5 text-inherit collapsed h4" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                                        Delivery Details
                                    </a>
                                </div>
                                <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">

                                    <div class="d-flex flex-column col-md-12">
                                        <!--begin::Title-->

                                        <!--end::Title-->
                                        <!--begin::Input group-->
                                       
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="col-md-6">
                                                <!--begin::Label-->
                                                <label class="required form-label">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required class="form-control" name="name" placeholder="Enter Name" value="" />
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-md-6">
                                                <!--begin::Label-->
                                                <label class="form-label">Phone Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required class="form-control" name="phone" type='number' placeholder="Phone Number" />
                                                <input type='hidden' name='discount' value='{{ $discount }}' />
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="col-md-6">
                                                <!--begin::Label-->
                                                <label class="required form-label">Location</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class='form-control' id='location' required name='location'>
                                                    <option data-value='0' value=''>Select Location</option>
                                                    <option value="Pick it up myself" data-value='0'>Work In (Pick it up myself)</option>

                                                    @foreach($deliveries as $key => $del)
                                                    {{-- <option value="{{ $del->name }}"
                                                    data-value='@if($promo) 0 @else {{ $del->price }} @endif'>{{
                                                            $del->name }} - @if($promo) FREE💃🏽😍 @else ₦{{
                                                            number_format($del->price) }}@endif</option> --}}
                                                    <option value="{{ $del->name }}" data-value='{{ $del->price }}'>
                                                        {{ $del->name }} - ₦{{ number_format($del->price) }}
                                                    </option>

                                                    @endforeach
                                                    <option value="Others" data-value='0'>Others</option>
                                                </select>

                                            </div>
                                            <div class="col-md-6">
                                                <!--begin::Label-->
                                                <label class="form-label">Delivery Address</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required class="form-control" name="address" placeholder="A proper description of your hostel" />
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                      
                                    </div>
                                </div>

                            </div>

                            <div class="accordion-item py-4">
                                <a href="#" class="text-inherit h5" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                                    Order Details
                                    <!-- collapse -->
                                </a>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="mt-5">
                                        <div class="card-body pt-0">
                                            <div class="d-flex flex-column gap-10">
                                                <!--begin::Input group-->

                                                <!--end::Input group-->
                                                <!--begin::Separator-->
                                                <div class="separator"></div>
                                                <!--end::Separator-->
                                                <!--begin::Search products-->

                                                <div class="d-flex align-items-center position-relative mb-n7">

                                                    <h4 class='float-right' id='total_price'>Total Price: #
                                                        {{number_format($carts->totalPrice)}}
                                                    </h4>
                                                </div>
                                                @for($j = 1;$j<=$cc;$j++) <?php $great = 'pack' . $j; ?> @if(isset($great)) <div class='row' id='row{{ $j }}'>
                                                    <div id='tablep{{ $j }}' class='h2 col-md-6'>
                                                        Pack {{ $j }}
                                                    </div>
                                                    {{-- @if($j == $cc)
                                                    <div class='col-md-6'>
                                                        <a data-id='{{ $j }}'
                                                    class='deleteplate float-right btn btn-danger btn-sm'>Delete
                                                    Pack</a>
                                            </div>
                                            @endif --}}
                                        </div>
                                        <!--end::Search products-->
                                        <!--begin::Table-->
                                        <div class='table-responsive' id='table{{ $j }}'>
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">


                                                        <th>Product</th>

                                                        <th class="min-w-350px">Quantity</th>
                                                        <!-- <th class="min-w-100px">Remove</th> -->
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bold text-gray-600 col-md-6">
                                                    <!--begin::Table row-->
                                                    {{-- @if($carts) --}}
                                                    @foreach($$great as $i => $menu)
                                                    <tr id='content{{ $menu['id'] }}'>


                                                        <td>
                                                            <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_1">
                                                                <!--begin::Thumbnail-->

                                                                <div style='padding:1px !important' class="d-flex align-items-center bg-light-danger rounded">
                                                                    <div class="symbol symbol-60px symbol-2by3">
                                                                        @if(substr($menu['image'],0,5) ==
                                                                        'https')
                                                                        <div class="symbol-label" style="background-image: url('{{ $menu['image'] }}')">
                                                                        </div>
                                                                        @else
                                                                        <div class="symbol-label" style="background-image: url('https://easychows.com/easychows_files/public/foodimages/{{ $menu['image'] }}')">
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <!--end::Thumbnail-->
                                                                <div class="ms-5">
                                                                    <!--begin::Title-->
                                                                    <a class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$menu["name"]}}</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::Price-->

                                                                    <!--end::Price-->
                                                                    <!--begin::SKU-->
                                                                    <div class="text-danger fs-7">₦
                                                                        {{number_format($menu['price'])}}
                                                                    </div>
                                                                    <!--end::SKU-->
                                                                </div>
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="col-md-4">
                                                                <div class="btn-group mb-md-0 btn-block">
                                                                    <button data-id='{{$menu["id"]}}' data-good='{{ $j }}' id='deletefood{{$menu["id"]}}' type="button" class="removemenu btn btn-light btn-sm">-</button>
                                                                    <button id='product_qty{{$menu["id"]}}{{ $j }}' type="button" class="cfood btn btn-light btn-sm">{{$menu["qty"]}}</button>
                                                                    <button data-id='{{$menu["id"]}}' data-good='{{ $j }}' type="button" class="addmenu btn btn-light btn-sm">+</button>
                                                                </div>
                                                            </div>


                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    {{-- @else
                                                            <td>No item in cart</td>
                                                            @endif --}}
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        @endif
                                        @endfor
                                        <!--end::Table-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 offset-xl-1 col-xl-4 col-lg-6">
                <div class="mt-4 mt-lg-0">
                    <div class="card shadow-sm">
                        <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                        <ul class="list-group list-group-flush">
                            <!-- list group item -->
                            <li class="list-group-item px-4 py-3">
                                <div class="row align-items-center">

                                    <div class="col-5 col-md-5">
                                        <h6 class="mb-0">Subtotal</h6>

                                    </div>

                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                        <span class="fw-bold" id='subtotal'>₦{{number_format($carts->totalPrice)}}</span>
                                    </div>
                                </div>
                            </li>
                            <!-- list group item -->
                            <li class="list-group-item px-4 py-3">
                                <div class="row align-items-center">

                                    <div class="col-5 col-md-5">
                                        <h6 class="mb-0"> Delivery Fee</h6>

                                    </div>

                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                        ₦<span class="fw-bold" id='delivery_amount'>0</span>

                                    </div>
                                </div>
                            </li>
                            <!-- list group item -->
                            <li class="list-group-item px-4 py-3">
                                <div class="row align-items-center">

                                    <div class="col-5 col-md-5">
                                        <h6 class="mb-0">Pack Fee</h6>

                                    </div>

                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                        ₦<span class="fw-bold" id='packtotal'>
                                            @for($j = 1;$j<=$cc;$j++) @if($j==$cc) {{ $j * $rest->
                                                                    pack_fee }} @endif @endfor</span>

                                    </div>
                                </div>
                            </li>
                            <!-- list group item -->
                            <li class="list-group-item px-4 py-3">
                                <div class="row align-items-center">

                                    <div class="col-5 col-md-5">
                                        <h6 class="mb-0">Charges</h6>

                                    </div>

                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                        <span class="fw-bold">₦{{ $rest->ct_charge }}</span>

                                    </div>
                                </div>
                            </li>

                            <!-- list group item -->

                            <!-- list group item -->
                            <li class="list-group-item px-4 py-3">
                                <div class="d-flex align-items-center justify-content-between fw-bold">
                                    <div>Grand Total</div>

                                    <input type='hidden' id='g_total' value='{{$carts->totalPrice + $rest->ct_charge}}' />
                                    <input type='hidden' name='delivery_amount' id='delivery_form' />
                                    <input type='hidden' id='sstotal' value='{{ $carts->totalPrice }}' />
                                    <input type='hidden' name='ct_charge' id='ct_charge' value='{{ $rest->ct_charge }}' />
                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                        <div class="text-dark fs-3 fw-boldest text-end" id='grandtotal'></div>
                                    </div>
                                </div>
                                <button class='btn btn-primary' type='submit'>Proceed To Whatsapp</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                                            </form>
        </div>
        </div>
        </div>
    </section>
</main>

@endsection

@section('script')


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var isFormSubmitted = false;

        $("#checkout_form").on('submit', function(e) {
            if (isFormSubmitted) {
                // Prevent form submission if it has already been submitted
                e.preventDefault();
            } else {
                // Disable the submit button and set the flag to true
                $("#checkout_button").attr('disabled', true).text('Processing Order...');

                isFormSubmitted = true;

                // Enable the button and reset the flag after 20 seconds
                setTimeout(function() {
                    $("#checkout_button").attr('disabled', false).text('Proceed To Whatsapp');

                    isFormSubmitted = false;
                }, 10000); // 20 seconds in milliseconds
            }
        });


        var g = $("#g_total").val()
        var h = $("#packtotal").text()
        var t_total = parseInt(g) + parseInt(h)
        $("#grandtotal").text("₦" + t_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"))

        $('body').on('click', '.addmenu', function() {
            id = $(this).data('id');
            good = $(this).data('good');
            ra = [id, good];
            console.log(ra)

            $.get("{{route('addToCart3')}}?data=" + ra, function(data) {
                var h = $("#packtotal").text()
                console.log(data);
                $("#total_price").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $("#sstotal").val(data)
                $("#subtotal").text("#" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                var total = parseInt(data) + parseInt($("#location").find(':selected').data('value')) + parseInt($("#ct_charge").val()) + parseInt(h);
                $("#grandtotal").text("₦" + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

                var nvalue = $("#product_qty" + id + good).text();
                rvalue = parseInt(nvalue)
                console.log(rvalue, 'the n value')
                $("#product_qty" + id + good).text(rvalue + 1)

            });


        });
        $('body').on('click', '.deleteplate', function() {
            // $(".deleteplate").click(function() {
            var id = $(this).data('id');
            id2 = id - 1


            $.get("{{ route('deleteplate') }}?id=" + id, function(data) {
                var h = $("#packtotal").text()
                console.log(data, 'the data gotten');
                $("#sstotal").val(data)
                $("#total_price").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $("#subtotal").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                var total = parseInt(data) + parseInt($("#location").find(':selected').data('value')) + parseInt($("#ct_charge").val()) + parseInt(h);
                $("#grandtotal").text("₦" + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

                $("#table" + id).remove()
                $("#row" + id).remove()
                $("#row" + id2).append(`
                    <div class='col-md-6'>
                         <a data-id='${id2}'
                             class='deleteplate float-right btn btn-danger btn-sm'>Delete
                             Pack</a>
                     </div>
					`)

            })
        })

        $('body').on('click', '.removemenu', function() {

            id = $(this).data('id');
            plate = $(this).data('good')
            qty = $("#product_qty" + id + plate).text();



            console.log(qty, 'the quant')

            fd = new FormData();

            fd.append('id', id);
            fd.append('qty', qty);
            fd.append('plate', plate);

            $.ajax({
                type: 'POST',
                url: "{{route('removeMenu')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    // swal("Success", ' Updated successfully', 'success');
                    console.log(data)
                    var h = $("#packtotal").text()
                    $("#sstotal").val(data)
                    $("#total_price").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                    $("#subtotal").text("₦" + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                    var total = parseInt(data) + parseInt($("#location").find(':selected').data('value')) + parseInt($("#ct_charge").val()) + parseInt(h);
                    $("#grandtotal").text("₦" + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

                    var nvalue = $("#product_qty" + id + plate).text();
                    rvalue = parseInt(nvalue)
                    console.log(rvalue, 'the n value')
                    if (qty == 1) {
                        $("#content" + id).remove()
                    } else {
                        $("#product_qty" + id + plate).text(rvalue - 1)
                    }

                },
                error: function(data) {
                    console.log(data);
                    swal('Oops!', 'Not Updated', 'error')
                }
            });

        });
        $('#order_preference').change(function() {
            if ($(this).is(':checked')) {
                $("#preference_show").show()
            } else {
                $("#preference_show").hide()
            }

        });

        $("#save_preference").click(function() {
            if ($("#email_address").val().length > 7 && $("#preference_name").val().length > 3) {
                Swal.fire({
                    title: "saving order to your preference, please wait...",
                    html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
                var fd = new FormData()
                fd.append('cart', $("#cart_preference").val());
                fd.append('email_address', $("#email_address").val());
                fd.append('preference_name', $("#preference_name").val());
                $.ajax({
                    type: 'POST',
                    url: "{{ route('save_preference') }}",
                    cache: false,
                    data: fd,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: (response) => {
                        // swal("Success", ' Updated successfully', 'success');
                        console.log(response)
                        if (response == true) {
                            Swal.fire('Order saved!', 'This order has been added to your preference on fastpay.', 'success')
                        } else {
                            Swal.fire({
                                title: 'Opps,',
                                icon: 'info',
                                html: 'You are yet to create a fastpay account, click ' +
                                    '<a href="">here</a> ' +
                                    'to create one.',
                                showCloseButton: true,
                                showCancelButton: true,
                                focusConfirm: false,

                            })
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        swal('Oops!', 'An error occured, contact the admin', 'error')
                    }
                });
            } else {
                Swal.fire("Kindly fill the neccessary fields")
            }


        });
        $(".product_qty").on('input', function() {

            id = $(this).data('id');

            qty = $("#product_qty" + id).val();
            // swal("Updating cart...")
            fd = new FormData();

            fd.append('id', id);
            fd.append('qty', qty);

            $.ajax({
                type: 'POST',
                url: "{{route('updatecart')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    // swal("Success", ' Updated successfully', 'success');
                    console.log(data)
                    $("#total_price").text("#" + data);
                    $("#subtotal").text("#" + data);
                    var total = parseInt(data) + 50;
                    $("#grandtotal").text("#" + total);
                    // window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    swal('Oops!', 'Not Updated', 'error')
                }
            });
        });

        $(".delete_food").click(function() {
            id = $(this).data('id');
            el = this;
            console.log(id)
            // swal("Removing food...")

            $.get('{{ route("deletecart")}}?id=' + id, function(data) {
                console.log(data, 'the deleted data')
                // swal.close()

                // swal('Food Removed', 'Food has been removed from cart successfully!', 'success')
                $(el).closest("tr").remove();
                $("#total_price").text("₦" + data);
                // window.location.reload()
            });



        });
        $("#location").change(function() {
            $("#delivery_amount").text($("#location").find(':selected').data('value'))
            var total = parseInt($("#sstotal").val()) + parseInt($("#ct_charge").val()) + parseInt($("#packtotal").text()) + parseInt($("#location").find(':selected').data('value'));
            $("#delivery_form").val($("#location").find(':selected').data('value'))
            $("#grandtotal").text("₦" + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

        })
        @if($discount == 'true')

        const confettiConfig = {
            particles: {
                number: {
                    value: 100,
                },
                size: {
                    value: 5,
                },
            },
            interactivity: {
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse",
                    },
                },
            },
        };

        Swal.fire({
            title: 'Congratulations, you just won a free drink from Mhunis Delicacy, sponsored by <span class="splash-container">LOUDDA</span>.',
            html: '<div class="animate__animated animate__bounce animate__delay-1s" style="color:red">Kindly make a screenshot of this page, and send it along your order.</div><br><b>Order Id : CT-{{ $order_promo_id }}</b>',
            width: 600,
            padding: '3em',
            color: '#716add',
            background: '#fff ', // Set a solid background color
            showClass: {
                popup: 'animate__animated animate__jackInTheBox'
            },
            hideClass: {
                popup: 'animate__animated animate__flipOutY'
            },
            backdrop: `
                        rgba(0,0,123,0.4)
                        url("/assets/images/confetti.png")
                        left top
                        repeat

                      `,
            didOpen: () => {
                // Create and append confetti elements
                const confettiContainer = document.createElement('div');
                confettiContainer.classList.add('confetti-container');
                document.body.appendChild(confettiContainer);

                for (let i = 0; i < 50; i++) {
                    const confetti = document.createElement('div');
                    confetti.classList.add('confetti');
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.animationDuration = Math.random() * 2 + 1 + 's';
                    confettiContainer.appendChild(confetti);
                }
            },
            willClose: () => {
                // Remove confetti elements when the SweetAlert is closed
                const confettiContainer = document.querySelector('.confetti-container');
                if (confettiContainer) {
                    confettiContainer.remove();
                }
            }
        });
        // Swal.fire({
        //     title: 'Congratulations, you just won a free drink from Mhunis Delicacy, sponsored by LOUDDA.',
        //     html:
        //       '<div class="animate__animated animate__bounce animate__delay-1s"  style="color:red">Kindly make a screenshot of this page, and send it along your order.</div><br><b>Order Id : CT-{{ $order_promo_id }}</b>',

        //     width: 600,
        //     padding: '3em',
        //     color: '#716add',
        //     background: '#fff url(/assets/images/confetti.png)',
        //     showClass: {

        //       popup: 'animate__animated animate__jackInTheBox'
        //     },
        //     hideClass: {
        //       popup: 'animate__animated animate__flipOutY'
        //     },
        //       backdrop: `
        //         rgba(0,0,123,0.4)
        //         url("/assets/images/confetti.png")
        //         left top
        //         repeat

        //       `
        // })
        @endif

    })
</script>

@endsection