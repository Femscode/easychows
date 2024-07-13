@extends('frontend.master')

@section('header')

@endsection

@section('content')
<main>
    <!-- section -->
    <section class="my-lg-14 my-8">
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
                        <h1 class="mb-1 h2 fw-bold">Set New Password</h1>
                       
                    </div>

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
                </div>
            </div>
        </div>
    </section>
</main>

@endsection