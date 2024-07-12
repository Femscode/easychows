@extends('dashboard.master')

@section('header')

@endsection

@section('content')

<main class="main-content-wrapper">
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Products-->
        @if(Session::has('message'))
        <div class='alert alert-success'>{{Session::get('message')}}</div>
        @endif
        <div class="card card-flush">

            <!--begin::Card header-->
            <div class="card-header align-items-center">

            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="mytable table align-middle table-row-dashed">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                            <th class="min-w-100px">Name</th>
                            <th class="min-w-175px">Phone</th>
                            <th class="text-end min-w-70px">Status</th>
                            <th class="text-end min-w-100px">Rank</th>

                            <th class="text-end min-w-100px">Action</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        <!--begin::Table row-->
                        @foreach($users as $user)
                        <tr>

                            <td data-kt-ecommerce-order-filter="order_id">
                                <a class="text-gray-800 text-hover-primary fw-bolder">{{$user->name}}</a>
                                {{$user->get_school($user->school)->name ?? ""}}
                            </td>
                            <!--end::Order ID=-->
                            <!--begin::Customer=-->
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin:: Avatar -->

                                    <div class="ms-5">
                                        <!--begin::Title-->
                                        <a href="tel:{{$user->phone}}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$user->phone}}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <!--end::Customer=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0" data-order="Completed">
                                <!--begin::Badges-->
                                @if($user->approve == 1)
                                <div class="btn btn-light-success">Approved</div>
                                @else
                                <div class="btn btn-light-warning">Pending</div>
                                @endif
                                <!--end::Badges-->
                            </td>
                            <!--end::Status=-->
                            <!--begin::Total=-->
                            <td class="text-end pe-0">
                                <form method='post' action="{{ route('update_rank') }}">@csrf
                                    <input type='hidden' value='{{ $user->id }}' name='user_id' />
                                    <input type='number' value='{{ $user->rank }}' class='form-control-sm' name='rank' />
                                    <input type='submit' value='update' class='btn btn-sm btn-dark' />
                                </form>

                            </td>


                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="feather-icon icon-more-vertical fs-5"></i>
                                    </a>
                                    <ul class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-3.33333px, 21px, 0px);">

                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">ACTION</div>
                                        </div>
                                        <!--end::Heading-->

                                        <li class="dropdown-item">
                                            @if($user->availability == 0)
                                            <a onclick='return confirm("Are you sure you want to enable {{$user->name}}")' href="/disable/{{$user->id}}" class="menu-link px-3">Enable</a>
                                            @else
                                            <a onclick='return confirm("Are you sure you want to disable {{$user->name}}")' href="/disable/{{$user->id}}" class="menu-link px-3">Disable</a>
                                            @endif

                                        </li>
                                        <li class="dropdown-item">
                                            @if($user->approve == 0)
                                            <a onclick='return confirm("Are you sure you want to approve {{$user->name}}")' href="/approveuser/{{$user->id}}" class="menu-link px-3">Approve</a>
                                            @else
                                            <a onclick='return confirm("Are you sure you want to disapprove {{$user->name}}")' href="/disapproveuser/{{$user->id}}" class="menu-link px-3">Disapprove</a>
                                            @endif

                                        </li>

                                      
                                        <li class="dropdown-item">
                                            <a href="/superuserprofile/{{$user->id}}" class="menu-link px-3">View Profile</a>
                                        </li>

                                        <li  class="dropdown-item">
                                            <a href="/superuserorder/{{$user->id}}" class="menu-link px-3">View Order</a>
                                        </li>

                                        <li  class="dropdown-item">
                                            <a href="/superuserfood/{{$user->id}}" class="menu-link px-3">View Food</a>
                                        </li>
                                        <li  class="dropdown-item">
                                            <a href="/superworking_hours/{{$user->id}}" class="menu-link px-3">Working Hours</a>
                                        </li>

                                        <li  class="dropdown-item">
                                            <a href="https://wa.me/234{{substr($user->phone,1)}}?text=" class="menu-link px-3">Message User</a>
                                        </li>
                                    


                                        <li  class="dropdown-item">
                                            <a onclick='return confirm("Are you sure you want to delete {{$user->name}}")' href="deleteuser/{{$user->id}}" class="btn-sm btn btn-danger">Delete User</a>
                                        </li>


                                       
                                    </ul>
                                </div>


                            </td>
                            <!--end::Action=-->
                        </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
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
        $("#sort_record").on('click', function() {
            var fd = new FormData;
            console.log($("#start_date").val(), 'the val')
            if ($("#start_date").val().length <= 4) {
                Swal.fire('error', 'Please pick a starting date', 'error')
            } else {


                Swal.fire({
                    type: 'info',
                    title: 'Loading...',
                    text: 'Fetching record, please wait...🙂',
                    showConfirmButton: false,
                    timer: 2000
                })
                fd.append('val', $("#record_day").val());
                fd.append('start_date', $("#start_date").val());
                fd.append('end_date', $("#end_date").val());

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