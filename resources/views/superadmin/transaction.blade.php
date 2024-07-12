@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">
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
                    <div class='d-flex'>
                        <div class="input-group w-250px">

                            <h4>Wallet Balance (<span id='total_order'>NGN{{ number_format($user->balance,2)}}</span>)
                            </h4>
                        </div>
                    </div>
                    <!--end::Flatpickr-->

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
                <table id='datatable' class="table align-middle table-row-dashed fs-6 gy-5"
                    id="kt_ecommerce_sales_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                            <th class="">Title</th>
                            <th class="">Details</th>
                            <th class="text-end ">Amount</th>
                            <th class="text-end ">Before</th>
                            <th class="text-end ">After</th>
                            <th class="text-end  sorting" aria-controls="kt_ecommerce_sales_table">Date & Time</th>
                            <th class="text-end ">Status</th>
                            <th class="text-end ">Action</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600" id='t_body'>
                        <!--begin::Table row-->
                        @foreach($transactions as $tranx)
                        <tr>

                            {{-- <td data-kt-ecommerce-order-filter="order_id">
                                <a href="https://wa.me/234{{$tranx->customer_phone }}"
                                    class="text-gray-800 text-hover-primary fw-bolder">{{$tranx->customer_name}}, {{
                                    $tranx->customer_phone }}</a>
                            </td> --}}
                            <td data-kt-ecommerce-order-filter="order_id">
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fw-bolder">{{$tranx->title}}</a>
                            </td>
                            <td data-kt-ecommerce-order-filter="order_id">
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fw-bolder">{{$tranx->details}}</a>
                            </td>


                            <td class="text-end pe-0">
                                <span class="fw-bolder"># {{number_format($tranx->amount,2)}}</span>
                            </td>
                            <td class="text-end pe-0">
                                <span class="fw-bolder"># {{number_format($tranx->before_balance,2)}}</span>
                            </td>
                            <td class="text-end pe-0">
                                <span class="fw-bolder"># {{number_format($tranx->after_balance,2)}}</span>
                            </td>
                            <td class="text-end" data-order="{{Date('d-m-Y', strtotime($tranx->created_at))}}">
                                <span class="fw-bolder">{{Date('d/m/Y', strtotime($tranx->created_at))}}</span>
                            </td>
                            <td class="text-end" data-order="{{Date('d/m/Y', strtotime($tranx->updated_at))}}">
                                <span class="fw-bolder">
                                    @if($tranx->status == 1)
                                    <span class='btn btm-sm btn-success' style='background:#d1e7dd;color:#28a745'>
                                        Success
                                    </span>
                                    @else
                                    <span class='btn btm-sm btn-error' style='background:#f8d7da;color:#dc3545'>
                                        Error
                                    </span>
                                    @endif
                                </span>
                            </td>
                            <td class="text-end">
                                @if($tranx->title !== 'Funds Withdraw')

                                <a href='orderdetails/{{$tranx->order_id}}' style='background:#ebab21'
                                    class='btn-sm btn btn-warning'>View Order</a>

                                @else 
                                <a href='#' class='btn btn-primary btn-sm'>Download Receipt</a>
                                @endif

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')

@endsection
@endsection