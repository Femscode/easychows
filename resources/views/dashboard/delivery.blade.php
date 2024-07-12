@extends('dashboard.master')

@section('header')

@endsection

@section('content')

<main class="main-content-wrapper">

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            



            @if($user->approve == 0)
            <div class="alert alert-danger" role="alert">

                Please note that for you to start selling on CTtaste, you have to get your restaurant
                approved by clicking on the approve button below.<br>
                <a href='https://wa.me/2349058744473?text=Hi%20Admin,%20%0a--�--%0aI%20just%20finish%20setting%20up%20my%20account%20at%20CTTaste,%20you%20can%20check%20out%20my%20restaurant%20profile({{$user->name}})%20for%20proper%20verification%20and%20approval.'
                    class='btn-sm btn btn-danger'>Approve</a>

            </div>
            @endif
           
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <!--begin::List Widget 3-->
            <div class='p-1 pb-0 rounded' style='background-image:url("/assets/images/metronicsArt.jpg")'>

            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="p-4 border-0">
                    <h3 class="card-title fw-bolder text-dark pt-4">Pack Fee and Limit</h3>
                    <small style='font-size:15px;'  class="form-text text-grey">Set limits to the amount
                        of
                        pack that can be ordered at a time. Max(15)</small>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2">
                    <!--begin::Item-->
                    <form id='set_pack_price'>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pack Price</label>
                            <input type="number" class="form-control" id="pack_fee"
                                aria-describedby="Pack Price" value='{{ $user->pack_fee ?? "100"}}'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pack Limit</label>
                            <input type="number" class="form-control" id="pack_limit"
                                value='{{ $user->pack_limit ?? 15 }}'>

                        </div>

                        <button type="submit" class="mt-2 w-100 btn btn-primary">Update</button>
                    </form>
                </div>
                <!--end::Body-->
            </div>
            </div>
            <!--end:List Widget 3-->
        </div>
        <div class="col-xl-8">
            <!--begin::List Widget 3-->
            <div class='p-1 pb-0 rounded' style='background-image:url("/assets/images/metronicsArt.jpg")'>

            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="p-4 border-0">
                    <h3 class="card-title fw-bolder text-dark">Delivery Prices</h3>

                   
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2">
                    <!--begin::Item-->
                    <form id='set_delivery_price'>
                        <div class='row'>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Location Name</label>
                                <input type='hidden' id='user_id' value='{{ $user->id }}' />
                                <input type="text" placeholder="e.g Harmony Estate" class="form-control"
                                    id="location_name" aria-describedby="Location name">
                            </div>
                            <div class="form-group col-md-6 sm-6">
                                <label for="exampleInputPassword1">Delivery Price</label>
                                <input type="number" class="form-control" id="location_price">
                            </div>


                        </div>




                        <button type="submit" style='font-size:15px;'
                            class="btn btn-primary text-white btn-sm mt-2 justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="white"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="white">
                                </rect>
                            </svg>
                            Add Location</button>
                    </form>
                    <div class="table-responsive">
                        <!--begin::Table-->

                        <table
                            class="mytable table table-row-dashed table-striped table-row-gray-700 align-middle gs-0 gy-2">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">

                                    <th class="min-w-150px">Location Name</th>

                                    <th class="min-w-120px">Price</th>
                                    <th class="min-w-120px">Delete</th>


                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody id='delivery_table_body'>
                                @foreach($deliveries as $location)
                                <tr id='deliveryhead{{ $location->id }}'>



                                    <td class="">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary d-block fs-6">{{$location->name}}</a>

                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary d-block fs-6">#{{number_format($location->price,2)}}</a>

                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <a data-id="{{ $location->id }}"
                                                class="delete_location btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="black"></path>
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="black"></path>
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                    </td>



                                </tr>
                                @endforeach

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>

                </div>
                <!--end::Body-->
            </div>
            </div>
            <!--end:List Widget 3-->
        </div>
    </div>
    <!-- end row -->


    <!-- end row -->

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-size-16 align-middle">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                            <label class="form-check-label" for="transactionCheck01"></label>
                                        </div>
                                    </th>
                                    <th class="align-middle">Order ID</th>
                                    <th class="align-middle">Billing Name</th>
                                    <th class="align-middle">Date</th>
                                    <th class="align-middle">Total</th>
                                    <th class="align-middle">Payment Status</th>
                                    <th class="align-middle">Payment Method</th>
                                    <th class="align-middle">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck02">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                                    <td>Neal Matthews</td>
                                    <td>
                                        07 Oct, 2019
                                    </td>
                                    <td>
                                        $400
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end row -->
</div>
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
            const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
    @if (session('message'))
    Swal.fire('CT-Taste',"{{ session('message') }}",'success');
    @endif
  




    $('body').on('submit', '#set_pack_price',async function(e) {
        e.preventDefault()
      
        var fd = new FormData;
        fd.append('pack_fee',$("#pack_fee").val());
        fd.append('pack_limit',$("#pack_limit").val());
        console.log(fd)
        $.ajax({
            type: 'POST',
            url: "{{route('set_pack_price')}}",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log('the data', data)
                Swal.close()
                    if(data == true) {
                       
                        console.log(data)
                        Toast.fire({
                            icon: 'success',
                            title: 'Pack set successfully'
                            })
                    }
                    else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Pack Limit Too Much'
                            }) 
                    }
                    
               
                // window.location.reload()

            },
            error: function(data) {
                console.log(data)
                Swal.close()
                Swal.fire('Opps!', 'Pack not updated, contact the administrator', 'error')
            }
        })


    });

    $('body').on('submit', '#set_delivery_price',async function(e) {
        e.preventDefault()
      
        var fd = new FormData;
        fd.append('user_id',$("#user_id").val());
        fd.append('location_name',$("#location_name").val());
        fd.append('location_price',$("#location_price").val());
       
        console.log(fd)
        $.ajax({
            type: 'POST',
            url: "{{route('set_delivery_price')}}",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log('the data', data)
                Swal.close()
                    if(data == false) {
                        Swal.fire('Opps!', 'Location name already in existence!', 'error')
                    
                    }
                    else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Delivery location added successfully'
                            })
                            $("#location_name").val('')
                            $("#location_price").val('')
                        $("#delivery_table_body").prepend(`
                        <tr id='deliveryhead${data.id}'>

                                       
                                       
                        <td class="">
                            <div class="d-flex flex-column w-100 me-2">
                                <a href="#"
                                    class="text-dark fw-bolder text-hover-primary d-block fs-6">${data.name}</a>

                            </div>
                        </td>
                        <td class="">
                            <div class="d-flex flex-column w-100 me-2">
                                <a href="#"
                                    class="text-dark fw-bolder text-hover-primary d-block fs-6">#${data.price}</a>

                            </div>
                        </td>
                        <td class="">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <a data-id="${data.id}"
                                                class="delete_location btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="black"></path>
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="black"></path>
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                    </td>
                         

                        </tr>
                        `)
                    console.log(data)
                       
                    }
                    
               
                // window.location.reload()

            },
            error: function(data) {
                console.log(data)
                Swal.close()
                Swal.fire('Opps!', 'Delivery not updated, contact the administrator', 'error')
            }
        })


    });
    $('body').on('click','.delete_location',function() {
        Swal.fire({
            title: 'Delete this location?',
            // text: "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                id = $(this).data('id')
                    $.get('{{ route("deletelocation") }}?val='+id,function(data) {
                        console.log(data,'the location')
                    $("#deliveryhead"+id).closest("tr").remove()
                    Toast.fire({
                                icon: 'success',
                                title: 'Location Deleted'
                                })

                    })
                
            }
            })
       
    })
   
     

        })
</script>
@endsection