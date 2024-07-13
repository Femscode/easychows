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
						<h1 class="mb-1 h2 fw-bold">Reset Forgot Password</h1>
						<p>{{ __('Forgot your password? No problem. Just let us know your email address and we will
                                    email you a password reset link that will allow you to choose a new one.') }}
                            </p>
					</div>

                    <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                            <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                            <!--begin::Heading-->


                            <!-- Email Address -->
                            <div>
                                <x-label class="form-label fs-6 fw-bolder text-dark" for="email" :value="__('Email')" />
                              

                                <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                                    :value="old('email')" required autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button style='background-color:#640f11'>
                                    {{ __('Email Password Reset Link') }}
                                </x-button>
                            </div>
                        </form>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection

