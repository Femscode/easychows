<!DOCTYPE html>

<html lang="en">

<head>
    <title>CTTaste</title>
    <meta charset="utf-8" />
    <meta name="description" content="The best food ordering platform around your institution" />
    <meta name="keywords" content="CTtaste" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="CTTaste" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!--Begin::Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= '../../../../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');
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
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to CTtaste</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <p class="fw-bold fs-2" style="color: #986923;">No 1 Food Ordering <br> Platform For Students
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
                      
                     


                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <h1 class="text-dark mb-3">Set New Password</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                            <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                
                            <!-- Email Address -->
                            <div>
                                <x-label for="email" class='form-label fs-6 fw-bolder text-dark' :value="__('Email')" />
                
                                <x-input readonly id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                            </div>
                
                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" class='form-label fs-6 fw-bolder text-dark' :value="__('Password')" />
                
                                <x-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required />
                            </div>
                
                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" class='form-label fs-6 fw-bolder text-dark' :value="__('Confirm Password')" />
                
                                <x-input id="password_confirmation" class="block mt-1 w-full form-control"
                                                    type="password"
                                                    name="password_confirmation" required />
                            </div>
                
                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Reset Password') }}
                                </x-button>
                            </div>
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
                        <a href="https://cthostel.com" class="text-muted text-hover-primary px-2"
                            target="_blank">CTHostel</a>
                        <a href="/invest" class="text-muted text-hover-primary px-2" target="_blank">Invest</a>
                        <a href="/invest" class="text-muted text-hover-primary px-2" target="_blank">Partner</a>
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
    <script src='/assets/js/professionallocker.js'></script>

    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo4/authentication/layouts/aside/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 02:20:44 GMT -->

</html>