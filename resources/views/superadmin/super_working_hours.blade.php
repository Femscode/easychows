@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">

        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Working Hours <i class="bx bx-time"></i></h3>
                    <h4>{{ $vendor->name }}</h4>
                    {{-- <div class='d-flex'>Unique Website : <input class='form-control'
                            value='https://cttaste.com/{{ $user->slug }}' /></div> --}}
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <!-- <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"> -->
                <form method='post' action='{{ route("save_working_hour") }}' class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype='multipart/form-data' novalidate="novalidate">@csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @foreach($working_hours as $wk_hour)
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ $wk_hour->day }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 mb-2 fv-row fv-plugins-icon-container">
                                <!--begin::Options-->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="form-check form-check-solid form-switch fv-row">
                                        <input name="availability-{{ $wk_hour->id }}" class="form-check-input w-45px h-30px" type="checkbox"
                                            id="allowmarketing" @if($wk_hour->availability ==1 )checked="checked" @endif>
                                        <label class="form-check-label" for="allowmarketing"></label>
                                    </div>
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid me-5">
                                        <span class="fw-bold ps-2 fs-6">Opening Time</span>
                                        <input name='opening_hour-{{ $wk_hour->id }}' class="form-control" name="opening_hour" type="time"
                                            value="{{ $wk_hour->opening_hour }}" id="opening_hour">
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label class="form-check form-check-inline form-check-solid">
                                        <span class="fw-bold ps-2 fs-6">Closing Time</span>
                                        <input  name='closing_hour-{{ $wk_hour->id }}' class="form-control" name="closing_hour" type="time"
                                            value="{{ $wk_hour->closing_hour }}" id='closing_hour'>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Options-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        @endforeach
                       
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button type="submit" class="btn btn-primary"
                            id="kt_account_profile_details_submit">Update</button>
                    </div>
                    <!--end::Actions-->
                    <input type="hidden">
                    <div></div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
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
        @if (session('success'))
        Toast.fire({
                        icon: 'success',
                        title: '{{ session("success") }}'
                        }) 
           
        @endif

      

        $("#update_profile").on("submit", async function(e) {
            e.preventDefault();
            Swal.fire('Updating profile, please wait...')
            var image = $('#image')[0].files;
            var fd = new FormData;
            fd.append('name', $("#name").val());
            fd.append('firstname', $("#firstname").val());
            fd.append('lastname', $("#lastname").val());
            fd.append('phone', $("#phone").val());
            fd.append('email', $("#email").val());
            fd.append('school', $("#school").val());
            fd.append('description', $("#description").val());
            fd.append('opening_hour', $("#opening_hour").val());
            fd.append('closing_hour', $("#closing_hour").val());
            console.log(image[0],'tje image')
            if(image[0] != undefined) {
            fd.append('image', image[0]);
            }
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('updateprofile')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Profile Updated Successfully'
                        }) 
                
                window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Profile not updated, contact the administrator', 'error')
                }
            })

        })


    })
</script>
@endsection
@endsection