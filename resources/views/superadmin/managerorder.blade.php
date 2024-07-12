@extends('backend.master')
@section('header_link')
@endsection
@section('content')

				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Container-->
					<div class="container-xxl" id="kt_content_container">
						<!--begin::Products-->
						<div class="card card-flush">
							<!--begin::Card header-->
							<div class="card-header align-items-center py-5 gap-2 gap-md-5">
								<!--begin::Card title-->
								<div class="card-title">
									<!--begin::Search-->
									<div class="d-flex align-items-center position-relative my-1">
										<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
										<span class="svg-icon svg-icon-1 position-absolute ms-4">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
												<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" />
									</div>
									<!--end::Search-->
								</div>
								<!--end::Card title-->
								<!--begin::Card toolbar-->
								<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
									<!--begin::Flatpickr-->
									 <div class="input-group w-250px">
										<p>Total Orders (<span id='total_order'>{{$mycount }}</span>)</p>
									
										</button>
									</div> 
									<!--end::Flatpickr-->
									
								
									<!--end::Add product-->
								</div>
								<!--end::Card toolbar-->
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Table-->
								<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
									<!--begin::Table head-->
									<thead>
										<!--begin::Table row-->
										<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
											<th class="w-10px pe-2">
												<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
													<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
												</div>
											</th>
											<th class="min-w-100px">Order ID</th>
											<th class="min-w-175px">Customer</th>
											<th class="text-end min-w-70px">Status</th>
											<th class="text-end min-w-100px">Total</th>
											<th class="text-end min-w-100px">Date Added</th>
											<th class="text-end min-w-100px">Location</th>
											<th class="text-end min-w-100px">View</th>
										</tr>
										<!--end::Table row-->
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<input type='hidden' id='rest_id' value='{{ $user->id }}'/>
									<tbody class="fw-bold text-gray-600" id='t_body'>
										<!--begin::Table row-->
										@foreach($orders as $order)
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="1" />
												</div>
											</td>
											<td data-kt-ecommerce-order-filter="order_id">
												<a href="details.html" class="text-gray-800 text-hover-primary fw-bolder">CT-{{$order->order_id}}</a>
											</td>
											<td>
												<div class="d-flex align-items-center">
													
													<div class="ms-5">
														<a href="" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$order->name}} | {{ $user->phone }}</a>
													</div>
												</div>
											</td>
											<td class="text-end pe-0" data-order="Completed">
												<div class="badge badge-light-success">Completed</div>
											</td>
											<td class="text-end pe-0">
												<span class="fw-bolder"># {{number_format($order->total_price,2)}}</span>
											</td>
											<td class="text-end" data-order="2022-01-28">
												<span class="fw-bolder">{{$order->created_at}}</span>
											</td>
											<td class="text-end" data-order="2022-01-31">
												<span class="fw-bolder">{{$order->location}}</span>
											</td>
											<td class="text-end">

												<a href='/orderdetails/{{$order->id}}' class='btn-sm btn btn-success'>View</a>
											</td>
										</tr>
										@endforeach

									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
								<div class='pagination'>
									{{ $orders->links('pagination::bootstrap-4') }}
								</div>
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Products-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div class="container-xxl d-flex flex-column flex-md-row flex-stack">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-gray-400 fw-bold me-1">Powered by</span>
							<a href="https://thecaretech.org" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">CareTech</a>
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
								<a href="#" target="_blank" class="menu-link px-2">CTFarms</a>
							</li>
						</ul>
						<!--end::Menu-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
@endsection
	
	<!--end::Chat drawer-->
	<!--end::Drawers-->

	
	@section('script')
		
	<script>
		var hostUrl = "assets/index.html";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Vendors Javascript(used by this page)-->
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Page Vendors Javascript-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="assets/js/custom/apps/ecommerce/sales/listing.js"></script>
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chat.js"></script>
	<script src="assets/js/custom/intro.js"></script>
	<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="assets/js/custom/utilities/modals/users-search.js"></script>
	<!--end::Page Custom Javascript-->
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
				swal('error','Please pick a starting date','error')
			}
			else {

			
			swal({
              type: 'info',
              title: 'Loading...',
              text: 'Fetching record, please wait...🙂',
              showConfirmButton: false,
              timer: 2000
            })
            fd.append('val',$("#record_day").val());
            fd.append('rest_id',$("#rest_id").val());
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
                    swal.close()
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
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="1" />
												</div>
											</td>
											<td data-kt-ecommerce-order-filter="order_id">
												<a href="#" class="text-gray-800 text-hover-primary fw-bolder">CT-${value.order_id}</a>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
														<a href="#">
															<div class="symbol-label fs-3 bg-light-warning text-warning">S</div>
														</a>
													</div>
													<div class="ms-5">
														<a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder">${value.name}</a>
													</div>
												</div>
											</td>
											<td class="text-end pe-0" data-order="Completed">
												<div class="badge badge-light-success">Completed</div>
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

												<a href='orderdetails/${value.id}' class='btn-sm btn btn-success'>View</a>
											</td>
										</tr>
									
					`)
					})
                    // window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    swal.close()
                    swal('Opps!', 'An error occured, contact the administrator', 'error')
                }
            })
		}


        });
		})
	</script>

	@endsection
