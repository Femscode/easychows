@extends('dashboard.master')
@section('header_link')
@endsection
@section('content')
<main class="main-content-wrapper">


	<div class="container-xxl" id="kt_content_container">
		<!--begin::Products-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header align-items-center py-5 gap-2 gap-md-5">
				
				<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
					<!--begin::Flatpickr-->
					<div class="input-group w-250px">
						<h2>{{$user->name }} Total Orders (<span id='total_order'>{{$mycount }}</span>)</h2>

						</button>
					</div>
					<!--end::Flatpickr-->
					<div class="w-100 mw-350px">
						<!--begin::Select2-->
						<h4>Sort Orders</h4>
						{{-- <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status"> --}}
						<div class='row'>
							<input id='rest_id' value='{{ $user->id }}' type='hidden' />
							<div class='col-md-4'>
								<label>From:</label>
								<input type='date' class='form-control' id='start_date' />
							</div>
							<div class='col-md-4'>
								<label>To:</label>
								<input type='date' class='form-control' id='end_date' />
							</div>
							<div class='col-md-4'>

								<a id='sort_record' class='btn sm btn btn-secondary'>Sort</a>
							</div>
						</div>
					


						<!--end::Select2-->
					</div>

					<!--end::Add product-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table mytable align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
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
					<input type='hidden' id='rest_id' value='{{ $user->id }}' />
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
									<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
										<a href="tel:{{$order->phone}}">
											<div class="symbol-label fs-3 bg-light-warning text-warning">C</div>
										</a>
									</div>
									<div class="ms-5">
										<a href="" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$order->name}}</a>
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
	
</main>
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
				fd.append('rest_id', $("#rest_id").val());
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
														<a href="tel:${value.phone}">
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
						Swal.fire('Opps!', 'An error occured, contact the administrator', 'error')
					}
				})
			}


		});
	})
</script>

@endsection