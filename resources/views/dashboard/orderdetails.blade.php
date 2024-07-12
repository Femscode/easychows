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
                        <h2>Order Details</h2>
                        <!-- breacrumb -->

                    </div>
                    <!-- button -->

                </div>
            </div>
        </div>


        <!-- row -->




        <!-- row -->
       
        <!--begin::Order details page-->
        <div class="row">
            <div class='col-md-4'>
                <div class="flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul
                        class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                        </li>

                    </ul>


                </div>
                <!--begin::Order summary-->
                <div class="flex-column flex-xl-row gap-12 gap-lg-12">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Order Details ({{$order->order_id}})</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none">
                                                            <path opacity="0.3"
                                                                d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
                                                                fill="black" />
                                                            <path
                                                                d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Date Ordered
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{Date('d/m/Y
                                                H:i',strtotime($order->created_at))}}</td>
                                        </tr>
                                    
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->

                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Customer name-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                                fill="black" />
                                                            <path
                                                                d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Customer
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->

                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary">{{$order->name}}</a>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <!--end::Customer name-->
                                        <!--begin::Customer email-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                                fill="black" />
                                                            <path
                                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Address
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <a href="#"
                                                    class="text-gray-600 text-hover-primary">{{$order->location}}<br>{{$order->address}}</a>
                                            </td>
                                        </tr>
                                        <!--end::Payment method-->
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                                fill="black" />
                                                            <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Phone
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{$order->phone}}</td>
                                        </tr>
                                        <!--end::Date-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer details-->

                </div>
            </div>
            <div class='col-md-8'>
                <!--end::Order summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Payment address-->

                                <!--end::Shipping address-->
                            </div>
                            <!--begin::Product List-->
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Order {{$order->order_id}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-70px text-end">Product</th>

                                                    <th class="min-w-70px text-end">Qty</th>
                                                    <th class="min-w-100px text-end">Unit Price</th>
                                                    <th class="min-w-100px text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Products-->
                                                @foreach($carts->items as $product)
                                                <tr>
                                                    <!--begin::Product-->
                                                    <td class='text-end'>
                                                        <a
                                                            class="fw-bolder text-gray-600 text-hover-primary">{{$product['name']}}</a>


                                                    </td>
                                                    <!--end::Product-->
                                                    <!--begin::SKU-->

                                                    <!--end::SKU-->
                                                    <!--begin::Quantity-->
                                                    <td class="text-end">{{$product['qty']}}</td>
                                                    <!--end::Quantity-->
                                                    <!--begin::Price-->
                                                    <td class="text-end">₦{{number_format($product['price'],2)}}</td>
                                                    <!--end::Price-->
                                                    <!--begin::Total-->
                                                    <td class="text-end">₦{{number_format($product['price'] *
                                                        $product['qty'],2) }}</td>
                                                    <!--end::Total-->
                                                </tr>
                                                @endforeach
                                                <br>
                                                <tr>
                                                    <td class="text-end"></td>
                                                    <td colspan="text-end" class="text-end"></td>
                                                    <td colspan="text-end" class="text-end">Subtotal</td>
                                                    <td class="text-end">₦{{number_format($order->total_price - $order->delivery_amount,2)}}</td>
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::VAT-->
                                                <tr>
                                                    <td class="text-end"></td>
                                                    <td colspan="text-end" class="text-end"></td>
                                                    <td colspan="text-end" class="text-end">Delivery (0%)</td>
                                                    <td class="text-end">₦{{number_format($order->delivery_amount,2)}}
                                                    </td>
                                                </tr>
                                                <!--end::VAT-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td class="text-end"></td>
                                                    <td colspan="text-end" class="text-end"></td>
                                                    <td colspan="text-end" class="text-end">CT Charge</td>
                                                    <td class="text-end">₦50</td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Grand total-->
                                                <tr>
                                                    <td class="text-end"></td>
                                                    <td colspan="text-end" class="text-end"></td>
                                                    <td colspan="text-end" class="fs-3 text-dark text-end">Grand Total
                                                    </td>
                                                    <td class="text-dark fs-3 fw-boldest text-end">
                                                        ₦{{number_format($order->total_price,2)}}</td>
                                                </tr>
                                                <!--end::Grand total-->
                                            </tbody>
                                            <!--end::Table head-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->

                    <!--end::Tab pane-->
                </div>
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Order details page-->
   
    </section>
</main>

@endsection

@section('script')

@endsection