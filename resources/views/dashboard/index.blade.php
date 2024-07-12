@extends('dashboard.master')

@section('header')

@endsection 

@section('content')
<main class="main-content-wrapper">
               <section class="container">
                <h2>Welcome back, {{$user->name}} </h2>

                @if($user->approve == 0)
                <div class="card card-lg mb-6">
                              <!-- card body -->
                              <div class="card-body px-6 py-8">
                                 <div class="d-flex align-items-center">
                                    <div>
                                       <!-- svg -->
                                       <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bell text-warning" viewBox="0 0 16 16">
                                          <path
                                             d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                       </svg>
                                    </div>
                                    <!-- text -->
                                    <div class="ms-4">
                                       <h5 class="mb-1">Account Yet To Be Approved, <a href='https://wa.me/2348101187105?text=Hi%20Admin,%20%0a--�--%0aI%20just%20finish%20setting%20up%20my%20account%20,%20you%20can%20check%20out%20my%20restaurant%20profile({{$user->name}})%20for%20proper%20verification%20and%20approval'>Click here</a> to approve.</h5>
                                      
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
           
            @endif
                  <!-- row -->
             
                  <!-- table -->
                  <div class="table-responsive-xl mb-6 mb-lg-0">
                     <div class="row flex-nowrap pb-3 pb-lg-0">
                       
                        <div class="col-lg-4 col-12 mb-6">
                           <!-- card -->
                           <div class="card h-100 card-lg bg-light-warning">
                              <!-- card body -->
                              <div class="card-body p-6">
                                 <!-- heading -->
                                 <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div>
                                       <h4 class="mb-0 fs-5">Menu</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                                       <i class="bi bi-circle fs-5"></i>
                                    </div>
                                 </div>
                                 <!-- project number -->
                                 <div class="lh-1">
                                    <h1 class="mb-2 fw-bold fs-2">{{ $foods }}</h1>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
                    
                        <div class="col-lg-4 col-12 mb-6">
                           <!-- card -->
                           <div class="card h-100 card-lg bg-light-primary">
                              <!-- card body -->
                              <div class="card-body p-6">
                                 <!-- heading -->
                                 <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div>
                                       <h4 class="mb-0 fs-5">Today's Order</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
                                       <i class="bi bi-cart fs-5"></i>
                                    </div>
                                 </div>
                                 <!-- project number -->
                                 <div class="lh-1">
                                    <h1 class="mb-2 fw-bold fs-2">{{ $orders }}</h1>
                                    
                                 </div>
                              </div>
                           </div>
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

                        <h4>Total Orders (<span id='total_order'>{{ count($todayorders) }}</span>)</h4>
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
                    <table style='width:100%' id='datatable' class="table align-middle table-row-dashed fs-6 gy-5"
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
                            @foreach($todayorders as $order)
                            <tr>

                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bolder">CT-{{$order->order_id}}</a>
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

@endsection