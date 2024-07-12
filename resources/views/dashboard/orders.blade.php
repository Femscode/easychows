@extends('dashboard.master')

@section('header')

@endsection

@section('content')

<main class="main-content-wrapper">
    <section class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <!-- page header -->
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Orders</h2>
                        <!-- breacrumb -->

                    </div>
                    <!-- button -->
                   
                </div>
            </div>
        </div>

       
        <!-- row -->




        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
            <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->

                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Flatpickr-->
                    <div class="input-group w-250px">

                        <h4>Total Orders (<span id='total_order'>{{ count($orders) }}</span>)</h4>
                    </div>
                    <!--end::Flatpickr-->
                    <div class="w-100 mw-350px">
                        <!--begin::Select2-->
                        {{-- <select class="form-select form-select-solid" data-control="select2"
                            data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                            --}}
                            <div class='row'>
                                <div class='col-md-4'>
                                    <label>From:</label>
                                    <input type='date' class='form-control' id='start_date' />
                                </div>
                                <div class='col-md-4'>
                                    <label>To:</label>
                                    <input type='date' class='form-control' id='end_date' />
                                </div>
                                <div class='col-md-4'>
                                    <label>Click to sort:</label><br>
                                    <a id='sort_record' class='btn sm btn btn-secondary'>Sort</a>
                                </div>
                            </div>
                            {{-- <select class="form-select form-select-solid" data-placeholder="Today's Order"
                                id='record_day'>
                                <option></option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>

                            </select> --}}


                            <!--end::Select2-->
                    </div>
                    <!--begin::Add product-->
                    <!--<a href="../catalog/add-product.html" class="btn btn-primary">Add Order</a>-->
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div style='overflow-x:auto;max-width: 100%'>
                    <table style='width:100%' id='datatable' class="mytable table  table-striped align-middle table-row-dashed fs-6 gy-5"
                        id="kt_ecommerce_sales_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                <th class="">Order ID</th>
                                <th class="">Customer</th>
                                <th class="text-end ">Total</th>
                                <th class="text-end  sorting" aria-controls="kt_ecommerce_sales_table">Date Added</th>
                                <th class="text-end ">Location</th>
                                <th class="text-end ">View</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600" id='t_body'>
                            <!--begin::Table row-->
                            @foreach($orders as $order)
                            <tr>

                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a 
                                        class="text-gray-800 text-hover-primary fw-bolder">EC-{{$order->order_id}}</a>
                                </td>
                                <td>


                                    <p class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$order->name}}</p>

                                </td>

                                <td class="text-end pe-0">
                                    <span class="fw-bolder">₦{{number_format($order->total_price + $order->delivery_amount,2)}}</span>
                                </td>
                                <td class="text-end" data-order="{{Date('d-m-Y', strtotime($order->created_at))}}">
                                    <span class="fw-bolder">{{Date('d/m/Y', strtotime($order->created_at))}}</span>
                                </td>
                                <td class="text-end" data-order="{{Date('d/m/Y', strtotime($order->updated_at))}}">
                                    <span class="fw-bolder">{{$order->location}}</span>
                                </td>
                                <td class="text-end">

                                    <a href='orderdetails/{{$order->id}}' style='background:#ebab21'
                                        class='btn-sm btn btn-warning'>View</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
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
    $("#sort_record").on('click',function() {
        var fd = new FormData;
        console.log($("#start_date").val(),'the val')
        if($("#start_date").val().length  <= 4) {
            Swal.fire('error','Please pick a starting date','error')
        }
        else {

        
        Swal.fire({
          type: 'info',
          title: 'Loading...',
          text: 'Fetching record, please wait...🙂',
          showConfirmButton: false,
          timer: 2000
        })
        fd.append('val',$("#record_day").val());
        fd.append('start_date',$("#start_date").val());
        fd.append('end_date',$("#end_date").val());
    
        console.log(fd)
        $.ajax({
            type: 'POST',
            url: "{{route('record_day')}}",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log('the data', data)
                Swal.close()
                $("#t_body").empty()
                $("#total_order").text(data.length)
                $.each(data, function(key, value) {
                var d = new Date(value.created_at)
                var d_date = d.getDate()
                var m_date = d.getMonth() + 1
                var y_date = d.getFullYear();
                var real_date = d_date + "/" + m_date + "/" + y_date
                
                $("#t_body").append(`
                <tr>
                                       
                                        <td data-kt-ecommerce-order-filter="order_id">
                                            <a class="text-gray-800 text-hover-primary fw-bolder">CT-${value.order_id}</a>
                                        </td>
                                        <td>
                                           
                                                    <p class="text-gray-800 text-hover-primary fs-5 fw-bolder">${value.name}</p>
                                               
                                        </td>
                                      
                                        <td class="text-end pe-0">
                                            <span class="fw-bolder"># ${value.total_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</span>
                                        </td>
                                        <td class="text-end" data-order="2022-01-28">
                                            <span class="fw-bolder">${real_date}</span>
                                        </td>
                                        <td class="text-end" data-order="2022-01-31">
                                            <span class="fw-bolder">${value.location}</span>
                                        </td>
                                        <td class="text-end">

                                            <a href='orderdetails/${value.id}' style='background:#ebab21' class='btn-sm btn btn-warning'>View</a>
                                        </td>
                                    </tr>
                                
                `)
                })
                // window.location.reload()

            },
            error: function(data) {
                console.log(data)
                Swal.close()
                Swal.fire('Opps!', 'An error occured, contact the administrator', 'error')
            }
        })
    }


    });
    })
</script>
@endsection