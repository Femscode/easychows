@extends('dashboard.master')

@section('header')

@endsection

@section('content')
<div class="modal fade" id="kt_modal_invite_friends2" tabindex="-1" aria-hidden="true">
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
                    <h1 class="mb-3">Edit Category</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">If you need more info, please check out
                        <a class="text-danger link-primary fw-bolder">FAQ Page</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-5 my-15">
                    <!--begin::Form-->
                    <form method='post' id='update_category' class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        @csrf
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Category Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input type='hidden' id='edit_id' />
                            <input required type="text" id='edit_category_name' class="form-control form-control-solid" placeholder="E.g Drinks, Swallow, Cakes" name="name" value="">


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


<!-- end of edit category modal -->
<div class="modal fade" id="kt_modal_menu" tabindex="-1" aria-hidden="true">
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
                <div class="text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Add Menu</h1>
                   
                </div>
                <div class="modal-body scroll-y mx-2 mx-xl-12 my-2">
                    <!--begin::Form-->
                    <!-- <form method='post' action='{{route("createfood")}}' class="form fv-plugins-bootstrap5 fv-plugins-framework">@csrf -->
                    <form id='createfood' enctype="multipart/form-data">
                        <!--begin::Input group-->

                        <div class="d-flex flex-column mb-2 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input required type="text" id='food_name' class="form-control form-control-solid" placeholder="e.g fried rice, full chicken, chocolate cake" name="name" value="">


                        </div>

                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Price(#)</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input required type="number" id='price' class="form-control form-control-solid" placeholder="Input Food Price" name="price" value="">


                        </div>

                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Choose Category</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <select required class="form-control form-control-solid" name="category_id" id='category_id' value="">
                                <option value=''>Select Category</option>
                                @foreach($categories as $category)
                                <option value='{{$category->id}}'>{{$category->name}}</option>
                                @endforeach
                            </select>


                        </div>


                        <div id='selectimage' class='fv-plugins-icon-container'>
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Image <span class='text-danger'></span></span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input type="file" accept="image/*" required id='image' class="form-control form-control-solid" name='name' value="">

                        </div>




                        <div class="text-center pt-15 mt-4">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                <span class="indicator-label">Create</span>
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

<div class="modal fade" id="kt_modal_menu2" tabindex="-1" aria-hidden="true">
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
                <div class="text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Edit Menu</h1>
                    
                </div>
                <div class="modal-body scroll-y ">
                    <!--begin::Form-->
                    <!-- <form method='post' action='{{route("createfood")}}' class="form fv-plugins-bootstrap5 fv-plugins-framework">@csrf -->
                    <form method='post' id='updatefood' enctype="multipart/form-data" class="form fv-plugins-bootstrap5 fv-plugins-framework">@csrf
                        <!--begin::Input group-->


                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input required type="text" id='edit_menu_name' class="form-control form-control-solid" placeholder="e.g fried rice, full chicken, chocolate cake" name="name" value="">


                        </div>

                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Price(#)</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input type='hidden' id='edit_menu_id'>
                            <input required type="number" id='edit_menu_price' class="form-control form-control-solid" placeholder="Input category name" name="price" value="">
                        </div>



                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Choose Category</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <select required class="form-control form-control-solid" name="category_id" id='edit_menu_category_id' value="">
                                <option value=''>Select Category</option>
                                @foreach($categories as $category)
                                <option value='{{$category->id}}'>{{$category->name}}</option>
                                @endforeach
                            </select>


                        </div>


                        <div id='edit_selectimage' class='fv-plugins-icon-container'>
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Image <span class='text-danger'>(Optional)</span></span>

                            </label>
                            <!--end::Label-->
                            <input type="file" accept="image/*" id='edit_menu_image' class="form-control form-control-solid" name='name' value="">

                        </div>



                        <div class="text-center pt-15 mt-2">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
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
<main class="main-content-wrapper">
    <section class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <!-- page header -->
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Menus</h2>
                        <!-- breacrumb -->

                    </div>
                    <!-- button -->
                    <div>
                        <a data-bs-toggle="modal" data-bs-target="#kt_modal_menu" class="btn btn-primary">Add Menu</a>
                    </div>
                </div>
            </div>
        </div>

        @if($user->approve == 0)
        <div class="card card-lg mb-6">
            <!-- card body -->
            <div class="card-body px-6 py-8">
                <div class="d-flex align-items-center">
                    <div>
                        <!-- svg -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bell text-warning" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
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




        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive dataTables_length" id='datatable_length'>
                            <table id='datatable' class="mytable table  table-striped nowrap w-100 align-middle mb-0">
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th>
                                            Image
                                        </th>
                                        <th>Name</th>

                                        {{-- <th class="min-w-120px">Price</th> --}}

                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id='search_food_tbody'>
                                    @foreach($foods as $food)
                                    <tr>

                                        <td>
                                            @if(substr($food->image,0,5) == 'https')
                                            <div class="symbol symbol-60px symbol-2by3 me-4">
                                                <img class="symbol-label" style='border:2px solid #ebab21;border-radius:4px' width='90px' height='70px' src='{{ $food->image }}' />

                                            </div>

                                            @else

                                            <div class="symbol symbol-60px symbol-2by3 me-4">
                                                <img class="symbol-label" style='border:2px solid #ebab21;border-radius:4px' width='90px' height='70px' src='https://cttaste.com/cttaste_files/public/foodimages/{{ $food->image }}' />

                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a id='name-{{ $food->id }}' class="text-dark fw-bolder text-hover-primary fs-6">{{$food->name}}</a>
                                                    <a id='price-{{$food->id  }}' style='color:#dc3545' class=" fw-bolder text-hover-primary d-block fs-6">#{{number_format($food->price,2)}}</a>

                                                    {{-- <span
                                                    class="text-muted fw-bold text-muted d-block fs-7">Quantity:
                                                    {{$food->quantity}}</span> --}}
                                                </div>
                                            </div>
                                        </td>




                                        <td>
                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                <div class="form-check form-check-solid form-switch fv-row">
                                                    <input class="available form-check-input w-45px h-30px" type="checkbox" data-id='{{$food->id}}' id="available" @if($food->available ==1)checked @endif >
                                                    <label class="form-check-label" for="allowmarketing"></label>
                                                </div>
                                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_menu2" data-id='{{$food->id}}' class="edit_menu btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <a data-id='{{$food->id}}' class="delete_food btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
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
        @if(session('message'))
        Swal.fire('CT-Taste', "{{ session('message') }}", 'success');
        @endif



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
            fd.append('image', $('#image')[0].files[0]);
            fd.append('selectedimage', $('#selectedimagespan').val());

            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('createfood')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log('the data', data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Menu added successfully'
                    })
                    $("#search_food_tbody").prepend(`
                <tr >

                <td>
                
                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                            <img class="symbol-label" style='border:2px solid #ebab21;border-radius:4px' width='90px' height='70px' src='https://cttaste.com/cttaste_files/public/foodimages/${data.image}'/>
                                           
                                        </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                                           
                                           <div class="d-flex justify-content-start flex-column">
                                               <a id='name-${data.id}'
                                                   class="text-dark fw-bolder text-hover-primary fs-6">${data.name}</a>
                                               <a  id='price-${data.id}' style='color:#dc3545'
                                                   class=" fw-bolder text-hover-primary d-block fs-6">${data.price.toLocaleString('en-US', { style: 'currency', currency: 'NGN' })}</a>

                                           </div>
                                       </div>
                  
                   
                </td>

            


                <td>
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <div class="form-check form-check-solid form-switch fv-row">
                            <input class="available form-check-input w-45px h-30px"
                                type="checkbox" data-id='${data.id}' id="available"
                                ${data.available} == 1 ? checked : ''>
                            
                            <label class="form-check-label" for="allowmarketing"></label>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#kt_modal_menu2"
                            data-id='${data.id}'
                            class="edit_menu btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                        fill="black"></path>
                                    <path
                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                        </a>
                        <a data-id='${data.id}'
                            class="delete_food btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                        </a>
                    </div>
                </td>
                </tr>
                `)
                    $("#category_id").val('')
                    $("#food_name").val('')
                    $("#price").val('')
                    $("#image").val('')
                    $("#kt_modal_menu").modal('hide')
                    Swal.close()
                    // window.location.reload()

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
            fd.append('category_id', $("#edit_menu_category_id").val());
            fd.append('name', $("#edit_menu_name").val());
            fd.append('price', $("#edit_menu_price").val());
            fd.append('id', $("#edit_menu_id").val());
            fd.append('image', $('#edit_menu_image')[0].files[0]);
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('updatefood')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log('the data', data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Menu updated successfully'
                    })
                    // Swal.fire('success', 'Menu updated successfully!', 'success')
                    var id = $("#edit_menu_id").val()
                    $("#name-" + id).text(data.name)
                    $("#price-" + id).text(data.price)
                    $("#image-" + id).css('backgroundImage', "url(public/foodimages/" + data.image + ")");
                    $("#kt_modal_menu2").modal('hide')
                    // Swal.close()
                    // window.location.reload()

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

            $("#edit_menu_image").val('')
            $.get("{{route('editfood')}}?id=" + id, function(data) {
                console.log(data);
                $("#edit_menu_category_id").val(data.category_id)
                $("#edit_menu_name").val(data.name)
                $("#edit_menu_price").val(data.price)
                // $("#edit_menu_quantity").val(data.quantity)
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
                            Toast.fire({
                                icon: 'success',
                                title: 'Menu deleted successfully'
                            })
                            //  Swal.fire('success', "Menu successfully deleted!.", 'success');
                            $(el).closest("tr").remove();


                        }
                    }
                );
            } catch (e) {
                let alert = Swal.fire(e.message);
            }
        }

     

        $('body').on('submit', '#set_pack_price', async function(e) {
            e.preventDefault()

            var fd = new FormData;
            fd.append('pack_fee', $("#pack_fee").val());
            fd.append('pack_limit', $("#pack_limit").val());
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
                    if (data == true) {
                        Swal.fire('Success!', 'Pack Updated Successfully!', 'success')
                        console.log(data)
                    } else {
                        Swal.fire('Pack Limit Too Much!', 'Pack Limit is more than 15!', 'error')

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

        $('body').on('submit', '#set_delivery_price', async function(e) {
            e.preventDefault()

            var fd = new FormData;
            fd.append('user_id', $("#user_id").val());
            fd.append('location_name', $("#location_name").val());
            fd.append('location_price', $("#location_price").val());

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
                    if (data == false) {
                        Swal.fire('Opps!', 'Location name already in existence!', 'error')

                    } else {
                        Swal.fire('Success!', 'Delivery Price Added Successfully!', 'success')
                        $("#delivery_table_body").prepend(`
                        <tr id='deliveryhead${data.id}'>

                                       
                                       
                        <td class="">
                            <div class="d-flex flex-column w-100 me-2">
                                <a 
                                    class="text-dark fw-bolder text-hover-primary d-block fs-6">${data.name}</a>

                            </div>
                        </td>
                        <td class="">
                            <div class="d-flex flex-column w-100 me-2">
                                <a 
                                    class="text-dark fw-bolder text-hover-primary d-block fs-6">#${data.price}</a>

                            </div>
                        </td>
                        <td class="">
                                                                        <div class="d-flex flex-column w-100 me-2">
                                                                            <a data-id="${data.id}" class="delete_location btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
        $('body').on('click', '.delete_location', function() {
            con = confirm('Are you sure you want to delete this location')
            if (con == true) {
                id = $(this).data('id')
                $.get('{{ route("deletelocation") }}?val=' + id, function(data) {
                    console.log(data, 'the location')
                    $("#deliveryhead" + id).closest("tr").remove()

                })
            } else {

            }

        })
        $('body').on('click', '.available', function() {
            if ($(this).is(":checked")) {

                status = false;
            } else {

                status = true;
            }
            id = $(this).data('id');
            var fd = new FormData;
            fd.append('id', id);
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
                    if (data == true) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Food enabled'
                        })
                        // Swal.fire('Enabled', 'Food is now made available for customers!', 'success')
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Food disabled'
                        })
                        // Swal.fire('Disabled', 'Food is now disabled for customers!', 'info')

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
        $("#showimage").click(function() {
            $("#selectimage").hide()
            $("#showimage2").hide()
            $("#imageContainer").show()
        })
        $("#hideimage").click(function() {
            $("#selectimage").show()
            $("#showimage2").show()
            $("#imageContainer").hide()
        })

        $("#edit_showimage").click(function() {
            $("#edit_selectimage").hide()
            $("#edit_showimage2").hide()
            $("#edit_imageContainer").show()
        })
        $("#edit_hideimage").click(function() {
            $("#edit_selectimage").show()
            $("#edit_showimage2").show()
            $("#edit_imageContainer").hide()
        })

        $("#food_search").keyup(function() {
            foodname = $("#food_search").val()
            $.get('{{ route("searchfoodimage") }}?val=' + foodname, function(data) {
                console.log(data, 'image data')
                $("#listimages").empty();
                $.each(data, function(key, value) {
                    console.log(value.image, 'odent')
                    $("#listimages").append(`
                <img src='/foodimages/${value.image}' data-name='${value.category}' data-image='${value.image}' class="selectedimage img-thumbnail rounded m-5" style='width:100px;height:100px'>
                           
                `)
                })

            })
        })

        $("#edit_food_search").keyup(function() {
            foodname = $("#edit_food_search").val()
            $.get('{{ route("searchfoodimage") }}?val=' + foodname, function(data) {
                console.log(data, 'image data')
                $("#edit_listimages").empty();
                $.each(data, function(key, value) {
                    console.log(value.image, 'odent')
                    $("#edit_listimages").append(`
                <img src='/foodimages/${value.image}' data-name='${value.category}' data-image='${value.image}' class="edit_selectedimage img-thumbnail rounded m-5" style='width:100px;height:100px'>
                           
                `)
                })

            })
        })
        $('body').on('click', '.selectedimage', function() {
            image = $(this).data('image')
            name = $(this).data('name')
            $("#food_search").val(name + ".jpg")
            $("#selectedimagespan").val(image)

        })

        $('body').on('click', '.edit_selectedimage', function() {
            image = $(this).data('image')
            name = $(this).data('name')

            $("#edit_food_search").val(name + ".jpg")
            $("#edit_selectedimagespan").val(image)
        })
        $("#searchCategory").on('input', function() {
            var val = $("#searchCategory").val()
            $.get('{{ route("searchCategory") }}?val=' + val, function(data) {
                console.log(data, 'here the data')
                $("#search_category_tbody").empty()
                $.each(data, function(key, value) {

                    $("#search_category_tbody").append(`
                <tr>
                                            <td>
                                                
                                               <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="">
                                                        <div class="symbol-label fs-3 bg-light-danger text-danger">${value.name.substring(0,1)}</div>
                                                    </a>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-45px me-5">
                                                   </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a  class="text-dark fw-bolder text-hover-primary fs-6">${value.name}</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-45px me-5">
                                                   </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a  class="text-dark fw-bolder text-hover-primary fs-6">${value.name}</a>
                                                    </div>
                                                </div>
                                            </td>

                                           
                                            <td>
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <a  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                     <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                                                            </svg>
                                                        </span>
                                                   </a>
                                                    <a data-id='${value.id}' data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends2" class="edit_category btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a data-id='${value.id}' class="delete_category btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                `

                    )
                })
            })
        })
        $("#copy-link").click(function() {
            var link = $("#link-to-copy").attr("value");
            navigator.clipboard.writeText(link).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Linked Copied'
                })

            });
        });
        $("#searchFood").on('input', function() {
            var val = $("#searchFood").val()
            $.get('{{ route("searchFoodDashboard") }}?val=' + val, function(data) {
                console.log(data, 'here the data')
                $("#search_food_tbody").empty()
                $.each(data, function(key, value) {

                    $("#search_food_tbody").append(`
                <tr>
                                           
                                           <td>
                                               <div class="symbol symbol-60px symbol-2by3 me-4">
                                                   <div class="symbol-label" style="background-image: url('/foodimages/${value.image}')"></div>
                                               </div>
                                           </td>
                                           <td>
                                               <div class="d-flex align-items-center">
                                                  
                                                   <div class="d-flex justify-content-start flex-column">
                                                       <a  class="text-dark fw-bolder text-hover-primary fs-6">${value.name}</a>
                                                       <span class="text-muted fw-bold text-muted d-block fs-7">${value.category_id}</span>
                                                   </div>
                                               </div>
                                           </td>

                                           <td class="text-end">
                                               <div class="d-flex flex-column w-100 me-2">
                                                   <a  class="text-dark fw-bolder text-hover-primary d-block fs-6">#${value.price}</a>

                                               </div>
                                           </td>
                                           <td>
                                               <div class="d-flex justify-content-end flex-shrink-0">
                                                   <div class="form-check form-check-solid form-switch fv-row">
                                                       <input class="available form-check-input w-45px h-30px" type="checkbox" data-id='${value.id}' id="available" ${value.available} ==1 ? checked:"">
                                                       <label class="form-check-label" for="allowmarketing"></label>
                                                   </div>
                                                   <a data-bs-toggle="modal" data-bs-target="#kt_modal_menu2" data-id='${value.id}' class="edit_menu btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                       <span class="svg-icon svg-icon-3">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                               <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                               <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                           </svg>
                                                       </span>
                                                   </a>
                                                   <a data-id='${value.id}' class="delete_food btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                       <span class="svg-icon svg-icon-3">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                               <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                               <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                               <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                           </svg>
                                                       </span>
                                                   </a>
                                               </div>
                                           </td>
                                       </tr>
                `

                    )
                })
            })
        })

    })
</script>
@endsection