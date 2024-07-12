<!DOCTYPE html>

<html lang="en">

<head>
	<title>CTtaste</title>
	<meta charset="utf-8" />
	<meta name="description" content="The best food ordering platform around your institution" />
	<meta name="keywords" content="CTtaste" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="CTtaste" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/assets/css/style2.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<!--Begin::Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&amp;l=' + l : '';
			j.async = true;
			j.src = '../../../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
	</script>
	<!--End::Google Tag Manager -->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
	<!--Begin::Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
			style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!--End::Google Tag Manager (noscript) -->
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Sign-up -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Aside-->
			<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
				style="background-color: #F2C98A">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					<!--begin::Content-->
					<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
						<!--begin::Logo-->
						<a href="/" class="py-9 mb-5">
							<img alt="Logo" src="{{asset('assets/images/logobig.png')}}" class="h-50px" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to CTtaste<br>
							<!-- <span style='font-style:italic;font-size:15px;color:#ec1c24'>A taste you'll always remember</span> -->
						</h1>

						<!--end::Title-->
						<!--begin::Description-->
						<p class="fw-bold fs-2" style="color: #986923;">No 1 Food Ordering platform<br> for students

						</p>
						<!--end::Description-->
					</div>
					<!--end::Content-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
						style="background-image: url(/metronic8/demo4/assets/media/illustrations/dozzy-1/13.png"></div>
					<!--end::Illustration-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Aside-->
			<!--begin::Body-->
			<div class="d-flex flex-column flex-lg-row-fluid py-10">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid">
					<!--begin::Wrapper-->
					<div class="w-lg-600px p-10 p-lg-15 mx-auto">
						<!--begin::Form-->

						<form class="form w-100" method='post' action="{{ route('register_logistic') }}" enctype="multipart/form-data">@csrf
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Create Delivery Account</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Already have an account?
									<a href="/login" class="link-primary fw-bolder" style='color:#ebab21'>Sign in here</a>
								</div>
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							<!-- brand color
							#ec1c24 red, #009444 green, #414042 -->
							<!--begin::Action-->
							<button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
								<img alt="Logo" src="/assets/media/svg/brand-logos/google-icon.svg"
									class="h-20px me-3" />Sign in with Google</button>
							<!--end::Action-->
							<!--begin::Separator-->
							<div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>
							<x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
							<!--end::Separator-->
							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-12">
									<label class="form-label fw-bolder text-dark fs-6">Name</label>
									<input required class="form-control form-control-lg form-control-solid" type="text"
										placeholder="" name="name" autocomplete="off" />
								</div>
								<!--end::Col-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input required class="form-control form-control-lg form-control-solid" type="email"
									placeholder="" name="email" autocomplete="off" />
							</div>

							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Phone Number</label>
								<input required class="form-control form-control-lg form-control-solid" type="number"
									placeholder="" name="phone" autocomplete="off" />
							</div>
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">School</label>
								<select required class="form-control form-control-lg form-control-solid" 
								name="school">
								<option value=''>--Select Institution--</option>
								<option value="FUNAAB">FUNAAB</option>
								<option value="FUOYE">FUOYE</option>
								<option value="MAPOLY">MAPOLY</option>
								<option value="OSHIELE">OSHIELE</option>
								<option value="LASU">LASU</option>
								<option value="ILARO-POLY">ILARO-POLY</option>
								<option value="KWASU">KWASU</option>
								<option value="Lead City University, Ibadan">Lead City University, Ibadan</option>

							</select>
							</div>
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Vendor<span style='color:red'>(Select if working for a particular vendor)</span></label>
								<select class="form-control form-control-lg form-control-solid" 
								name="vendor_id">
								<option value=''>--Select Vendor--</option>
								@foreach(App\Models\User::where('approve',1)->get() as $vendor)
								<option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
								@endforeach
								
							</select>
							</div>


							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Address</label>
								<input required class="form-control form-control-lg form-control-solid" type="text"
									placeholder="" name="address" autocomplete="off" />
							</div>
							



							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6">Password</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input required class="form-control form-control-lg form-control-solid"
											type="password" placeholder="" id='password' name="password" autocomplete="off" />
										<span
											class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
											data-kt-password-meter-control="visibility">
											<i class="fa fa-eye fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
									<!--end::Input wrapper-->
									<!--begin::Meter-->
									<div class="d-flex align-items-center mb-3"
										data-kt-password-meter-control="highlight">
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
								<div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
									symbols.</div>
								<!--end::Hint-->
							</div>

							<!--end::Input group=-->
							<!--begin::Input group-->
							<div class="fv-row mb-5">
								<label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
								<input required class="form-control form-control-lg form-control-solid" type="password"
									placeholder="" id='confirm_password' name="password_confirmation" autocomplete="off" />
									
							</div>
							<p id='password_status_danger' class='badge badge-danger' style='display:none'></p>
							<p id='password_status_success' class='badge badge-success' style='display:none'></p>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input required class="form-check-input" type="checkbox" name="toc" value="1" />
									<span class="form-check-label fw-bold text-gray-700 fs-6">I Agree to the
										<a href='terms-and-conditions' class="ms-1 link-primary" style='color:#ebab21'>Terms and conditions</a>.</span>
								</label>
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary" style='background:#ebab21'>
									<span class="indicator-label">Create Account</span>
									<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
					<!--begin::Links-->
					<div class="d-flex flex-center fw-bold fs-6">
						<a href="https://cthostel.com/" class="text-muted text-hover-primary px-2"
							target="_blank">CTHostel</a>
						<a href='/invest' class="text-muted text-hover-primary px-2" target="_blank">Invest</a>
						<a href='/partner' class="text-muted text-hover-primary px-2" target="_blank">Partner</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-up-->
	</div>
	<!--end::Root-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "/assets/index.html";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="/assets/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="/assets/js/custom/authentication/sign-up/general.js"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
	<script src='cdn/sweetalert.min.js'></script>
	<script src='cdn/jquery-3.6.0.js'></script>
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
	<script src='assets/js/professionallocker.js'></script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo4/authentication/layouts/aside/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 02:20:44 GMT -->

</html>