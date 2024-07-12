@extends('backend.master')
@section('header_link')
@endsection
@section('content')
<div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-3 mx-xl-10 pt-0 pb-1">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Create Category</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">If you need more info, please check out
                        <a href="#" class="link-primary fw-bolder">FAQ Page</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-5 my-15">
                    <!--begin::Form-->
                    <!-- <form method='post' action='{{route("createcategory")}}' class="form fv-plugins-bootstrap5 fv-plugins-framework">@csrf -->
                    <form method='post' id='createcategory' class="form fv-plugins-bootstrap5 fv-plugins-framework">@csrf
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Category Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input required type="text" class="form-control form-control-solid" placeholder="E.g Drinks, Swallow, Cakes" id='category_name' name="name" value="">


                        </div>

                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                        <div></div>
                    </form>
                    <!--end::Form-->
                </div>


            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<!-- edit category modal -->


<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" style="" class="header bg-white align-items-stretch">
        <!--begin::Container-->

        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Aside mobile toggle-->
            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                <div class="btn btn-icon btn-active-color-primary w-40px h-40px" id="kt_aside_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black"></path>
                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Aside mobile toggle-->
            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="/dashboard" class="d-lg-none">
                    <img alt="Logo" src="{{asset('assets/images/logo.png')}}" class="h-30px">
                </a>
            </div>
            <!--end::Mobile logo-->
            <div class="d-flex align-items-center" id="kt_header_wrapper">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_wrapper'}">
                    <!--begin::Heading-->
                    <h1 class="text-dark fw-bolder my-1 fs-3 lh-1"><a href="/dashboard">Dashboard</a></h1>
                    <!--end::Heading-->
                </div>
                <!--end::Page title=-->
            </div>
            <!--begin::Wrapper-->
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                <!--begin::Navbar-->
                <div class="d-flex align-items-stretch" id="kt_header_nav">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                        <!--begin::Menu-->
                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-600 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold fs-6 my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                <a href="/profile" class="menu-link py-3">
                                    <h6 class="menu-title">Profile</h6>
                                    <span class="menu-arrow d-lg-none"></span>
                                </a>

                            </div>
                            <div class="menu-item here show menu-lg-down-accordion me-lg-1">
                                <a href="/category" class="menu-link py-3">
                                    <h6 class="menu-title">Category</h6>
                                    <span class="menu-arrow d-lg-none"></span>
                                </a>

                            </div>

                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                <a href="/food" class="menu-link py-3">
                                    <h6 class="menu-title">Restaurant Menu</h6>
                                    <span class="menu-arrow d-lg-none"></span>
                                </a>

                            </div>
                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                <a href="/orders" class="menu-link py-3">
                                    <h6 class="menu-title">Orders</h6>
                                    <span class="menu-arrow d-lg-none"></span>
                                </a>

                            </div>
                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                <span class="menu-link py-3">
                                    <h6 class="menu-title">Subscription</h6>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>

                            </div>
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Navbar-->
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">

                    <!--begin::User-->
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true" style="">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{Auth::user()->name}}
                                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Vendor</span>
                                        </div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="/profile" class="menu-link px-5">Profile</a>
                            </div>
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->

                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a onclick='return confirm("Are you sure you want to sign out")' href="logout" class="menu-link px-5">Sign Out</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User -->
                    <!--begin::Heaeder menu toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-3 me-n1" title="Show header menu">
                        <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black"></path>
                                    <path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Heaeder menu toggle-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
           
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Row-->
           
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row gy-5 g-xl-6">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Tables Widget 9-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                               
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add menu">
                                    <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_menu">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->Add Menu
                                    </a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->

                                    <table class="mytable table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                              
                                                <th class="min-w-150px">Category</th>

                                                <th class="min-w-120px">Image</th>
                                                <th class="min-w-100px text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>
                                            @foreach($foodimages as $food)
                                            <tr>
                                                
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <!-- <img src="/metronic8/demo1/assets/media/avatars/300-14.jpg" alt=""> -->
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                          <span class="text-muted fw-bold text-muted d-block fs-7">{{$food->category}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                                        <div class="symbol-label" style="background-image: url('/foodimages/{{ $food->image }}')"></div>
                                                    </div>
                                                </td>

                                                
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                       
                                                        <a href='deletefoodimage/{{ $food->id }}' class="delete_food btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
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
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--end::Tables Widget 9-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::List Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title fw-bolder text-dark">Create Image</h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">ORDERS</div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="/orders" class="menu-link px-3">View all</a>
                                        </div>

                                    </div>
                                    <!--end::Menu 3-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Item-->
                                <form method='post' action='{{ route("createfoodimage") }}' enctype='multipart/form-data'>@csrf
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Category</label>
                                      <input type="text" name='category' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Image</label>
                                      <input type="file" name='image' class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end:List Widget 3-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->

                    <!--end::Col-->
                </div>
                <div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="#" id="kt_modal_add_event_form">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder" data-kt-calendar="title">Add Event</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold required mb-2">Event Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Event Description</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">Event Location</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday">
                                            <span class="form-check-label fw-bold" for="kt_calendar_datepicker_allday">All Day</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2 required">Event Start Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date">
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Event Start Time</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time">
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date">
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Event End Time</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time">
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - New Product-->
                <!--begin::Modal - New Product-->
                <div class="modal fade" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header border-0 justify-content-end">
                                <!--begin::Edit-->
                                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="" id="kt_modal_view_event_edit" data-bs-original-title="Edit Event">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Edit-->
                                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="" id="kt_modal_view_event_delete" data-bs-original-title="Delete Event">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="" data-bs-dismiss="modal" data-bs-original-title="Hide Event">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body pt-0 pb-20 px-lg-17">
                                <!--begin::Row-->
                                <div class="d-flex">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
                                            <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
                                            <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <div class="mb-9">
                                        <!--begin::Event name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fs-3 fw-bolder me-3" data-kt-calendar="event_name"></span>
                                            <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                        </div>
                                        <!--end::Event name-->
                                        <!--begin::Event description-->
                                        <div class="fs-6" data-kt-calendar="event_description"></div>
                                        <!--end::Event description-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <circle fill="#000000" cx="12" cy="12" r="8"></circle>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Event start date/time-->
                                    <div class="fs-6">
                                        <span class="fw-bolder">Starts</span>
                                        <span data-kt-calendar="event_start_date"></span>
                                    </div>
                                    <!--end::Event start date/time-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="d-flex align-items-center mb-9">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <circle fill="#000000" cx="12" cy="12" r="8"></circle>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Event end date/time-->
                                    <div class="fs-6">
                                        <span class="fw-bolder">Ends</span>
                                        <span data-kt-calendar="event_end_date"></span>
                                    </div>
                                    <!--end::Event end date/time-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black"></path>
                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Event location-->
                                    <div class="fs-6" data-kt-calendar="event_location"></div>
                                    <!--end::Event location-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - New Product-->
                <!--end::Modals-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--begin::Content-->

    <!-- The end of the session content -->
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-gray-400 fw-bold me-1">Powered by</span>
                <a href="https://thecaretech.org/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">CareTech</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                <li class="menu-item">
                    <a href="https://cthostel.com/" target="_blank" class="menu-link px-2">CTHostel</a>
                </li>
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">CTDogs</a>
                </li>
                <li class="menu-item">
                    <a href="https://thecaretech.org/" target="_blank" class="menu-link px-2">CareTech</a>
                </li>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->
</div>
@endsection
@section('script')
<!-- javascript for category -->
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#createcategory").on("submit", async function(e) {
            Swal.fire('Creating category, please wait...')
            e.preventDefault();
            var fd = new FormData;
            fd.append('name', $("#category_name").val());
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('createcategory')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Swal.fire('success', 'Food category created successfully!', 'success')
                    window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Category not created, contact the administrator', 'error')
                }
            })

        })

        $("#update_category").on("submit", async function(e) {
            Swal.fire('Editing category, please wait...')
            e.preventDefault();
            var fd = new FormData;
            fd.append('name', $("#edit_category_name").val());
            fd.append('id', $("#edit_id").val());
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('updatecategory')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Swal.fire('success', 'Food category updated successfully!', 'success')
                    window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Category not updated, contact the administrator', 'error')
                }
            })

        })

        $('body').on('click', '.edit_category', function() {

            id = $(this).data('id');
            $.get("{{route('editcategory')}}?id=" + id, function(data) {
                console.log(data);
                $("#edit_category_name").val(data.name)
                $("#edit_id").val(data.id)
            });


        });

        $('body').on('click', '.delete_category', function() {
            // var id = $("#delete_id").val();
            id = $(this).data('id');
            console.log(id)
            var token = $("meta[name='csrf-token']").attr("content");
            var el = this;
            // alert(user_id);
            resetAccount(el, id);
        });


        async function resetAccount(el, id) {
            const willUpdate = await Swal.fire({
                title: "Confirm Category Delete",
                text: `Are you sure you want to delete? Food under this category will be deleted also?`,
                icon: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                showCancelButton: true,
                buttons: ["Cancel", "Yes, Delete"]
            });
            console.log(willUpdate.isDismissed, 'this is the will update')
            if (willUpdate.isDismissed == false) {
                //performReset()
                performDelete(el, id);
            } else {
                Swal.fire("Category will not be deleted  :)");
            }
        }


        function performDelete(el, id) {

            try {
                $.get('{{ route("deletecategory") }}?id=' + id,
                    function(data, status) {
                        console.log(status);
                        console.table(data);
                        if (status === "success") {
                            let alert = Swal.fire('success', "Category successfully deleted!.", 'success');
                            $(el).closest("tr").remove();
                            window.location.reload()

                        }
                    }
                );
            } catch (e) {
                let alert = Swal.fire(e.message);
            }
        }
        // end of javascript for category
        // beginning of javascript for food




        $("#createfood").on("submit", async function(e) {
            Swal.fire('Creating menu, please wait...')
            e.preventDefault();
            var fd = new FormData;
            fd.append('category_id', $("#category_id").val());
            fd.append('name', $("#food_name").val());
            fd.append('price', $("#price").val());
            fd.append('image',$('#image')[0].files[0]);

            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('createfood')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Swal.fire('success', 'Menu created successfully!', 'success')
                    window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Food not created, contact the administrator', 'error')
                }
            })

        })

        $("#updatefood").on("submit", async function(e) {
            Swal.fire('Updating menu, please wait...')
            e.preventDefault();
            var fd = new FormData;
            var files = $('#edit_menu_image')[0].files;
            fd.append('category_id', $("#edit_menu_category_id").val());
            fd.append('name', $("#edit_menu_name").val());
            fd.append('price', $("#edit_menu_price").val());
            fd.append('image', files[0]);
            fd.append('id', $("#edit_menu_id").val());


            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('updatefood')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Swal.fire('success', 'Menu updated successfully!', 'success')
                    window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Menu not updated, contact the administrator', 'error')
                }
            })

        })

        $('body').on('click', '.edit_menu', function() {

            id = $(this).data('id');
            $.get("{{route('editfood')}}?id=" + id, function(data) {
                console.log(data);
                $("#edit_menu_category_id").val(data.category_id)
                $("#edit_menu_name").val(data.name)
                $("#edit_menu_price").val(data.price)
                $("#edit_menu_id").val(data.id)
            });


        });

        $('body').on('click', '.delete_food', function() {
            // var id = $("#delete_id").val();
            id = $(this).data('id');
            console.log(id)
            var token = $("meta[name='csrf-token']").attr("content");
            var el = this;
            // alert(user_id);
            resetFood(el, id);
        });


        async function resetFood(el, id) {
            const willUpdate = await Swal.fire({
                title: "Confirm Menu Delete",
                text: `Are you sure you want to delete this menu?`,
                icon: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                showCancelButton: true,
                buttons: ["Cancel", "Yes, Delete"]
            });
            if (willUpdate.isDismissed == false) {
                //performReset()
                performDeleteFood(el, id);
            } else {
                Swal.fire("Menu will not be deleted  :)");
            }
        }


        function performDeleteFood(el, id) {

            try {
                $.get('{{ route("deletefood") }}?id=' + id,
                    function(data, status) {
                        console.log(status);
                        console.table(data);
                        if (status === "success") {
                            let alert = Swal.fire('success', "Menu successfully deleted!.", 'success');
                            $(el).closest("tr").remove();
                            window.location.reload()

                        }
                    }
                );
            } catch (e) {
                let alert = Swal.fire(e.message);
            }
        }

        // $(".mytable").dataTable();
        $(".mytable").DataTable({
            pageLength: 5,
            filter: true,
            deferRender: true,

            "searching": true,
        });

        $('body').on('click', '.available', function() {
            if($(this).is(":checked")) {
              
                status = false;
            }
            else {
             
                status = true;
            }
            id = $(this).data('id');
            var fd = new FormData;
            fd.append('id',id);
            fd.append('status', status);
           


            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('availability')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log('the data', data)
                    Swal.close()
                    if(data == true) {
                        Swal.fire('Enabled', 'Food is now made available for customers!', 'info')
                    } else {
                        Swal.fire('Disabled', 'Food is now disabled for customers!', 'info')

                    }
                    // window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Menu not updated, contact the administrator', 'error')
                }
            })


        });

    })
</script>

@endsection