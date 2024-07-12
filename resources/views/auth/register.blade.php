@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>
	<!-- section -->

	<section class="my-lg-14 my-8">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row justify-content-center align-items-center">
				<div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
					<!-- img -->
					<img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid" />
				</div>
				<!-- col -->
				<div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
					<div class="mb-lg-9 mb-5">
						<h1 class="mb-1 h2 fw-bold">Get Started With EasyChows</h1>
						<p>Already have an account? <a href='/login'>Click here</a> to Sign In</p>

					</div>
					<!-- form -->

					<form class="form w-100" method='post' action="{{ route('register') }}" enctype="multipart/form-data">@csrf
						<!--begin::Heading-->


						<x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
						<!--end::Separator-->
						<!--begin::Input group-->
						<div class="row fv-row mb-7">
							<!--begin::Col-->
							<div class="col">
							<label class="form-label fw-bolder text-dark fs-6">Restaurant Name</label>
								<input required class="form-control  form-control-solid" type="text" placeholder="Restaurant Name" name="name" autocomplete="off" />
							</div>

							<div class="col">
							<label class="form-label fw-bolder text-dark fs-6">Email Address</label>
								<input required class="form-control  form-control-solid" type="email" placeholder="Email Address" name="email" autocomplete="off" />
							</div>

							<!--end::Col-->
						</div>


						<div class="row fv-row mb-7">
							<div class='col'>
							<label class="form-label fw-bolder text-dark fs-6">Phone Number</label>
								<input required class="form-control form-control-solid" type="number" placeholder="Phone Number" name="phone" autocomplete="off" />
							</div>
							<div class="col">
							<label class="form-label fw-bolder text-dark fs-6">Location</label>
								<select required class="form-control form-control-solid" name="school">
									<option value=''>--Select Location--</option>
									@foreach(\App\Models\School::all() as $school)
									<option value="{{ $school->id }}">{{ $school->name }}</option>
									@endforeach
									{{-- <option value="FUNAAB">FUNAAB</option>
									<option value="FUOYE">FUOYE</option>
									<option value="MAPOLY">MAPOLY</option>
									<option value="OSHIELE">OSHIELE</option>
									<option value="LASU">LASU</option>
									<option value="ILARO-POLY">ILARO-POLY</option>
									<option value="KWASU">KWASU</option>
									<option value="Lead City University, Ibadan">Lead City University, Ibadan</option> --}}

								</select>
							</div>

						</div>


						<div class="row fv-row mb-7">
							<div class='col'>
								<label class="form-label fw-bolder text-dark fs-6">Address</label>
							<input required class="form-control form-control-solid" type="text" placeholder="Address" name="address" autocomplete="off" />
							</div>

							<div class="col">
							<label class="form-label fw-bolder text-dark fs-6">Display Image <span style='color:red'>(Optional)</span></label>
							<input class="form-control form-control-solid" type="file" placeholder="" name="image" autocomplete="off" />
						</div>
						</div>
						



						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10 fv-row" data-kt-password-meter="true">
							<!--begin::Wrapper-->
							<div class="col mb-1">
								<!--begin::Label-->
								<label class="form-label fw-bolder text-dark fs-6">Password</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="position-relative mb-3">
									<input required class="form-control form-control-solid" type="password" placeholder="" id='password' name="password" autocomplete="off" />
									<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
										<i class="fa fa-eye fs-2"></i>
										<i class="bi bi-eye fs-2 d-none"></i>
									</span>
								</div>
								<!--end::Input wrapper-->
								<!--begin::Meter-->
								<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
									</div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
									</div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
									</div>
									<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
								</div>
								<!--end::Meter-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Hint-->

							<div class="col mb-2">
							<label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
							<input required class="form-control form-control-solid" type="password" placeholder="" id='confirm_password' name="password_confirmation" autocomplete="off" />

						</div>
							
						</div>

						<!--end::Input group=-->
						<!--begin::Input group-->
						
						<p id='password_status_danger' class='btn btn-light-danger' style='display:none'></p>
						<p id='password_status_success' class='btn btn-light-success' style='display:none'></p>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<label class="form-check form-check-custom form-check-solid form-check-inline">
								<input required class="form-check-input" type="checkbox" name="toc" value="1" />
								<span class="form-check-label fw-bold text-gray-700 fs-6">I Agree to the
									<a class="ms-1 link-primary" style='color:#ebab21'>Terms and conditions</a>.</span>
							</label>
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="text-center">
							<button type="submit" class="btn btn-lg btn-primary" >
								<span class="indicator-label">Sign Up</span>
								
							</button>
						</div>
						<!--end::Actions-->
					</form>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection

@section('script')
<script>
		$(document).ready(function() {
			$("#food_category").on('change',function() {
				var currentfood = $("#food_category").val()
				if(currentfood == 'food') {
					$("#select_as_applied").show()
					$("#food").show()
					$("#cakes").hide()
					$("#shawarma").hide()
					$("#others").hide()
				}
				else if(currentfood == 'cakes') {
					$("#select_as_applied").show()
					$("#cakes").show()
					$("#food").hide()
					$("#shawarma").hide()
					$("#others").hide()
				}
				else if(currentfood == 'shawarma') {
					$("#select_as_applied").show()
					$("#shawarma").show()
					$("#cakes").hide()
					$("#food").hide()
					$("#others").hide()
				}
				else {
					$("#select_as_applied").show()
					$("#others").show()
					$("#cakes").hide()
					$("#shawarma").hide()
					$("#food").hide()
				}
				// alert(currentfood)
			})

			$("#confirm_password").on('input', function() {
				var password = $("#password").val()
				if(password == $("#confirm_password").val()) {
					$("#password_status_danger").hide()
					$("#password_status_success").show()
					
					$("#password_status_success").text("Password matched")
				}
				else {
					$("#password_status_success").hide()
					$("#password_status_danger").show()
					
					$("#password_status_danger").text("Password not matched")
				}
			})
		});
	</script>
@endsection